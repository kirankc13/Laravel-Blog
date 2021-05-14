<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Facades\Agent;
use Modules\Post\Entities\Category;
use Modules\System\Entities\Message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('admin.layouts.master*', function ($view) {
            $contact_messages = Message::take(10)->orderBy('is_seen','asc')->get();
            $view->with('contact_messages',$contact_messages);
        });

        view()->composer('frontend::layouts.*', function($view)
        {
            $view->with([
                'categories' => $this->FormatCategory(Category::where('parent_id',null)->where('featured',1)->orderBy('order','asc')->get()),
            ]);
        });
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
