<?php

namespace Modules\Post\Entities;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Entities\Tags;
use Spatie\Activitylog\Traits\LogsActivity;

class PostTasks extends Model
{
    use HasFactory,LogsActivity;

    protected static $logAttributes = ['title','slug','meta_title','description','meta_desc','summary','category_id','featured_image','user_id','tags','sub_title','task_status'];
    protected static $logName = 'Task';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Task was {$eventName}";
    }

    protected $table = "post_tasks";

    protected $fillable = ['title','slug','meta_title','description','meta_desc','summary','category_id','featured_image','user_id','tags','sub_title','task_status'];

    public function getColumns()
    {
        return [
            'Category' => [
                'type' => 'small-text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'categories.title',
                'data' => 'category_title'
            ],
            'Title' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'title',
                'data' => 'title'
            ],
            'Status' => [
                'type' => 'status_task',
                'orderable' => true,
                'searchable' => true,
                'name' => 'task_status',
                'data' => 'task_status'
            ],
            'User' => [
                'type' => 'small-text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'users.name',
                'data' => 'username'
            ],
            'Last Updated' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'name' => 'updated_at',
                'data' => 'updated_at'
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function postTags()
    {
        return $this->belongsToMany(Tags::class,'post_tag','post_id','tag_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User','updated_by');
    }

}
