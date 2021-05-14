<?php

namespace Modules\Post\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use HasFactory,LogsActivity;

    protected static $logAttributes = ['title','slug','meta_title','description','meta_desc','summary','featured','status','category_id','featured_image','user_id','hits','tags','published','sub_title'];
    protected static $logName = 'Published Post';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Published Post was {$eventName}";
    }

    protected $fillable = ['title','slug','meta_title','description','meta_desc','summary','featured','status','category_id','featured_image','user_id','hits','tags','published','sub_title'];

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
            'Hits' => [
                'type' => 'none',
                'orderable' => true,
                'searchable' => false,
                'name' => 'hits',
                'data' => 'hits'
            ],
            'Published' => [
                'type' => 'status_yn',
                'orderable' => true,
                'searchable' => true,
                'name' => 'published',
                'data' => 'published'
            ],
            'Status' => [
                'type' => 'status',
                'orderable' => true,
                'searchable' => true,
                'name' => 'status',
                'data' => 'status'
            ],
            'Featured' => [
                'type' => 'status_yn',
                'orderable' => true,
                'searchable' => true,
                'name' => 'featured',
                'data' => 'featured'
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function postTags()
    {
        return $this->belongsToMany(Tags::class,'post_tag','post_id','tag_id');
    }

    public function getEstimatedTimeAttribute()
    {
        $words = str_word_count( strip_tags( $this->description ) );
        $minutes = floor( $words / 120 );
        $seconds = floor( $words % 120 / ( 120 / 60 ) );

        if ( 1 <= $minutes ) {
            $estimated_time = $minutes . ' Min' . ($minutes == 1 ? '' : 's') . ' read';
        } else {
            $estimated_time = $seconds . ' second' . ($seconds == 1 ? '' : 's') . ' read';
        }

        return $estimated_time;

    }

}
