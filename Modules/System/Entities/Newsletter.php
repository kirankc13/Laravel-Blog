<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getColumns()
    {
        return [
            'Email' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'email',
                'data' => 'email'
            ],
            'IP' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'ip',
                'data' => 'ip'
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
