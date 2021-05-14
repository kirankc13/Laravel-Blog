<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getColumns()
    {
        return [
            'Subject' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'subject',
                'data' => 'subject'
            ],
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
            'Created At' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'data' => 'created_at',
                'name' => 'created_at'
            ],
        ];
    }

}
