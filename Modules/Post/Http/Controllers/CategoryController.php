<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Post\Entities\Category;
use Modules\Post\Http\Requests\CreateCategoryRequest;
use Modules\Post\Http\Requests\UpdateCategoryRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->data = [
            'base_route' => 'categories',
            'base_role'=>'categories',
            'panel_name' => 'Category',
            'name' => 'categories',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-widget"></i>',
            'order' => 0,
            'order_by' => 'desc'
        ];
        $this->middleware('permission:categories-list|categories-create|categories-edit|categories-delete|categories-data', ['only' => ['index','store']]);
        $this->middleware('permission:categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:categories-show', ['only' => ['show']]);
        $this->middleware('permission:categories-order', ['only' => ['OrderBy']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
        $this->base_view = 'post::categories';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $categories = $this->model::select(['id','order','title','slug','summary','parent_id','featured','created_at']);
        $datatables =  DataTables::of($categories)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('order',function($val){
                return '<i class="fa fa-sort"></i> '.$val->order;
            })
            ->editColumn('title', function ($val) {
                if($val->parent_id != null){
                    return $val->title .' <span class="label label-pill label-primary">'.$val->parent->title.'</span>';
                }else{
                    return $val->title;
                }
            })
            ->editColumn('posts_count', function ($val) {
                return '<span class="label label-pill label-primary">'.$val->posts()->count().'</span>';
            })
            ->editColumn('featured', function ($val) {
                if($val->featured){
                    return '<span class="label label-pill label-primary">Yes</span>';
                }else{
                    return '<span class="label label-pill label-danger">No</span>';
                }
            })
            ->editColumn('summary', function ($val) {
                return Str::limit($val->summary,30);
            })

            ->addIndexColumn()
            ->escapeColumns('posts_count');
            return $datatables->make(true);
    }

    public function create()
    {
        $parent_categories = $this->model::all()->pluck('title','id')->prepend('Select a category', '')->toArray();
        return view(parent::LoadView($this->base_view.'.create'),compact('parent_categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input['featured'] = $request->has('featured') ? 1 : 0;
        $input['status'] = $request->has('status') ? 1 : 0;
        $category = new $this->model;
        if($request->has('image')){
            $path = $this->UploadFile('categories',$request->file('image'));
            $input['image'] = $path;
        }
        $category->create($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' created successfully');
    }

    public function edit(Request $request,$id)
    {
        $category = $this->model::find($id);
        $parent_categories = $this->model::where('id','!=',$id)->pluck('title','id')->prepend('Select category', '')->toArray();
        return view(parent::LoadView($this->base_view.'.edit'),compact('category','parent_categories'));
    }

    public function update(UpdateCategoryRequest $request,$id)
    {
        $input = $request->all();
        if(auth()->user()->can('categories-slug-editing')){
            $this->validate($request, [
                'slug' => 'sometimes|unique:categories,slug,'.$id
            ]);
        }else{
            if($request->has('slug')){
                return redirect()->back()->with('error','Invalid request');
            }
        }
        $input['featured'] = $request->has('featured') ? 1 : 0;
        $input['status'] = $request->has('status') ? 1 : 0;
        $category = $this->model::find($id);
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            $path = $this->UploadFile('categories',$request->file('image'));
            $input['image'] = $path;
        }else{
            $input['image'] = $category->image;
        }
        $category->update($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' updated successfully');
    }

    public function destroy(Request $request)
    {
        $this->model::find($request->id)->delete();
        return true;
    }

    public function OrderBy(Request $request)
    {
        try {
            $items = $request->get('order');
            foreach ($items as $key => $item) {
                $rank = $key + 1;
                Category::where('id', $item)->update(['order' => $rank]);
                $message = "Category Sorted Successfully";
            }
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.success_ajax_messages",compact('message'))->render()
            ), 200);

        } catch (Exception $e) {
            Log::info('exception',$e->getMessage());
            $message = 'Something went wrong';
            return response()->json(array(
                'success' => true,
                'view' => view("admin.components.error_ajax_messages",compact('message'))->render()
            ), 404);
        }

    }

    public function show($id)
    {
        $row = $this->model::find($id);
        $row_data = $row->toArray();
        $modified_data = [
            'posts_count' => $row->posts->count(),
            'image' => '<img src="'.render($row->image).'" style="height:100px; width:100px;">',
            'parent' => $row->parent_id ? $row->parent->name : '<span class="label label-pill label-danger">Not Set</span>',
            'status' => $row->status ? 'Active' : 'In-active',
            'featured' => $row->status ? 'Yes' : 'No',
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        unset($rows['parent_id'],$rows['id']);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }
}
