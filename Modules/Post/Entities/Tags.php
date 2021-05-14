<?php

namespace Modules\Post\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Entities\PostTasks;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','status','parent_id','added_by'];

    public function getColumns()
    {

        $array = [
            'Name' => [
                'type' => 'text',
                'orderable' => true,
                'searchable' => true,
                'name' => 'name',
                'data' => 'name'
            ],
            'Posts' => [
                'type' => 'none',
                'orderable' => false,
                'searchable' => false,
                'name' => 'posts_count',
                'data' => 'posts_count'
            ],
            'Created At' => [
                'type' => 'date',
                'orderable' => true,
                'searchable' => true,
                'name' => 'created_at',
                'data' => 'created_at'
            ],
        ];

        return $array;

    }

    public function posts()
    {
        return $this->belongsToMany(PostTasks::class,'post_tag','tag_id','post_id');
    }

    public function paginatePosts()
    {
        return $this->belongsToMany(PostTasks::class,'post_tag','tag_id','post_id')->paginate(10);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'added_by');
    }
}
