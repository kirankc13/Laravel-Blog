<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','meta_title','meta_desc','summary','status','description','hits','image'];

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
            'Hits' => [
                'type' => 'hits',
                'orderable' => true,
                'searchable' => true,
                'name' => 'hits',
                'data' => 'hits'
            ],
            'Created At' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'data' => 'created_at',
                'name' => 'created_at'
            ],
            'Updated At' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'data' => 'updated_at',
                'name' => 'updated_at'
            ],
        ];
    }

}
