<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\System\Entities\SystemConfiguration;
use Modules\Topic\Entities\Topic;
use Illuminate\Support\Str;
use Modules\Post\Entities\PostTasks;
use Modules\System\Entities\Newsletter;
use Stevebauman\Location\Facades\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FrontController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function LoadView($view_path)
    {
        View::composer($view_path, function ($view) {
            $view->with('base_view', $this->base_view);
            $view->with('settings', $this->settings);
        });
        return $view_path;
    }

    public function FormatCategory($categories)
    {
        $object_array = [];
        foreach($categories as $c)
        {
            $object = new \stdClass();
            $object->id = $c->id;
            $object->title = $c->title;
            $object->slug = $c->slug;
            $object->meta_title = $c->meta_title;
            $object->url = route('category',$c->slug);
            $object->image = render($c->image);
            $children = [];
            if(count($c->children) > 0){
                foreach($c->children as $c){
                    $child_object = new \stdClass();
                    $child_object->id = $c->id;
                    $child_object->title = $c->title;
                    $child_object->slug = $c->slug;
                    $child_object->meta_title = $c->meta_title;
                    $child_object->url = route('category',$c->slug);
                    $child_object->image = render($c->image);
                    $children[] = $child_object;
                }
                $object->child = $children;
            }else{
                $object->child = null;
            }
            $object_array[] = $object;
        }

        return $object_array;
    }

    public function AddToCategory()
    {
        DB::table('categories')->truncate();
        $data= DB::table('favcategories')->get();
        foreach($data as $d){
            $category=new Category();
            $category->id = $d->id;
            $category->title = $d->name;
            $category->slug = $d->slug;
            $category->image = $d->image;
            $category->summary = $d->description;
            $category->order = $d->position;
            $category->created_at = $d->created_at;
            $category->updated_at = $d->updated_at;
            $category->meta_title = $d->name;
            $category->meta_desc = $d->description;
            $category->featured = $d->status ? 1 : 0;
            $category->status = 1;
            $category->save();
        }
        // for($i = 1;$i <= 2000; $i++){
        //     $topic = new Topic();
        //     $topic->name = Str::random(10);
        //     $topic->save();
        // }
    }

    public function AddToPost()
    {
        DB::table('posts')->truncate();
        $data= DB::table('products')->get();
        foreach($data as $d){
            $post=new PostTasks();
            $post->id = $d->id;
            $post->title = $d->name;
            $post->slug = $d->slug;
            $post->sub_title = null;
            $post->meta_title = $d->title;
            $post->meta_desc = $d->meta_description;
            $post->summary = $d->meta_description;
            $post->description = $d->details;
            $post->task_status = 'Published';
            $post->created_at = $d->created_at;
            $post->updated_at = $d->updated_at;
            $post->featured_image = 'posts/May2021/'.$d->image;
            $post->tags = $d->keyword;
            $post->category_id = $d->category_id;
            $post->user_id = $d->user_id;
            $post->save();

            $published=new Post();
            $published->id = $d->id;
            $published->task_id = $post->id;
            $published->title = $d->name;
            $published->slug = $d->slug;
            $published->sub_title = null;
            $published->meta_title = $d->title;
            $published->meta_desc = $d->meta_description;
            $published->summary = $d->meta_description;
            $published->description = $d->details;
            $published->status = 1;
            $published->created_at = $d->created_at;
            $published->updated_at = $d->updated_at;
            $published->featured_image = 'posts/May2021/'.$d->image;
            $published->tags = $d->keyword;
            $published->featured = $d->status ? 1 : 0;
            $published->category_id = $d->category_id;
            $published->user_id = $d->user_id;
            $published->hits = $d->views;
            $published->published = 1;
            $published->save();
        }

    }

    public function AddToUsers()
    {
        $data = DB::table("favusers")->get();
        foreach($data as $d){
            if($d->id != 1){
                $user = new User();
                $user->id = $d->id;
                $user->name = $d->name;
                $user->display_name = $d->name;
                $user->username = Str::slug($d->name, '-');
                $user->email = $d->email;
                $user->image = $d->profile_picture;
                $user->about = $d->additional_info;
                $user->password = $d->password;
                $user->created_at = $d->created_at;
                $user->updated_at = $d->updated_at;
                $user->save();
            }
        }
    }

    public function AddToContacts()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('website')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('instagram')->nullable();
        });
        $data = DB::table("dummy_newsletters")->get();
        foreach($data as $d){
            if($d->id != 1){
                $user = new Newsletter();
                $user->id = $d->id;
                $user->email = $d->email;
                $user->ip = $d->ip;
                $user->created_at = $d->created_at;
                $user->updated_at = $d->updated_at;
                $user->save();
            }
        }
    }

}
