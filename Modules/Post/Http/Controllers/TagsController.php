<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Post\Entities\Tags;
use Yajra\DataTables\DataTables;
use Modules\Post\Http\Requests\CreateTagsRequest;
use Modules\Post\Http\Requests\UpdateTagsRequest;

class TagsController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(Tags $tags)
    {
        $this->model = $tags;
        $this->data = [
            'base_route' => 'tags',
            'base_role'=>'tags',
            'panel_name' => 'Tags',
            'name' => 'tags',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="glyphicon glyphicon-tag"></i>',
            'order' => 2,
            'order_by' => 'desc'
        ];
        $this->middleware('permission:tags-list|tags-create|tags-edit|tags-delete|tags-data', ['only' => ['index','store']]);
        $this->middleware('permission:tags-create', ['only' => ['create','store']]);
        $this->middleware('permission:tags-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tags-delete', ['only' => ['destroy']]);
        $this->base_view = 'post::tags';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $tags = $this->model::select(['id','name','created_at']);
        $datatables =  DataTables::of($tags)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('name', function ($val) {
                return $val->name;

            })
            ->editColumn('posts_count', function ($val) {
                return '<span class="label label-pill label-primary">'.$val->posts()->count().'</span>';
            })
            ->editColumn('created_at', function ($val) {
                $created_at = Carbon::parse($val->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y g:i A').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('titles_count');
            return $datatables->make(true);
    }

    public function create()
    {
        return view(parent::LoadView($this->base_view.'.create'));
    }

    public function store(CreateTagsRequest $request)
    {

        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $input['added_by'] = auth()->user()->id;
        $topics = new $this->model;
        $topics->create($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' created successfully');
    }

    public function edit(Request $request,$id)
    {
        $topic = $this->model::find($id);
        return view(parent::LoadView($this->base_view.'.edit'),compact('topic'));
    }

    public function update(UpdateTagsRequest $request,$id)
    {
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $topics = $this->model::find($id);
        $topics->update($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' updated successfully');
    }

    public function show($id)
    {
        $row = $this->model::find($id);
        $row_data = $row->toArray();
        $modified_data = [
            'added_by' => $row->users->name,
            'status' => $row->status ? 'Active' : 'In-active',
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        unset($rows['id']);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }

    public function destroy(Request $request)
    {
        $this->model::find($request->id)->delete();
        DB::table('post_tag')->where('tag_id',$request->id)->delete();
        return true;
    }

}
