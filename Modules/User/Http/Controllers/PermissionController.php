<?php

namespace Modules\User\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{

    public $model;
    public $base_view;
    public function __construct(Permission $permission)
    {
         $this->model = $permission;
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
         $this->data = [
             'base_route' => 'permissions',
             'base_role'=>'permission',
             'panel_name' => 'Permission',
             'name' => 'permissions',
             'columns' => $this->model->getColumns(),
             'icon' => '<i class="fas fa-user-tag"></i>'
        ];
        $this->base_view = 'user::permissions';
    }

    public function index(Request $request)
    {
        $data = $this->data;
        $roles = $this->model::orderBy('id','DESC')->paginate(5);
        $route = route($data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax()
    {
        $all_data = $this->model::select(['id','name','module','group','created_at']);
        $datatables =  DataTables::of($all_data)
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->editColumn('created_at', function ($val) {
                $created_at = Carbon::parse($val->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('status');
        return $datatables->make(true);
    }

    public function create()
    {
        $modules = Module::all();
        $module_array = [];
        foreach($modules as $key => $val){
            $module_array[$key] = $key;
        }
        $permission_distinct = Permission::select('group')->distinct()->get()->toArray();
        $group_array = [];
        foreach($permission_distinct as $val){
            $group_array[$val['group']] = $val['group'];
        }
        return view(parent::LoadView($this->base_view.'.create'),compact('module_array','group_array'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'group' => 'required',
            'module' => 'required',
        ]);
        $this->model::create(['name' => $request->input('name'),'group'=>$request->input('group'),'module'=>$request->input('group')]);
        return redirect()->route($this->data['base_route'].'.index')
                        ->with('success',$this->data['panel_name'].' created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = $this->model::find($id);
        $row_data = $row->toArray();
        $modified_data = [
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->model::find($id);
        $modules = Module::all();
        $module_array = [];
        foreach($modules as $key => $val){
            $module_array[$key] = $key;
        }
        $permission_distinct = Permission::select('group')->distinct()->get()->toArray();
        $group_array = [];
        foreach($permission_distinct as $val){
            $group_array[$val['group']] = $val['group'];
        }
        return view(parent::LoadView($this->base_view.'.edit'),compact('permission','module_array','group_array'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,'.$id,
            'group' => 'required',
            'module' => 'required',
        ]);

        $input = $request->all();
        $permission = $this->model::find($id);
        $permission->update($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->model::find($request->id)->delete();
        return true;
    }
}
