<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\FrontController;
use App\Models\User;
use DOMDocument;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use magyarandras\AMPConverter\Converter;
use Modules\Frontend\Services\FrontServices;
use Modules\Post\Entities\Category;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostTasks;
use Modules\Post\Entities\Tags;
use Modules\System\Entities\Newsletter;
use Modules\System\Entities\Page;
use Modules\System\Entities\SystemConfiguration;
use NumberFormatter;

class FrontendController extends FrontController
{
    public $service;
    public function __construct(FrontServices $frontServices)
    {
        $configuration = SystemConfiguration::join('configuration_fields','configuration_fields.key','system_configurations.config_key')->select('system_configurations.*','configuration_fields.field_type as field_type')->get();
        $configurations= [];
        foreach($configuration as $key => $val)
        {
            if($val->field_type == 'image' || $val->field_type == 'file'){
                $configurations[$val->config_key] = $val->config_value ? asset('storage/'.$val->config_value) : null;
            }else{
                $configurations[$val->config_key] = $val->config_value ? $val->config_value : null;
            }

        }
        $theme = setting('theme');
        $this->service = $frontServices;
        $this->base_view = "frontend::".$theme;
        $this->settings = $configurations;
    }

    public function index()
    {
        $categories = Category::where('parent_id',null)->where('status',1)->orderBy('order','asc')->get();
        $section = [];
        $number_format = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $latest_posts = $this->service->FormatPosts(Post::join('users','users.id','posts.user_id')->where('posts.status',1)->where('posts.published',1)->where('posts.featured',1)->select('posts.*','users.display_name as author_name','users.username as author_slug')->orderBy('posts.created_at','desc')->take(setting('limit-home-section-latest'))->get());
        $excluded_ids = $this->service->getExcludedIds($latest_posts);
        $iteration = 0;
        foreach($categories as $c){
            $iteration++;
            $object = new \stdClass();
            $limit = $number_format->format($iteration);
            $object->posts = $this->service->FormatPosts(Post::join('users','users.id','posts.user_id')->where('category_id',$c->id)->whereNotIn('posts.id',$excluded_ids)->where('posts.status',1)->select('posts.*','users.display_name as author_name','users.username as author_slug')->where('posts.published',1)->orderBy('posts.created_at','desc')->take(setting('limit-home-section-'.$limit))->get());
            $object->category = $this->service->FormatCategory($c);
            $section[$number_format->format($iteration)] = $object;
        }
        return view(parent::LoadView($this->base_view.'.home'),compact('section','latest_posts'));
    }

    public function Author(Request $request,$username)
    {
        $user = User::where('username',$username)->first();
        if($user){
            $posts = Post::where('user_id',$user->id)->where('published',1)->paginate(6);
            $author = $this->service->FormatUser($user);
            $next_page_url = $posts->nextPageUrl();
            $posts = $this->service->FormatPosts($posts);
            if($request->ajax()) {
                return [
                    'posts' => view($this->base_view.'.ajax.posts-ajax',compact('posts','next_page_url'))->render(),
                    'next_page' => $next_page_url
                ];
            }else{
                return view(parent::LoadView($this->base_view.'.author'),compact('posts','next_page_url','author'));
            }

        }else{
            abort(404);
        }
    }

    public function Post(Request $request,$category,$slug)
    {
        $article = $this->service->GetArticle($category,$slug);
        if($article){
            $post = $this->service->FormatPost($article);

            $article->hits = $article->hits + 1;
            $article->timestamps = false;
            $article->save();
            $post->timestamps = true;

            $related_articles = $this->service->GetRelatedarticles($article);
            $previous = $this->service->GetPreviousPost($article);
            $next = $this->service->GetNextPost($article);
            $post->description = $this->service->FormatContent($post->description);
            return view(parent::LoadView($this->base_view.'.post'),compact('category','post','related_articles','previous','next'));

        }else{
            abort(404);
        }
    }

    public function AmpPost(Request $request,$category,$slug)
    {
        $article = $this->service->GetArticle($category,$slug);
        $categories = $this->FormatCategory(Category::where('parent_id',null)->where('featured',1)->orderBy('order','asc')->get());
        if($article){
            $post = $this->service->FormatPost($article);
            $article->hits = $article->hits + 1;
            $article->timestamps = false;
            $article->save();
            $post->timestamps = true;

            $related_articles = $this->service->GetRelatedarticles($article);
            $converter = new Converter();
            $converter->loadDefaultConverters();
            $post->description = $converter->convert($post->description);
            $amp_scripts = $converter->getScripts();
            return view(parent::LoadView($this->base_view.'.amp-post'),compact('category','post','related_articles','categories','amp_scripts'));
        }else{
            abort(404);
        }
    }



    public function Preview(Request $request,$post)
    {
        $post = PostTasks::find($post);
        if($post){
            $category = Category::where('status',1)->find($post->category_id);
            if($category){
                $url = route('preview.post',['category_slug'=>$category->slug,'slug' => $post->slug]);
                return view(parent::LoadView($this->base_view.'.preview-post'),compact('url'));
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function PreviewPost(Request $request,$category,$slug)
    {
        $article = PostTasks::leftjoin('users','users.id','post_tasks.user_id')
        ->leftjoin('categories','categories.id','post_tasks.category_id')
        ->where('post_tasks.slug',$slug)
        ->with('postTags')
        ->select('post_tasks.*','categories.slug as category_slug','categories.title as category_title','users.display_name as author_name','users.about','users.image as author_image','users.facebook','users.twitter','users.website','users.linkedin','users.instagram','users.username as author_slug','users.image as author_image')
        ->first();
        if($article){
            $post = $this->service->FormatPost($article);
            $related_articles = $this->service->GetRelatedarticlesForPreview($article);
            $previous = $this->service->GetPreviousPostForPreview($article);
            $next = $this->service->GetNextPostForPreview($article);
            if($post->description){
                $post->description = $this->service->FormatContent($post->description);
            }

            return view(parent::LoadView($this->base_view.'.post'),compact('category','post','related_articles','previous','next'));
        }else{
            abort(404);
        }
    }

    public function Tag(Request $request,$tag)
    {
        $tag = Tags::where('name',$tag)->with('posts')->first();
        $post_tags = DB::table('post_tag')->where('tag_id',$tag->id)->pluck('post_id')->toArray();
        $posts = Post::whereIn('posts.id',$post_tags)->where('status',1)->where('published',1)->paginate(10);
        $next_page_url = $posts->nextPageUrl();
        $posts = $this->service->FormatPosts($posts);
            if($request->ajax()) {
                return [
                    'posts' => view($this->base_view.'.ajax.posts-ajax',compact('posts','next_page_url'))->render(),
                    'next_page' => $next_page_url
                ];
            }else{
                return view(parent::LoadView($this->base_view.'.tags'),compact('posts','next_page_url','tag'));
            }

    }

    public function Category(Request $request,$slug)
    {
        $category = Category::where('slug',$slug)->where('status',1)->first();
        if($category){
            $category = $this->service->FormatCategory($category);
            $posts = Post::where('category_id',$category->id)->where('published',1)->paginate(6);
            $next_page_url = $posts->nextPageUrl();
            $posts = $this->service->FormatPosts($posts);
            if($request->ajax()) {
                return [
                    'posts' => view($this->base_view.'.ajax.posts-ajax',compact('posts','next_page_url'))->render(),
                    'next_page' => $next_page_url
                ];
            }else{
                return view(parent::LoadView($this->base_view.'.category'),compact('posts','category','next_page_url'));
            }

        }else{
            abort(404);
        }
    }

    public function Search(Request $request)
    {
        $query = $request->get('query');
        if($query == '')
        {
            Session::flash('error','Search query is required');
            return redirect()->back();
        }
        else{
            $posts = Post::where('title', 'LIKE','%'.$query.'%')->where('status',1)->where('published',1)->paginate(6);
            $next_page_url = $posts->nextPageUrl();
            $posts = $this->service->FormatPosts($posts);
            if($request->ajax()) {
                return [
                    'posts' => view($this->base_view.'.ajax.posts-ajax',compact('posts','next_page_url'))->render(),
                    'next_page' => $next_page_url
                ];
            }else{
                return view(parent::LoadView($this->base_view.'.search'),compact('posts','next_page_url','query'));
            }
        }
    }

    public function Page($slug)
    {
        $page = Page::where('slug',$slug)->where('status',1)->first();
        if($page){
            $page->hits = $page->hits + 1;
            $page->timestamps = false;
            $page->save();
            $page->timestamps = true;
            if($page->slug == 'contact'){
                return view(parent::LoadView($this->base_view.'.contact'),compact('page'));
            }else{
                return view(parent::LoadView($this->base_view.'.page'),compact('page'));
            }

        }else{
            abort(404);
        }

    }

    public function Subscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $exists = Newsletter::where('email',$request->email)->first();
        if(!$exists){
            $subscriptions = new Newsletter();
            $subscriptions->email = $request->email;
            $subscriptions->ip = $request->ip();
            $subscriptions->save();
        }
        Session::flash('success','Thank you for subscribing to our newsletter.');
        return redirect()->back();

    }

    public function AmpSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $exists = Newsletter::where('email',$request->email)->first();
        if(!$exists){
            $subscriptions = new Newsletter();
            $subscriptions->email = $request->email;
            $subscriptions->ip = $request->ip();
            $subscriptions->save();
        }
        return response()->json('success', 200);
    }


}
