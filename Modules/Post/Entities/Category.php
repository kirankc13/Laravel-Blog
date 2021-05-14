<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory,LogsActivity;

    protected static $logAttributes = ['title','slug','meta_title','meta_desc','summary','featured','status','parent_id','image'];
    protected static $logName = 'Category';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Category was {$eventName}";
    }

    protected $fillable = ['title','slug','meta_title','meta_desc','summary','featured','status','parent_id','image'];

    public function getColumns()
    {
        return [
            '#' => [
                'type' => 'none',
                'orderable' => true,
                'searchable' => false,
                'name' => 'order',
                'data' => 'order'
            ],
            'Title' => [
                'type' => 'small-text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'title',
                'data' => 'title'
            ],
            'Posts' => [
                'type' => 'none',
                'orderable' => false,
                'searchable' => false,
                'name' => 'posts_count',
                'data' => 'posts_count'
            ],
            'Featured?' => [
                'type' => 'status_yn',
                'orderable' => true,
                'searchable' => true,
                'name' => 'featured',
                'data' => 'featured'
            ],
            'Summary' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'summary',
                'data' => 'summary'
            ],
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postTasks()
    {
        return $this->hasMany(PostTasks::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('featured',1);
    }

}
