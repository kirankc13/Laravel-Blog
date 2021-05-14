<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    protected static $logAttributes = ['name','email','password'];
    protected static $logName = 'User';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User was {$eventName}";
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about',
        'image',
        'status',
        'display_name',
        'username',
        'facebook',
        'twitter',
        'website',
        'linkedin',
        'instagram'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getColumns()
    {
        return [
            'Name' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'name',
                'data' => 'name'
            ],
            'Email' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'email',
                'data' => 'email'
            ],
            'Roles' => [
                'type' => 'none',
                'orderable' => false,
                'searchable' => false,
                'name' => 'roles',
                'data' => 'roles'
            ],
            'Status' => [
                'type' => 'status_yn',
                'orderable' => true,
                'searchable' => true,
                'name' => 'status',
                'data' => 'status'
            ],
            'Created At' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'name' => 'created_at',
                'data' => 'created_at'
            ],
        ];
    }
}
