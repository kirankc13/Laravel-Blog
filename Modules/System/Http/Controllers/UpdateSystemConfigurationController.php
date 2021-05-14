<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\System\Entities\ConfigurationField;
use Modules\System\Entities\SystemConfiguration;

class UpdateSystemConfigurationController extends Controller
{
    public $model;
    public $data;
    public $base_view;
    public function __construct(ConfigurationField $configurationField)
    {
        $this->model = $configurationField;
        $this->data = [
            'base_route' => 'configuration-update',
            'base_role'=>'configuration-update',
            'panel_name' => 'Configuration Update',
            'name' => 'configuration-update',
            'icon' => '<i class="font-icon font-icon-cogwheel"></i>'
        ];
        $this->middleware('permission:configuration-update-list', ['only' => ['index']]);
        $this->middleware('permission:configuration-update-update', ['only' => ['update']]);
        $this->base_view = 'system::configuration_update';
    }

    public function index()
    {
        if(isSuperAdmin(auth()->user()->id)){
            $config_fields = ConfigurationField::leftjoin('system_configurations','configuration_fields.key','system_configurations.config_key')->get();
        }else{
            $config_fields = ConfigurationField::leftjoin('system_configurations','configuration_fields.key','system_configurations.config_key')->where('for_developer',0)->get();
        }
        $collection = collect($config_fields);
        $field_types = $collection->groupBy('group');
        return view(parent::LoadView($this->base_view.'.index'),compact('field_types'));
    }

    public function update(Request $request)
    {
        if(isSuperAdmin(auth()->user()->id)){
            $all_configurations = ConfigurationField::all();
        }else{
            $all_configurations = ConfigurationField::where('for_developer',0)->get();
        }
        foreach($all_configurations as $c){
            if($c->field_type == 'text_box' || $c->field_type == 'text_area' || $c->field_type == 'rich_text_box' || $c->field_type == 'radio_button' || $c->field_type == 'select_dropdown' || $c->field_type == 'number'){
                if($request->has($c->key)){
                    $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                    if($configuration){
                        $configuration->config_value = $request->get($c->key);
                        $configuration->save();
                    }else{
                        $configuration = new SystemConfiguration();
                        $configuration->config_key = $c->key;
                        $configuration->config_value = $request->get($c->key);
                        $configuration->save();
                    }
                }
            }
            elseif($c->field_type == 'checkbox'){
                $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                if($configuration){
                    $configuration->config_value = $request->has($c->key) ? true : false;
                    $configuration->save();
                }else{
                    $configuration = new SystemConfiguration();
                    $configuration->config_key = $c->key;
                    $configuration->config_value = $request->has($c->key) ? true : false;
                    $configuration->save();
                }
            }
            elseif($c->field_type == 'multiple_checkbox'){
                $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                if($configuration){
                    $configuration->config_value = $request->get($c->key) ? json_encode($request->get($c->key)) : null;
                    $configuration->save();
                }else{
                    $configuration = new SystemConfiguration();
                    $configuration->config_key = $c->key;
                    $configuration->config_value = $request->get($c->key) ? json_encode($request->get($c->key)) : null;
                    $configuration->save();
                }
            }
            elseif($c->field_type == 'file'){
                $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                if($request->has($c->key)){
                    $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                    $this->validate($request, [
                        $c->key => 'mimes:docx,doc,ppt,pptx,pdf,html,jpeg,png,png.webp',
                    ]);
                    $now = Carbon::now();
                    $file = $request->file($c->key);
                    $filename = $file->getClientOriginalName();
                    $folder = $now->format('M').'-'.$now->year;
                    $file_path = 'settings/'.$folder.'/';
                    $actual_path = 'settings/'.$folder.'/'.$filename;
                    $file->storeAs($file_path, $filename);
                    if($configuration){
                        $configuration->config_value = $actual_path;
                        $configuration->save();
                    }else{
                        $configuration = new SystemConfiguration();
                        $configuration->config_key = $c->key;
                        $configuration->config_value = $actual_path;
                        $configuration->save();
                    }
                }
            }elseif($c->field_type == 'image'){
                $configuration = SystemConfiguration::where('config_key',$c->key)->first();
                if($request->has($c->key)){
                    $this->validate($request, [
                        $c->key => 'mimes:jpeg,png,jpg,gif,svg,webp',
                    ]);
                    $now = Carbon::now();
                    $file = $request->file($c->key);
                    $filename = $file->getClientOriginalName();
                    $folder = $now->format('M').'-'.$now->year;
                    $file_path = 'settings/'.$folder.'/';
                    $actual_path = 'settings/'.$folder.'/'.$filename;
                    $file->storeAs($file_path, $filename);
                    if($configuration){
                        $configuration->config_value = $actual_path;
                        $configuration->save();
                    }else{
                        $configuration = new SystemConfiguration();
                        $configuration->config_key = $c->key;
                        $configuration->config_value = $actual_path;
                        $configuration->save();
                    }
                }
            }
        }
        return redirect()->route($this->data['base_route'].'.index')->with('success','Configurations were updated successfully');

    }

    public function DestroyFile(Request $request)
    {
        $configuration = SystemConfiguration::where('config_key',$request->get('key'))->first();
        if($configuration){
            if($configuration->config_value){
                $configuration->config_value = null;
                $configuration->save();
                return response(['sucess',200]);
            }else{
                return response(['error',400]);
            }
        }
        return response(['error',400]);
    }
}
