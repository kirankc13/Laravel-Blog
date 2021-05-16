<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\System\Entities\ConfigurationField;
use Yajra\DataTables\DataTables;

class ConfigurationFieldController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(ConfigurationField $configurationField)
    {
        $this->model = $configurationField;
        $this->data = [
            'base_route' => 'configuration-fields',
            'base_role'=>'configuration-fields',
            'panel_name' => 'Configuration Field',
            'name' => 'configuration_fields',
            'columns' => $this->model->getColumns(),
            'icon' => '<i class="font-icon font-icon-cogwheel"></i>'
        ];
        $this->middleware('permission:configuration-fields-list|configuration-fields-create|configuration-fields-edit|configuration-fields-delete', ['only' => ['index','store']]);
        $this->middleware('permission:configuration-fields-create', ['only' => ['create','store']]);
        $this->middleware('permission:configuration-fields-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:configuration-fields-delete', ['only' => ['destroy']]);
        $this->base_view = 'system::configuration_fields';
    }

    public function index(Request $request)
    {
        $route = route($this->data['base_route'].'.data');
        return view(parent::LoadView($this->base_view.'.index'),compact('route'));
    }

    public function DatatableAjax(Request $request)
    {
        $users = $this->model::select(['id','title','key','configuration_type','field_type','group']);
        $datatables =  DataTables::of($users)
            ->editColumn('title', function ($val) {
                if($val->configuration_type == 'system_config'){
                    return '<i class="font-icon font-icon-cogwheel"></i> '.$val->title;
                }else{
                    return '<i class="font-icon font-icon-user"></i> '.$val->title;
                }
            })
            ->addColumn('action', function ($val) {
                $data = $this->data;
                return view($this->base_view.".components.action_buttons",compact('val','data'))->render();
            })
            ->addIndexColumn()
            ->escapeColumns('title');
            return $datatables->make(true);
    }

    public function create()
    {
        $group = ConfigurationField::select('group')->distinct()->get()->toArray();
        $group_array = [];
        foreach($group as $val){
            $group_array[$val['group']] = $val['group'];
        }
        return view(parent::LoadView($this->base_view.'.create'))->with("group_array",$group_array);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'key' => 'required|unique:configuration_fields',
            'configuration_type' => 'required|in:system_config,user_config',
            'field_type' => 'required|in:text_box,number,text_area,rich_text_box,checkbox,multiple_checkbox,radio_button,select_dropdown,image,file',
            'group' => 'required',
            'user_configurable' => "in:1",
            'enable_view_for_user' => "in:1",
            'status' => "in:1",
        ]);

        $input = $request->all();
        if(isSuperAdmin(auth()->user()->id)){
            $this->validate($request, [
                'for_developer' => 'in:1',
            ]);
        }else{
            if(isset($input['for_developer'])){
                return redirect()->back()->with('error',"Invalid request");
            }
        }

        $input['for_developer'] = $request->has('for_developer') ? 1 : 0;
        $input['for_developer'] = $request->has('for_developer') ? 1 : 0;
        $input['enable_view_for_user'] = $request->has('enable_view_for_user') ? 1 : 0;
        $input['status'] = $request->has('status') ? 1 : 0;

        $config_field_type = new $this->model;
        if($request->field_type == 'radio_button' || $request->field_type == 'select_dropdown' || $request->field_type == 'multiple_checkbox' || $request->field_type == 'checkbox'){
            $input['options'] = $request->options;
        }else{
            $input['options'] = null;
        }
        $config_field_type->create($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' created successfully');
    }

    public function show($id)
    {
        $row = $this->model::find($id);
        unset($row['id']);
        $row_data = $row->toArray();
        $modified_data = [
            'status' => $row->status ? 'Active' : 'In-active',
            'for_developer' => $row->for_developer ? 'Yes' : 'No',
            'user_configurable' => $row->user_configurable ? 'Yes' : 'No',
            'enable_view_for_user' => $row->enable_view_for_user ? 'Yes' : 'No',
            'created_at' => date('l M j, Y h:i A', strtotime($row->created_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->created_at->diffForHumans().')</i></b>',
            'updated_at' => date('l M j, Y h:i A', strtotime($row->updated_at)).' <b><i style="font-size: 12px; color: #ed1c24;">('. $row->updated_at->diffForHumans().')</i></b>',
        ];
        $rows = array_merge($row_data,$modified_data);
        return view(parent::LoadView($this->base_view.'.show'),compact('rows'));
    }

    public function edit($id)
    {
        $config_field_type = $this->model::find($id);
        $group = ConfigurationField::select('group')->distinct()->get()->toArray();
        $group_array = [];
        foreach($group as $val){
            $group_array[$val['group']] = $val['group'];
        }
        return view(parent::LoadView($this->base_view.'.edit'),compact('group_array','config_field_type'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'key' => 'unique:configuration_fields,key,'.$id,
            'configuration_type' => 'required|in:system_config,user_config',
            'field_type' => 'required|in:text_box,number,text_area,rich_text_box,checkbox,multiple_checkbox,radio_button,select_dropdown,image,file',
            'group' => 'required',
            'user_configurable' => "in:1",
            'enable_view_for_user' => "in:1",
            'status' => "in:1",
        ]);

        $input = $request->all();
        if(isSuperAdmin(auth()->user()->id)){
            $this->validate($request, [
                'for_developer' => 'in:1',
            ]);
        }else{
            if(isset($input['for_developer'])){
                return redirect()->back()->with('error',"Invalid request");
            }
        }
        $config_field_type = $this->model::find($id);

        if($request->field_type == 'radio_button' || $request->field_type == 'select_dropdown' || $request->field_type == 'multiple_checkbox' || $request->field_type == 'checkbox'){
            $input['options'] = $request->options;
        }else{
            $input['options'] = null;
        }
        $input['key'] = $request->key ? $request->key : $config_field_type->key;
        $input['for_developer'] = $request->has('for_developer') ? 1 : 0;
        $input['for_developer'] = $request->has('for_developer') ? 1 : 0;
        $input['enable_view_for_user'] = $request->has('enable_view_for_user') ? 1 : 0;
        $input['status'] = $request->has('status') ? 1 : 0;
        $config_field_type->update($input);
        return redirect()->route($this->data['base_route'].'.index')
        ->with('success',$this->data['panel_name'].' updated successfully');
    }

    public function destroy(Request $request)
    {
        $this->model::find($request->id)->delete();
        return true;
    }
}
