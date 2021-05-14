<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Modules\Post\Entities\Category;
use Yajra\DataTables\DataTables;
use Modules\Post\Entities\PostTasks;
use Modules\Post\Entities\Tags;
use Illuminate\Support\Facades\Session;
use Modules\Post\Entities\Post;
use Throwable;

class PostTaskController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(PostTasks $postTasks)
    {
        $this->model = $postTasks;
        $this->data = [
            'base_route' => 'post-tasks',
            'base_role'=>'posts',
            'panel_name' => 'Post',
            'name' => 'post-tasks',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-post"></i>',
            'order_column' => 4,
            'order_by' => 'desc'
        ];
        $this->middleware('permission:posts-list|posts-create|posts-edit|posts-delete|posts-data', ['only' => ['index','store']]);
        $this->middleware('permission:posts-create', ['only' => ['create','store']]);
        $this->middleware('permission:posts-show', ['only' => ['show']]);
        $this->middleware('permission:posts-publish', ['only' => ['GetCurrentTaskStatus','ChangeTaskStatus','SendForUpdate']]);
        $this->middleware('permission:posts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        $this->base_view = 'post::post-tasks';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        $user = User::where('status',1)->pluck('name','id')->toArray();
        return view(parent::LoadView($this->base_view.'.index'),compact('route','user'));
    }

    public function DatatableAjax(Request $request)
    {
        if(auth()->user()->can('posts-list-all')){
            $posts = $this->model::join('users','users.id','post_tasks.user_id')->join('categories','categories.id','post_tasks.category_id')->select(['post_tasks.id','post_tasks.title','post_tasks.slug','post_tasks.task_status','post_tasks.summary','post_tasks.created_at','categories.title as category_title','users.name as username','post_tasks.updated_at']);
        }else{
            $posts = $this->model::where(function($query) {
                $query->where('post_tasks.user_id', auth()->user()->id);
                $query->orWhere(function($query_two) {
                   $query_two->where('post_tasks.updated_by',auth()->user()->id);
                   });
             })->join('users','users.id','post_tasks.user_id')->join('categories','categories.id','post_tasks.category_id')->select(['post_tasks.id','post_tasks.title','post_tasks.slug','post_tasks.task_status','post_tasks.created_at','categories.title as category_title','users.name as username','post_tasks.updated_at']);
        }

        $datatables =  DataTables::of($posts)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('title',function($val){
                if($this->CheckIfAlreadyPublished($val)){
                    if($val->status != 'Published'){
                        $title =  $val->title." <i class='font-icon font-icon-check-circle'></i>";
                    }else{
                        $title = $val->title;
                    }
                }else{
                    $title = $val->title;
                }
                if($val->task_status == "Drafted"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }elseif($val->task_status == "Published"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }elseif($val->task_status == "Redo"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }elseif($val->task_status == "Rejected"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }elseif($val->task_status == "Submitted"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }elseif($val->task_status == "Update"){
                    return '<div class="datatable-title">'.$title.'</div>';
                }
            })
            ->editColumn('task_status',function($val){
                $data = $this->data;
                return view($this->base_view.".components.task_status",compact('val','data'))->render();
            })
            ->editColumn('updated_at', function ($val) {
                $updated_at = Carbon::parse($val->updated_at);
                return '<span class="label label-pill label-primary">'.date_format($updated_at,'F d, Y g:i A').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('status','updated_at');
            return $datatables->make(true);
    }

    public function create()
    {
        $categories = Category::where('status',1)->with('children')->whereNull('parent_id')->orderBy('order', 'asc')->get();
        $tags_count = DB::table('tags')->count();
        $related_tags = Tags::where('status',1)->pluck('name','id');
        return view(parent::LoadView($this->base_view.'.create'),compact('categories','tags_count','related_tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'action' => 'required|in:submit,save_as_draft',
            'title' => 'required',
            'slug' => 'required|unique:post_tasks,slug',
            'category' => 'required|exists:categories,id'
        ]);

        if($request->get('action') == 'submit')
        {
            $this->validate($request,[
                'meta_title' => 'required|unique:posts,meta_title',
                'meta_desc' => 'required',
                'related_tags' => 'required',
                'summary' => 'required',
                'description' => 'required',
                'featured_image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            return $this->Submit($request);
        }
        elseif($request->get('action') == 'save_as_draft')
        {
            $this->validate($request,[
                'meta_title' => 'sometimes|unique:posts,meta_title',
                'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);

            return $this->SaveAsDraft($request);
        }
        else
        {
            Session::flash('error','Undefined Action');
            return redirect()->back();
        }
    }

    public function Submit($request)
    {
        if($request->get('publish_post') == 'on'){
            if($this->CheckPublishAccess()){
                $featured = $request->get('featured') ? 1 : 0;
                $status = $request->get('status') ? 1 : 0;
                $published = $request->get('published') ? 1 : 0;
                $task_status = "Published";
                $post = $this->CreatePostTask($request,$task_status);
                if($request->ajax()){
                    $ajax = true;
                }else{
                    $ajax = false;
                }
                return $this->PublishPost($post,$featured,$status,$published,$ajax);
            }else{
                return redirect()->route($this->data['base_route'].'.index')
                ->with('error',"Unauthorized action");
            }
        }else{
            $task_status = "Submitted";
            $post = $this->CreatePostTask($request,$task_status);
        }
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' submitted successfully');
    }

    public function UpdateSubmit($request,$post)
    {
        if($request->get('publish_post') == 'on'){
            if($this->CheckPublishAccess()){
                $featured = $request->get('featured') ? 1 : 0;
                $status = $request->get('status') ? 1 : 0;
                $published = $request->get('published') ? 1 : 0;
                $task_status = "Published";
                $updated_post = $this->UpdatePostTask($request,$task_status,$post);
                if($request->ajax()){
                    $ajax = true;
                }else{
                    $ajax = false;
                }
                return $this->PublishPost($updated_post,$featured,$status,$published,$ajax);
            }else{
                return redirect()->route($this->data['base_route'].'.index')
                ->with('error',"Unauthorized action");
            }
        }else{
            $task_status = "Submitted";
            $post = $this->UpdatePostTask($request,$task_status,$post);
        }
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' submitted successfully');
    }


    public function SaveAsDraft(Request $request)
    {
        $task_status = "Drafted";
        $post = $this->CreatePostTask($request,$task_status);
        if($post){
            $message = 'Post was '.$task_status;
            $this->LogActivity($message);
            return redirect()->route($this->data['base_route'].'.edit',$post->id)->with('success','Your changes were saved successfully!');
        }else{
            return Redirect::back()->withInput();
        }
    }

    public function SaveAsDraftOnUpdate(Request $request,$post)
    {
        if($post->task_status == 'Update'){
            $task_status = "Update";
        }elseif($post->task_status == 'Submitted'){
            $task_status = "Submitted";
        }
        else{
            $task_status = "Drafted";
        }
        $input = $request->all();
        $input['user_id'] = $post->user_id;
        $input['task_status'] = $task_status;
        $input['category_id'] = $request->get('category');
        if($request->has('featured_image')){
            $this->validate($request, [
                'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            $path = $this->UploadFile('posts',$request->file('featured_image'));
            $input['featured_image'] = $path;
        }
        DB::beginTransaction();
        try {
            $post->update($input);
            $topic_ids = $request->get('related_tags');
            if($topic_ids != null){
                $post->postTags()->sync($topic_ids);
            }
            DB::commit();
            $message = 'Post was drafted [Update]';
            $this->LogActivity($message);
            return redirect()->back()->with('success','Your changes were saved successfully!');

        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return Redirect::back()->withInput();
        }
    }

    public function PublishPost($post,$featured,$status,$published,$ajax)
    {
        $post = $this->model::find($post->id);
        $published_post = Post::where('slug',$post->slug)->first();
        if(!$published_post){
            $published_post = new Post();
        }
        $published_post->title = $post->title;
        $published_post->slug = $post->slug;
        $published_post->sub_title = $post->sub_title;
        $published_post->meta_title = $post->meta_title;
        $published_post->meta_desc = $post->meta_desc;
        $published_post->summary = $post->summary;
        $published_post->description = $post->description;
        $published_post->featured_image = $post->featured_image;
        $published_post->category_id = $post->category_id;
        $published_post->user_id = $post->user_id;
        $published_post->tags = $post->tags;
        $published_post->featured = $featured;
        $published_post->status = $status;
        $published_post->published = $published;
        $published_post->task_id = $post->id;
        $published_post->save();
        $message = 'Post was published';
        $this->LogActivity($message);
        if($ajax == true){
            return true;
        }else{
            return redirect()->route($this->data['base_route'].'.index')->with('success','Post '. $post->title.' was published successfully!');
        }

    }

    public function CheckPublishAccess()
    {
        if(auth()->user()->can('posts-publish')){
            return true;
        }else{
            return false;
        }
    }

    public function CreatePostTask($request,$task_status)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['task_status'] = $task_status;
        $input['category_id'] = $request->get('category');
        $post = new $this->model;
        if($request->has('featured_image')){
            $this->validate($request, [
                'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            $path = $this->UploadFile('posts',$request->file('featured_image'));
            $input['featured_image'] = $path;
        }
        DB::beginTransaction();
        try {
            $post_row = $post->create($input);
            $topic_ids = $request->get('related_tags');
            if($topic_ids != null){
                $post_row->postTags()->attach($topic_ids);
            }
            DB::commit();
            if($task_status == "Drafted"){
                $message = 'Post status was changed to '.$task_status;
            }else{
                $message = 'Post status was submitted';
            }
            $this->LogActivity($message);
            return $post_row;

        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }



    public function edit(Request $request,$id)
    {
        $post = $this->model::with('postTags')->find($id);
        if($post){
            if($this->CheckAvailabilityForEdit($post)){
                if($this->CheckPostAccess($post)){
                    $categories = Category::where('status',1)->with('children')->whereNull('parent_id')->orderBy('order', 'asc')->get();
                    if($post->postTags){
                        $post_topics = $post->postTags->pluck('id')->toArray();
                    }else{
                        $post_topics = [];
                    }
                    $related_tags = Tags::where('status',1)->get();
                    $published = $this->CheckIfAlreadyPublished($post);
                    $log_data = Activity::join('users','users.id','activity_log.causer_id')->join('post_tasks','post_tasks.id','activity_log.subject_id')->where('log_name','Task')->where('subject_id',$id)->select('users.name as user_name','post_tasks.title','activity_log.*')->orderBy('id','desc')->get();
                    return view(parent::LoadView($this->base_view.'.edit'),compact('categories','post','related_tags','post_topics','published','log_data'));
                }else{
                    return redirect()->back()->with('error','Invalid request');
                }
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function CheckIfAlreadyPublished($post)
    {
        $published_post = Post::where('task_id',$post->id)->first();
        if($published_post){
            return true;
        }else{
            return false;
        }
    }


    public function update(Request $request,$id)
    {
        $post = $this->model::find($id);
        if($post){
            if($this->CheckAvailabilityForEdit($post)){
                $this->validate($request,[
                    'action' => 'required|in:submit,save_as_draft,redo,reject',
                    'title' => 'required',
                    'category' => 'required|exists:categories,id'
                ]);

                if($post->slug == null){
                    $this->validate($request,[
                        'slug' => 'required|unique:post_tasks,slug,'.$id,
                    ]);
                }

                if($request->get('action') == 'reject'){
                    $post->task_status = 'Rejected';
                    $post->save();
                    $message = 'Post status was changed to Rejected';
                    $this->LogActivity($message);
                    return redirect()->route($this->data['base_route'].'.index')->with('success','Post'. $post->title.' status was changed to '.$post->task_status .' successfully!');
                }

                if($request->get('action') == 'redo'){
                    $post->task_status = 'Redo';
                    $post->save();
                    $message = 'Post status was changed to Redo';
                    $this->LogActivity($message);
                    return redirect()->route($this->data['base_route'].'.index')->with('success','Post'. $post->title.' status was changed to '.$post->task_status .' successfully!');
                }

                if($request->get('action') == 'submit')
                {
                    if($post->featured_image == null){
                        $this->validate($request,[
                            'featured_image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp'
                        ]);
                    }
                    $this->validate($request,[
                        'meta_title' => 'required|unique:post_tasks,id,'.$id,
                        'meta_desc' => 'required',
                        'related_tags' => 'required',
                        'summary' => 'required',
                        'description' => 'required',
                    ]);
                    return $this->UpdateSubmit($request,$post);
                }
                elseif($request->get('action') == 'save_as_draft')
                {
                    $this->validate($request,[
                        'meta_title' => 'sometimes|unique:post_tasks,id,'.$id,
                        'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
                    ]);

                    return $this->SaveAsDraftOnUpdate($request,$post);
                }
                else
                {
                    Session::flash('error','Undefined Action');
                    return redirect()->back();
                }

                $input = $request->all();
                if(auth()->user()->can('posts-slug-editing')){
                    $this->validate($request, [
                        'slug' => 'sometimes|unique:posts,slug,'.$id
                    ]);
                }else{
                    if($request->has('slug')){
                        return redirect()->back()->with('error','Invalid request');
                    }
                }
                if(auth()->user()->can('posts-publish')){
                    $input['published'] = $request->has('published') ? 1 : 0;
                }else{
                    if($request->has('published')){
                        return redirect()->back()->with('error','Invalid request');
                    }
                }
                $input['featured'] = $request->has('featured') ? 1 : 0;
                $input['status'] = $request->has('status') ? 1 : 0;
                if($this->CheckPostAccess($post)){
                    if($request->hasFile('featured_image')){
                        $this->validate($request, [
                            'image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
                        ]);
                        $path = $this->UploadFile('posts',$request->file('image'));
                        $input['featured_image'] = $path;
                    }else{
                        $input['featured_image'] = $post->featured_image;
                    }
                    $post->update($input);
                    return redirect()->route($this->data['base_route'].'.index')
                    ->with('success',$this->data['panel_name'].' updated successfully');
                }
                else{
                    return redirect()->back()->with('error','Invalid request');
                }
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function UpdatePostTask($request,$task_status,$post)
    {
        $input = $request->all();
        $input['user_id'] = $post->user_id;
        $input['task_status'] = $task_status;
        $input['category_id'] = $request->get('category');
        if($request->has('featured_image')){
            $this->validate($request, [
                'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            $path = $this->UploadFile('posts',$request->file('featured_image'));
            $input['featured_image'] = $path;
        }
        DB::beginTransaction();
        try {
            $post->update($input);
            $topic_ids = $request->get('related_tags');
            if($topic_ids != null){
                $post->postTags()->sync($topic_ids);
            }
            DB::commit();
            $message = 'Post status was changed to '.$task_status;
            $this->LogActivity($message);
            return $post;

        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return false;
        }
    }

    public function GetCurrentTaskStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required|exists:post_tasks,id'
        ]);
        $post = $this->model::find($request->id);
        if($this->CheckPostAccess($post)){
            $user = User::where('status',1)->get();
            return response()->json(array(
                'success' => true,
                'view' => view($this->base_view.".ajax.task_status",compact('post','user'))->render()
            ), 200);
        }else{
            return response()->json(['success'=>false,'message'=>'Unauthorized access'],403);
        }

    }

    public function SendForUpdate(Request $request)
    {
        $rules = [
            'assign_to_same_user' => 'in:on',
            'user_id' => 'sometimes|exists:users,id',
            'post_id'=>'required|exists:post_tasks,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $errors = $validator->errors();
            return response()->json(array(
                'success' => false,
                'view' => view("admin.components.error_bag_ajax_messages",compact('errors'))->render()
            ), 400);
        }

        $post = PostTasks::find($request->post_id);
        if($this->CheckPostAccess($post)){
            $post->task_status = 'Update';
            if($request->assign_to_same_user != 'on'){
                $post->updated_by = $request->user_id;
                $user = User::where('id',$request->user_id)->first();
                $message = 'Post was sent for update to '.$user->name;
            }else{
                $post->updated_by = $post->user_id;
                $message = "Post was sent for update";
            }
            $post->save();
            $this->LogActivity($message);
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
            ), 200);
        }else{
            $message = "Access Forbidden! This action is not authorized. Contact Administrator.";
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 403);
        }

    }

    public function ChangeTaskStatus(Request $request)
    {
        $rules = [
            'task_status' => 'required|in:Redo,Published,Rejected,Submitted',
            'user_id' => 'sometimes|exists:users,id',
            'post_id'=>'required|exists:post_tasks,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $errors = $validator->errors();
            return response()->json(array(
                'success' => false,
                'view' => view("admin.components.error_bag_ajax_messages",compact('errors'))->render()
            ), 400);
        }

        $post = PostTasks::find($request->post_id);
        if($this->CheckPostAccess($post)){
            if($request->task_status == 'Published'){
                $featured = $request->get('featured') ? 1 : 0;
                $status = $request->get('status') ? 1 : 0;
                $published = $request->get('published') ? 1 : 0;
                $this->PublishPost($post,$featured,$status,$published,$ajax=true);
            }
            $post->task_status = $request->task_status;
            $post->save();
            $message = 'Post status was changed to '.$request->task_status;
            $post->save();
            $this->LogActivity($message);
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
            ), 200);
        }else{
            $message = "Access Forbidden! This action is not authorized. Contact Administrator.";
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 403);
        }

    }

    public function CheckPostAccess($post)
    {
        if(auth()->user()->can('posts-list-all')){
            return true;
        }else{
            if($post->user_id == auth()->user()->id){
                return true;
            }elseif($post->updated_by == auth()->user()->id){
                return true;
            }
            else{
                return false;
            }
        }
    }


    public function CheckAvailabilityForEdit($post)
    {
        if(auth()->user()->can('posts-publish')){
            if($post->task_status == 'Published'){
                return false;
            }else{
                return true;
            }
        }else{
            if($post->task_status == 'Drafted' || $post->task_status == 'Redo' || $post->task_status == 'Update'){
                return true;
            }else{
                return false;
            }
        }
    }

    public function show($id)
    {
        $post = $this->model::find($id);
        $row_data = $post->toArray();
        $modified_data = [
            'featured_image' => $post->featured_image ? '<img height="200" width="300" src="'.render($post->featured_image).'">' : '<span class="label label-danger">Not Set</span>',
            'category' => $post->category_id ? ucwords($post->category->title) : '<span class="label label-danger">Not Set</span>',
            'User' => $post->user_id ? $post->users->name : '<span class="label label-danger">Not Set</span>',
            'Updated By' => $post->updated_by ? $post->updatedBy->name : '<span class="label label-danger">Not Set</span>',
            'created_at' => date('l M j, Y h:i A', strtotime($post->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $post->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($post->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $post->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        unset($rows['category_id'],$rows['id'],$rows['user_id'],$rows['updated_by']);
        $log_data = Activity::join('users','users.id','activity_log.causer_id')->join('post_tasks','post_tasks.id','activity_log.subject_id')->where('log_name','Task')->where('subject_id',$id)->select('users.name as user_name','post_tasks.title','activity_log.*')->orderBy('id','desc')->get();
        return view(parent::LoadView($this->base_view.'.show'),compact('rows','post','log_data'));
    }

    public function ActivityShow($post_id,$id)
    {
        if(auth()->user()->can('posts-view-task-logs')){
            $post = PostTasks::find($post_id);
            if($post){
                if($this->CheckPostAccess($post)){
                    $log_data = Activity::where('activity_log.id',$id)->first();
                    if($log_data){
                        $log = $log_data->getChangesAttribute();
                        return view(parent::LoadView($this->base_view.'.components.task_log_view'),compact('log','log_data','post'));
                    }else{
                        abort(404);
                    }
                }
            }else{
                abort(404);
            }
        }else{
            abort(403);
        }
    }

    public function destroy(Request $request)
    {
        $post = $this->model::find($request->id);
        if($post){
            if($this->CheckPostAccess($post)){
                $post->delete();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
