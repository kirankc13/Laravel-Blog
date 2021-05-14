<?php

use App\Models\User;
use Modules\System\Entities\SystemConfiguration;

function setting($key){
        $configuration = SystemConfiguration::join('configuration_fields','configuration_fields.key','system_configurations.config_key')->where('system_configurations.config_key',$key)->select('system_configurations.*','configuration_fields.field_type as field_type')->first();
        if($configuration){
            if($configuration->config_value){
                if($configuration->field_type == 'image' || $configuration->field_type == 'file'){
                    return asset('storage/'.$configuration->config_value);
                }else{
                    return $configuration->config_value;
                }
            }
        }
        else{
            return null;
        }
    }

function isSuperAdmin($user_id){
    $user = User::find($user_id);
    if($user){
        $user_role = $user->getRoleNames()->toArray();
        if(in_array('superadmin',$user_role)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function render($url){
    return asset('storage'.'/'.$url);
}

function agent(){
    $agent = new \Jenssegers\Agent\Agent;
    return $agent;
}

function GetPercentageIncDec($current,$previous)
{
    $change = $current - $previous;
    $perentage = ($change / $previous) * 100;
    return (int)$perentage;
}

?>