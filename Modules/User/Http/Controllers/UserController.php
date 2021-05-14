<?php

namespace Modules\User\Http\Controllers;


use Nwidart\Modules\Facades\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Modules\User\Rules\ValidationOldPassword;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(User $user)
    {
        $this->model = $user;
        $this->data = [
            'base_route' => 'users',
            'base_role'=>'user',
            'panel_name' => 'Users',
            'name' => 'users',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-user"></i>
        '];
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->base_view = 'user::users';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $users = User::select(['id','name', 'email','created_at','status']);
        $datatables =  Datatables::of($users)
            ->addColumn('action', function ($user) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('user','data'))->render();
            })
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function($role) {
                    return '<span class="label label-pill label-primary">'.$role->name.'</span>';
                })->implode('<br>');
            })
            ->editColumn('status', function ($user) {
                if($user->status){
                    return '<span class="label label-pill label-primary">Active</span>';
                }else{
                    return '<span class="label label-pill label-danger">Inactive</span>';
                }

            })
            ->editColumn('created_at', function ($user) {
                $created_at = Carbon::parse($user->created_at);
                return '<span class="label label-pill label-primary">'.date_format($created_at,'F d, Y').'</span>';
            })
            ->addIndexColumn()
            ->escapeColumns('roles');
            return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name','!=','superadmin')->pluck('name','name')->all();
        return view(parent::LoadView($this->base_view.'.create'),compact('roles'));
    }

    public function ChangePasswordForm()
    {
        return view('users.change_password');
    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new ValidationOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back()->with('success','Password Changes Successfully');
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $roles = [];
        $roles = $request->input('roles');
        $roles = array_diff($roles, array("superadmin"));
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($roles);
        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view(parent::LoadView($this->base_view.'.show'),compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userRole = $user->roles->pluck('name','name')->all();
        if(in_array('superadmin',$userRole)){
            $roles = Role::pluck('name','name')->all();
        }else{
            $roles = Role::where('name','!=','superadmin')->pluck('name','name')->all();
        }
        return view(parent::LoadView($this->base_view.'.edit'),compact('user','roles','userRole'));
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
            'email' => 'required|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, ['password','roles']);
        }

        $user = User::find($id);
        $user_role = $user->getRoleNames()->toArray();
        if(in_array('superadmin',$user_role))
        {
            $role = Role::where('name','superadmin')->first();
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->update($input);
        }else{
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $input['status'] = $request->has('status') ? 1 : 0;
            $user->assignRole($request->input('roles'));
            $user->update($input);
        }
        if(in_array('superadmin',$user_role)){
            return redirect()->route('users.index')->with('success','User updated but roles were unaffected because the user is a root user');
        }else{
            return redirect()->route('users.index')->with('success','User updated successfully');
        }
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user_role = $user->getRoleNames()->toArray();
        if(in_array('superadmin',$user_role))
        {
            return response()->json(['success' => false]);
        }
        DB::table("users")->where('id',$request->id)->delete();
    }


}
