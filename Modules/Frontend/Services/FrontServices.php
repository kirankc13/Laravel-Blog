<?php

namespace Modules\Frontend\Services;

use DOMDocument;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostTasks;

class FrontServices
{
    public function FormatUser($user)
    {
        $object = new \stdClass();
        $object->display_name = $user->display_name;
        $object->articles_count = count(Post::where('user_id',$user->id)->where('status',1)->get());
        $object->image = $user->image ? render($user->image) : setting('small-logo');
        $object->about = $user->about ? $user->about : null;
        $object->website = $user->website ? $user->website : null;
        $object->linkedin = $user->linkedin ? $user->linkedin : null;
        $object->instagram = $user->instagram ? $user->instagram : null;
        $object->twitter = $user->twitter ? $user->twitter : null;
        $object->facebook = $user->facebook ? $user->facebook : null;
        return $object;
    }

    public function FormatPost($post)
    {
        $object = new \stdClass();
        $object->title = $post->title;
        $object->sub_title = $post->sub_title ? $post->sub_title : null;
        $object->summary = $post->summary;
        $object->meta_title = $post->meta_title;
        $object->meta_desc = $post->meta_desc;
        $object->description = $post->description;
        $object->post_url = url('/'.$post->category_slug.'/'.$post->slug);
        $object->amp_url = url('/amp/'.$post->category_slug.'/'.$post->slug);
        $object->image = $post->featured_image ? render($post->featured_image) : null;
        $object->time = $post->estimated_time;
        $object->tag = $post->postTags ? $post->postTags : null;
        $object->created_at = $post->created_at;
        $object->updated_at = $post->updated_at;

        $object->category = $post->category_title;
        $object->category_url = url('/'.$post->category_slug);

        $object->author = $post->author_name ? $post->author_name : null;
        $object->author_image = $post->author_name ? $post->author_name : null;
        $object->author_url = $post->author_name ? route('author',$post->author_slug) : null;
        $object->author_image = $post->author_image ? render($post->author_image) : setting('small-logo');
        $object->facebook = $post->facebook;
        $object->twitter = $post->twitter;
        $object->instagram = $post->instagram;
        $object->linkedin = $post->linkedin;
        $object->website = $post->website;
        $object->about = $post->about;

        return $object;
    }

    public function FormatPreviewPost($post)
    {
        $object = new \stdClass();
        $object->title = $post->title;
        $object->sub_title = $post->sub_title ? $post->sub_title : null;
        $object->summary = $post->summary;
        $object->meta_title = $post->meta_title;
        $object->meta_desc = $post->meta_desc;
        $object->description = $post->description;
        $object->post_url = url('/'.$post->category_slug.'/'.$post->slug);
        $object->image = $post->featured_image ? render($post->featured_image) : null;
        $object->time = $post->estimated_time;
        $object->tag = $post->postTags ? $post->postTags : null;
        $object->created_at = $post->created_at;
        $object->updated_at = $post->updated_at;

        $object->category = $post->category_title;
        $object->category_url = url('/'.$post->category_slug);

        $object->author = $post->author_name ? $post->author_name : null;
        $object->author_image = $post->author_name ? $post->author_name : null;
        $object->author_url = $post->author_name ? route('author',$post->author_slug) : null;
        $object->author_image = $post->author_image ? render($post->author_image) : setting('logo');
        $object->facebook = $post->facebook;
        $object->twitter = $post->twitter;
        $object->instagram = $post->instagram;
        $object->linkedin = $post->linkedin;
        $object->website = $post->website;
        $object->about = $post->about;

        return $object;
    }

    public function FormatPosts($posts)
    {
        $object_array = [];
        foreach($posts as $post)
        {
            $object = new \stdClass();
            $object->id = $post->id;
            $object->title = $post->title;
            $object->category = strtoupper($post->category->title);
            $object->summary = $post->summary;
            $object->category_url = url('/'.$post->category->slug);
            $object->post_url = url('/'.$post->category->slug.'/'.$post->slug);
            $object->amp_url = url('amp/'.$post->category->slug.'/'.$post->slug);
            $object->created_at = $post->created_at;
            $object->updated_at = $post->updated_at;
            $object->image = render($post->featured_image);
            $object->time = $post->estimated_time;
            $object->author = $post->author_name ? $post->author_name : null;
            $object->author_url = $post->author_name ? route('author',$post->author_slug) : null;
            $object->author_url = $post->author_name ? route('author',$post->author_slug) : null;
            $object_array[] = $object;
        }

        return $object_array;
    }

    public function getExcludedIds($posts)
    {
        $data = [];
        foreach($posts as $p)
        {
            $data[] = $p->id;
        }
        return $data;
    }

    public function FormatCategory($category)
    {
        $object = new \stdClass();
        $object->id = $category->id;
        $object->title = $category->title;
        $object->slug = $category->slug;
        $object->summary = $category->summary;
        $object->meta_title = $category->meta_title;
        $object->meta_desc = $category->meta_desc;
        $object->image = render($category->image);
        return $object;
    }

    public function GetRelatedarticles($article)
    {
        $related = Post::whereHas('postTags', function ($q) use ($article) {
            return $q->whereIn('name', $article->postTags->pluck('name'));
        })
        ->where('id', '!=', $article->id)
        ->take(5)->get();
        return $this->FormatPosts($related);
    }

    public function GetRelatedarticlesForPreview($article)
    {
        $related = PostTasks::whereHas('postTags', function ($q) use ($article) {
            return $q->whereIn('name', $article->postTags->pluck('name'));
        })
        ->where('id', '!=', $article->id)
        ->take(4)->get();
        return $this->FormatPosts($related);
    }

    public function GetPreviousPost($article)
    {
        $previous = Post::leftjoin('categories','categories.id','posts.category_id')
        ->where('posts.id', '<', $article->id)
        ->orderBy('posts.id','desc')
        ->select('posts.*','categories.slug as cat_slug')
        ->first();
        if($previous){
            $previous = $previous;
        }else{
            $previous = null;
        }
        return $previous;
    }

    public function GetPreviousPostForPreview($article)
    {
        $previous = PostTasks::leftjoin('categories','categories.id','post_tasks.category_id')
        ->where('post_tasks.id', '<', $article->id)
        ->orderBy('post_tasks.id','desc')
        ->select('post_tasks.*','categories.slug as cat_slug')
        ->first();
        if($previous){
            $previous = $previous;
        }else{
            $previous = null;
        }
        return $previous;
    }

    public function GetNextPost($article)
    {
        $next = Post::leftjoin('categories','categories.id','posts.category_id')
                    ->where('posts.id', '>', $article->id)
                    ->select('posts.*','categories.slug as cat_slug')
                    ->first();
        if($next){
            $next = $next;
        }else{
            $next = null;
        }
        return $next;
    }

    public function GetNextPostForPreview($article)
    {
        $next = PostTasks::leftjoin('categories','categories.id','post_tasks.category_id')
                    ->where('post_tasks.id', '>', $article->id)
                    ->select('post_tasks.*','categories.slug as cat_slug')
                    ->first();
        if($next){
            $next = $next;
        }else{
            $next = null;
        }
        return $next;
    }

    public function FormatContent($content)
    {
        $detail = $content;
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        $detail = str_replace('<script async="" src="//platform.twitter.com/widgets.js" charset="utf-8"></script>','',$detail);
        $detail = str_replace('<script async="" charset="utf-8" src="//platform.twitter.com/widgets.js"></script>','',$detail);
        $detail = str_replace('<script async="" charset="utf-8" src="https://platform.twitter.com/widgets.js"></script>','',$detail);
        $detail = str_replace('<script async="" defer="defer" src="//platform.instagram.com/en_US/embeds.js"></script>','',$detail);
        $detail = str_replace('<script async="" src="//platform.instagram.com/en_US/embeds.js"></script>','',$detail);
        $detail = str_replace('<script async="" src="https://www.instagram.com/embed.js"></script>','',$detail);
        return $detail;
    }

    public function GetArticle($category,$slug)
    {
        return Post::leftjoin('users','users.id','posts.user_id')
                    ->leftjoin('categories','categories.id','posts.category_id')
                    ->where('posts.slug',$slug)
                    ->where('posts.status',1)
                    ->where('posts.published',1)
                    ->with('postTags')
                    ->select('posts.*','categories.slug as category_slug','categories.title as category_title','users.display_name as author_name','users.about','users.image as author_image','users.facebook','users.twitter','users.website','users.linkedin','users.instagram','users.username as author_slug','users.image as author_image')
                    ->first();
    }
}
