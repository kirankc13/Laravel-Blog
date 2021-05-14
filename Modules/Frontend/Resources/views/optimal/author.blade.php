@extends('frontend::layouts.optimal')
@section('meta_tags')
    @include('frontend::optimal.meta-data.author')
@endsection
@section('content')
<div class="jl_auth_head_w">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main_title_col">
                <div class="auth">
                    <div class="author-info jl_auth_head">
                        <div class="author-avatar">
                            <img src="{{$author->image}}" width="165" height="165" alt="{{$author->display_name}}" class="avatar avatar-165 wp-user-avatar wp-user-avatar-165 alignnone photo"/>
                        </div>
                        <div class="author-description">
                            <h5>{{$author->display_name}}</h5>
                            <p>
                                {{$author->about}}
                            </p>
                            <span class="author_postcount">{{$author->articles_count}} Articles Written</span>
                            <ul class="jl_auth_link clearfix">
                                @if($author->website)
                                <li>
                                    <a href="{{$author->website}}" target="_blank"><i class="jli-link"></i></a>
                                </li>
                                @endif
                                @if($author->linkedin)
                                <li>
                                    <a href="{{$author->linkedin}}" target="_blank"><i class="jli-linkedin"></i></a>
                                </li>
                                @endif
                                @if($author->instagram)
                                <li>
                                    <a href="{{$author->instagram}}" target="_blank"><i class="jli-instagram"></i></a>
                                </li>
                                @endif
                                @if($author->facebook)
                                <li>
                                    <a href="{{$author->facebook}}" target="_blank"><i class="jli-facebook"></i></a>
                                </li>
                                @endif
                                @if($author->twitter)
                                <li>
                                    <a href="{{$author->twitter}}" target="_blank"><i class="jli-twitter"></i></a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="jl_post_loop_wrapper">
    <div class="container" id="wrapper_masonry">
        <div class="row">
            <div class="col-md-8 grid-sidebar" id="content">
                <div class="jl_wrapper_cat">
                    <div id="content_masonry" class="jl_cgrid pagination_infinite_style_cat">
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
                    </div>
                    @if($next_page_url)
                    <div class="jl_lmore_wrap more-posts">
                        <div class="jl_lmore_c">
                            <button id="load-more-posts" data-next-page={{$next_page_url}} class="jl-load-link">
                                <span class="jl-load-text">Load More</span>
                                <span class="spinner-border spinner-border-sm more-posts-loader" role="status" aria-hidden="true" style="display:none;"></span>
                            </button>

                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4" id="sidebar">
                @include('frontend::optimal.components.side-bar')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@include('frontend::optimal.scripts.load-more-js')
@endsection