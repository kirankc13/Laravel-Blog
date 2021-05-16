<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Post;

class SitemapController extends Controller
{
    public function index() {
        $index_limit = setting('site-maps-per-index');
        if($index_limit)
        {
            if(is_numeric($index_limit)){
                $limit = (int)$index_limit;
            }else{
                $limit = 1000;
            }
        }else{
            $limit = 1000;
        }
        $articles = Post::leftjoin('categories','posts.category_id','=','categories.id')->where('categories.slug','!=','news')->select('posts.*','categories.slug as cat_slug')->paginate($limit);
        $news = Post::leftjoin('categories','posts.category_id','=','categories.id')->where('categories.slug','news')->select('posts.*','categories.slug as cat_slug')->paginate($limit);
        return response()->view('frontend::sitemap.index', [
            'article' => $articles,
            'news'=>$news
        ])->header('Content-Type', 'text/xml');
    }

    public function sitemap($page)
    {
        if($page != 'news'){
            $currentPage = $page;
            $index_limit = setting('site-maps-per-index');
            if($index_limit)
            {
                if(is_numeric($index_limit)){
                    $limit = (int)$index_limit;
                }else{
                    $limit = 1000;
                }
            }else{
                $limit = 1000;
            }
            Paginator::currentPageResolver(function() use ($currentPage) {
                return $currentPage;
            });

            $article_count = count(Post::leftjoin('categories','posts.category_id','=','categories.id')->where('posts.status',1)->where('posts.published',1)->get());
            $get_latest_uneven_post_count = $article_count % $limit;

            if($currentPage == '1'){
                $articles = Post::leftjoin('categories','posts.category_id','=','categories.id')->select('posts.*','categories.slug as cat_slug')->where('posts.status',1)->where('posts.published',1)->orderBy('updated_at','desc')->take($get_latest_uneven_post_count)->get();
            }else{
                if($currentPage > '2'){
                    $multiplier = $currentPage - 2;
                    $add = $limit * $multiplier;
                    $offset = $get_latest_uneven_post_count + $add;
                }else{
                    $offset = $get_latest_uneven_post_count;
                }
                $articles = Post::leftjoin('categories','posts.category_id','=','categories.id')->where('posts.status',1)->select('posts.*','categories.slug as cat_slug')->orderBy('updated_at','desc')->skip($offset)->take($limit)->get();
            }
            return response()->view('frontend::sitemap.posts',[
                'article' => $articles,
            ])->header('Content-Type', 'text/xml');
        }else{
            $article = Post::join('categories','posts.category_id','=','categories.id')->where('categories.slug','news')->select('posts.*','categories.slug as cat_slug')->get();

            return response()->view('frontend::sitemap.news',[
                'article' => $article,
            ])->header('Content-Type', 'text/xml');
        }


    }

    public function RSS()
    {
        $articles = Post::join('categories','posts.category_id','=','categories.id')->select('posts.*','categories.slug as cat_slug')->orderBy('created_at','desc')->take(60)->get();
        return response()->view('frontend::rss.feed', [
            'articles' => $articles,
        ])->header('Content-Type', 'text/xml');
    }
}
