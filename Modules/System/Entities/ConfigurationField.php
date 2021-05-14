<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class ConfigurationField extends Model
{
    use HasFactory, LogsActivity;
    protected static $logAttributes = ['title','key','configuration_type','group','field_type','options','detail','user_configurable','status','for_developer','enable_view_for_user'];
    protected static $logName = 'Configuration Field';  
    protected $fillable = ['title','key','configuration_type','group','field_type','options','detail','user_configurable','status','for_developer','enable_view_for_user'];    
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Configuration Field was {$eventName}";
    }

    public function getColumns()
    {
        return [
            'Title' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'title',
                'data' => 'title'
            ],            
            'Config Key' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'key',
                'data' => 'key'
            ],            
            'Group' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'group',
                'data' => 'group'
            ],
        ];
    }
 
}
