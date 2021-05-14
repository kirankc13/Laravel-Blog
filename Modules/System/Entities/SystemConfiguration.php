<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class SystemConfiguration extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = ['config_key','config_value','status'];
    protected static $logName = 'System Configuration';  

    public function getDescriptionForEvent(string $eventName): string
    {
        return "System Configuration was {$eventName}";
    }
}
