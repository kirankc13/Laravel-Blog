<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public $model;
    public $base_view;
    public function __construct(Role $role)
    {
         $this->model = $role;
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
         $this->data = [
             'base_route' => 'roles',
             'base_role'=>'roles',
             'panel_name' => 'Roles',
             'name' => 'roles',
             'columns' => $this->model->getColumns(),
             'icon' => '<i class="fas fa-user-tag"></i>'
        ];
        $this->base_view = 'user::roles';
    }

    public function index(Request $request)
    {
        $data = $this->data;
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $route = route($data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax()
    {
        $all_data = $this->model::select(['id','name','created_at']);
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
        $permission = Permission::all()->toArray();
        $collection = collect($permission);
        $grouped = $collection->groupBy('module')->toArray();
        $permission_array = [];
        foreach($grouped as $key => $val){
            $array = collect($val);
            $permission_array[$key] = $array->groupBy('group')->toArray();
        }
        return view(parent::LoadView($this->base_view.'.create'),compact('permission_array'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get()
            ->groupBy('group');
        return view(parent::LoadView($this->base_view.'.show'),compact('rolePermissions','role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::all()->toArray();
        $collection = collect($permission);
        $grouped = $collection->groupBy('module')->toArray();
        $permission_array = [];
        foreach($grouped as $key => $val){
            $array = collect($val);
            $permission_array[$key] = $array->groupBy('group')->toArray();
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view(parent::LoadView($this->base_view.'.edit'),compact('role','permission_array','rolePermissions'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        if($role->name == 'superadmin')
        {
            return redirect()->route('roles.index')->with('error','Superadmin role cannot be updated');
        }
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $role= Role::find($request->id);
        if($role->name == 'superadmin')
        {
            return response()->json(['success' => false]);
        }
        DB::table("roles")->where('id',$request->id)->delete();
    }
}
