<div class="container ajax-ad-container">
    <a href="#">
        <img src="../assets/img/bg/banner1.png" alt="">
    </a>
</div>
@foreach($posts as $post)
<div class="box jl_grid_layout1 blog_grid_post_style post-2957 post type-post status-publish format-standard has-post-thumbnail hentry category-inspiration tag-morning">
    <div class="jl_grid_w">
        <div class="jl_img_box jl_radus_e">
            <a title="{{$post->title}}" href="{{$post->post_url}}">
                <img
                    src="{{$post->image}}"
                    class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image"
                    alt="{{$post->title}}"
                    loading="lazy"
                />
            </a>
        </div>
        <div class="text-box">
            <h3 title="{{$post->title}}"><a href="{{$post->post_url}}" tabindex="-1">{{$post->title}}</a></h3>
            <span class="jl_post_meta">
                @if($post->created_at != $post->updated_at)
                    <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                @else
                    <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                @endif
                <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
            </span>
        </div>
    </div>
</div>
@endforeach