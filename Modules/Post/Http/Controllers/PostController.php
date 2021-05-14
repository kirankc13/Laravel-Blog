<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Modules\Post\Http\Requests\CreatePostRequest;
use Modules\Post\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Post $post)
    {
        $this->model = $post;
        $this->data = [
            'base_route' => 'posts',
            'base_role'=>'posts',
            'panel_name' => 'Published Posts',
            'name' => 'posts',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-check-circle"></i>',
            'order_column' => 6,
            'order_by' => 'desc'
        ];
        $this->middleware('permission:published-posts-list|posts-delete', ['only' => ['index','store']]);
        $this->middleware('permission:published-posts-list', ['only' => ['index']]);
        $this->middleware('permission:posts-delete', ['only' => ['destroy']]);
        $this->base_view = 'post::posts';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        if(auth()->user()->can('posts-list-all')){
            $posts = $this->model::join('users','users.id','posts.user_id')->join('categories','categories.id','posts.category_id')->select(['posts.id','posts.title','posts.slug','posts.status','posts.summary','posts.published','posts.created_at','posts.featured','categories.title as category_title','users.name as username','posts.hits']);
        }else{
            $posts = $this->model::where('posts.user_id',auth()->user()->id)->join('users','users.id','posts.user_id')->join('categories','categories.id','posts.category_id')->select(['posts.id','posts.title','posts.slug','posts.status','posts.summary','posts.featured','posts.published','posts.created_at','categories.title as category_title','users.name as username','posts.hits']);
        }

        $datatables =  DataTables::of($posts)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('title',function($val){
                if($val->published){
                    return '<div class="datatable-title"><i class="font-icon font-icon-check-circle"></i> '. $val->title.'</div>';
                }else{
                    return '<div class="datatable-title">'.$val->title.'</div>';
                }
            })
            ->editColumn('hits',function($val){
                return $val->hits ?  '<span class="label label-pill label-primary">'.$val->hits.'</span>' : '<span class="label label-pill label-danger">0</span>';
            })
            ->editColumn('published', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.publish",compact('val','data'))->render();
            })
            ->editColumn('status', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.status",compact('val','data'))->render();
            })
            ->editColumn('featured', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.featured",compact('val','data'))->render();
            })
            ->editColumn('created_at', function ($val) {
                $created_at = Carbon::parse($val->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y g:i A').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('status','created_at');
            return $datatables->make(true);
    }

    // public function create()
    // {
    //     $categories = Category::all()->pluck('title','id')->toArray();
    //     return view(parent::LoadView($this->base_view.'.create'),compact('categories'));
    // }

    // public function store(CreatePostRequest $request)
    // {
    //     $input = $request->all();
    //     $input['featured'] = $request->has('featured') ? 1 : 0;
    //     $input['published'] = $request->has('published') ? 1 : 0;
    //     $input['status'] = $request->has('status') ? 1 : 0;
    //     $input['user_id'] = auth()->user()->id;
    //     $post = new $this->model;
    //     if($request->has('featured_image')){
    //         $this->validate($request, [
    //             'featured_image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
    //         ]);
    //         $path = $this->UploadFile('posts',$request->file('featured_image'));
    //         $input['featured_image'] = $path;
    //     }
    //     $post->create($input);
    //     return redirect()->route($this->data['base_route'].'.index')
    //     ->with('success',$this->data['panel_name'].' created successfully');
    // }

    // public function edit(Request $request,$id)
    // {
    //     $post = $this->model::find($id);
    //     if($post){
    //         if($this->CheckPostAccess($post)){
    //             $categories = Category::all()->pluck('title','id')->toArray();
    //             return view(parent::LoadView($this->base_view.'.edit'),compact('categories','post'));
    //         }else{
    //             return redirect()->back()->with('error','Invalid request');
    //         }
    //     }else{
    //         abort(404);
    //     }
    // }

    // public function update(UpdatePostRequest $request,$id)
    // {
    //     $post = $this->model::find($id);
    //     if($post){
    //         $input = $request->all();
    //         if(auth()->user()->can('posts-slug-editing')){
    //             $this->validate($request, [
    //                 'slug' => 'sometimes|unique:posts,slug,'.$id
    //             ]);
    //         }else{
    //             if($request->has('slug')){
    //                 return redirect()->back()->with('error','Invalid request');
    //             }
    //         }
    //         if(auth()->user()->can('posts-publish')){
    //             $input['published'] = $request->has('published') ? 1 : 0;
    //         }else{
    //             if($request->has('published')){
    //                 return redirect()->back()->with('error','Invalid request');
    //             }
    //         }
    //         $input['featured'] = $request->has('featured') ? 1 : 0;
    //         $input['status'] = $request->has('status') ? 1 : 0;
    //         if($this->CheckPostAccess($post)){
    //             if($request->hasFile('featured_image')){
    //                 $this->validate($request, [
    //                     'image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
    //                 ]);
    //                 $path = $this->UploadFile('posts',$request->file('image'));
    //                 $input['featured_image'] = $path;
    //             }else{
    //                 $input['featured_image'] = $post->featured_image;
    //             }
    //             $post->update($input);
    //             return redirect()->route($this->data['base_route'].'.index')
    //             ->with('success',$this->data['panel_name'].' updated successfully');
    //         }
    //         else{
    //             return redirect()->back()->with('error','Invalid request');
    //         }
    //     }else{
    //         abort(404);
    //     }

    // }

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

    public function EditorUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('posts'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('inner-posts/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function PublishPost(Request $request,$id)
    {
        $post = $this->model::find($id);
        if($post){
            if($this->CheckPostAccess($post)){
                if(auth()->user()->can('posts-publish')){
                    if($post->published == true){
                        $post->published = false;
                        $post->save();
                        $message = 'Post "'.$post->title.'" was unpublished';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }else{
                        $post->published = true;
                        $post->save();
                        $message = 'Post "'.$post->title.'" was published';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }
                }
                else{
                    $message = 'Access denied. This action is not authorized!';
                    return response()->json(array(
                        'success' => true,
                        'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                    ), 403);
                }
            }else{
                $message = 'Access denied. This action is not authorized!';
                return response()->json(array(
                    'success' => true,
                    'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                ), 403);
            }
        }else{
            $message = 'Record Does not exist';
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 404);
        }
    }

    public function TogglePostFeatured(Request $request,$id)
    {
        $post = $this->model::find($id);
        if($post){
            if($this->CheckPostAccess($post)){
                if(auth()->user()->can('posts-featured')){
                    if($post->featured == true){
                        $post->featured = false;
                        $post->save();
                        $message = 'Post "'.$post->title.'" was removed from featured section';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }else{
                        $post->featured = true;
                        $post->save();
                        $message = 'Post "'.$post->title.'" was featured';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }
                }
                else{
                    $message = 'Access denied. This action is not authorized!';
                    return response()->json(array(
                        'success' => true,
                        'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                    ), 403);
                }
            }else{
                $message = 'Access denied. This action is not authorized!';
                return response()->json(array(
                    'success' => true,
                    'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                ), 403);
            }
        }else{
            $message = 'Record Does not exist';
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 404);
        }
    }

    public function TogglePostStatus(Request $request,$id)
    {
        $post = $this->model::find($id);
        if($post){
            if($this->CheckPostAccess($post)){
                if(auth()->user()->can('posts-status')){
                    if($post->status == true){
                        $post->status = false;
                        $post->save();
                        $message = 'Post "'.$post->title.'" status was changed to In-active';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }else{
                        $post->status = true;
                        $post->save();
                        $message = 'Post "'.$post->title.'" status was changed to Active';
                        return response()->json(array(
                            'success' => true,
                            'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
                        ), 200);
                    }
                }
                else{
                    $message = 'Access denied. This action is not authorized!';
                    return response()->json(array(
                        'success' => true,
                        'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                    ), 403);
                }
            }else{
                $message = 'Access denied. This action is not authorized!';
                return response()->json(array(
                    'success' => true,
                    'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
                ), 403);
            }
        }else{
            $message = 'Record Does not exist';
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 404);
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
            'status' => $post->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">In-active</span>',
            'featured' => $post->featured ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
            'published' => $post->published ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
            'Updated By' => $post->updated_by ? $post->updatedBy->name : '<span class="label label-danger">Not Set</span>',
            'created_at' => date('l M j, Y h:i A', strtotime($post->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $post->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($post->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $post->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        unset($rows['category_id'],$rows['id'],$rows['user_id'],$rows['updated_by'],$rows['task_id']);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows','post'));
    }

    public function CheckPostAccess($post)
    {
        if(auth()->user()->can('posts-list-all')){
            return true;
        }else{
            if($post->user_id == auth()->user()->id){
                return true;
            }else{
                return false;
            }
        }
    }
}
