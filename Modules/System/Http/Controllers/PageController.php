<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\System\Entities\Page;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Page $page)
    {
        $this->model = $page;
        $this->data = [
            'base_route' => 'pages',
            'base_role'=>'pages',
            'panel_name' => 'Page',
            'name' => 'pages',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="glyphicon glyphicon-duplicate"></i>'
        ];
        $this->middleware('permission:pages-list|pages-create|pages-edit|pages-delete', ['only' => ['index','store']]);
        $this->middleware('permission:pages-create', ['only' => ['create','store']]);
        $this->middleware('permission:pages-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:pages-delete', ['only' => ['destroy']]);
        $this->base_view = 'system::pages';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $users = $this->model::select(['id','title','slug','hits','created_at','updated_at']);
        $datatables =  DataTables::of($users)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('created_at', function ($val) {
                $created_at = Carbon::parse($val->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y g:i A').'</span>';
            })
            ->editColumn('updated_at', function ($val) {
                $updated_at = Carbon::parse($val->updated_at);
                return '<span class="label label-pill label-primary">'.date_format($updated_at,'F d, Y g:i A').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('title');
            return $datatables->make(true);
    }

    public function create()
    {
        return view(parent::LoadView($this->base_view.'.create'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:pages,title',
            'slug' => 'required|unique:pages,slug',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'summary' => 'required',
            'status' => 'in:1',
            'image' => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $category = new $this->model;
        if($request->hasFile('image')){
            $path = $this->UploadFile('pages',$request->file('image'));
            $input['image'] = $path;
        }
        $category->create($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' created successfully');
    }

    public function show($id)
    {
        $row = $this->model::find($id);
        unset($row['id']);
        $row_data = $row->toArray();
        $modified_data = [
            'image' => '<img height="100" width="100" src="'.render($row->image).'"/>',
            'status' => $row->status ? 'Active' : 'In-active',
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }

    public function edit($id)
    {
        $page = $this->model::find($id);
        return view(parent::LoadView($this->base_view.'.edit'),compact('page'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'key' => 'unique:configuration_fields,key,'.$id,
            'title' => 'required|unique:pages,title,'.$id,
            'slug' => 'required|unique:pages,slug,'.$id,
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'summary' => 'required',
            'status' => 'in:1',
        ]);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $category = $this->model::find($id);
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'sometimes|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);
            $path = $this->UploadFile('pages',$request->file('image'));
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
}
