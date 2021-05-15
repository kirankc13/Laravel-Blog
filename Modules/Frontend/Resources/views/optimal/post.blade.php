@extends('frontend::layouts.optimal')
@section('meta_tags')
    @include('frontend::optimal.meta-data.post')
@endsection
@section('content')
<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-8 loop-large-post" id="content">
                <div class="widget_container content_page">
                    <div class="container post-banner-ad">
                        {!! $settings['banner-ad'] !!}
                    </div>
                    <!-- start post -->
                    <div
                        class="post-2970 post type-post status-publish format-gallery has-post-thumbnail hentry category-business tag-inspiration tag-morning tag-tip tag-tutorial post_format-post-format-gallery"
                        id="post-2970"
                    >
                        <div class="single_section_content box blog_large_post_style">
                            <div class="jl_single_style2">
                                <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                    <span class="meta-category-small single_meta_category"><a class="post-category-color-text" style="background: #eba845;" href="#">{{$post->category}}</a></span>
                                    <h1 class="single_post_title_main">{{$post->title}}</h1>
                                    <p class="post_subtitle_text">
                                        {{$post->sub_title}}
                                    </p>
                                    <span class="jl_post_meta">
                                        <span class="jl_author_img_w"><i class="jli-user"></i><a href="{{$post->author_url}}" title="Posts by {{$post->author}}" rel="author">{{$post->author}}</a></span>
                                        @if($post->created_at != $post->updated_at)
                                            <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                                        @else
                                            <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                                        @endif
                                        <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
                                    </span>
                                </div>
                                <div class="single_content_header jl_single_feature_below">
                                    <div class="image-post-thumb jlsingle-title-above">
                                        <img
                                            src="{{$post->image}}"
                                            class="size-sprasa_feature_large post-main-image"
                                            alt="{{$post->title}}"
                                            loading="lazy"
                                            style="width: 100%;
                                            object-fit: contain;"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="post_content_w">
                                <div class="post_content jl_content">
                                    @php
                                        $detail = $post->description;
                                        $dom = new DOMDocument;
                                        libxml_use_internal_errors(true);
                                        $dom->loadHTML($detail);
                                        $total_paragraph = $dom->getElementsByTagName('p')->length;
                                        $pattern = "#<p[^>]*>(\s|&nbsp;|</?\s?br\s?/?>)*</?p>#";
                                        $content = explode("</p>", preg_replace($pattern, '', $detail));
                                    @endphp
                                    @foreach($content as $c)
                                            @if($loop->iteration == 2 || $loop->iteration == ceil($total_paragraph / 2) )
                                                    <div class="in-between-ads text-center">
                                                        {!! $settings['between-articles-ad'] !!}
                                                    </div>
                                            @endif
                                    {!! $c !!}
                                    @endforeach
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            @if($post->tag)
                            <div class="single_tag_share">
                                <div class="tag-cat">
                                    <ul class="single_post_tag_layout">
                                        @foreach($post->tag as $t)
                                        <li><a href="{{route('tag',$t->name)}}" rel="tag">{{$t->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            <div class="postnav_w">
                                @if($previous)
                                <div class="postnav_left">
                                    <div class="single_post_arrow_content">
                                        <a href="{{route('post',['category_slug' => $previous->cat_slug,'slug' => $previous->slug])}}" id="prepost">
                                            <span class="jl_cpost_nav">
                                                <span class="jl_post_nav_link"><i class="jli-left-arrow"></i>Previous post</span><span class="jl_cpost_title">{{$previous->title}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                @if($next)
                                <div class="postnav_right">
                                    <div class="single_post_arrow_content">
                                        <a href="{{route('post',['category_slug' => $next->cat_slug,'slug' => $next->slug])}}" id="nextpost">
                                            <span class="jl_cpost_nav">
                                                <span class="jl_post_nav_link">Next post<i class="jli-right-arrow"></i></span><span class="jl_cpost_title">{{$next->title}}</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="auth">
                                <div class="author-info jl_info_auth">
                                    <div class="author-avatar">
                                        <img src="{{$post->author_image}}" width="165" height="165" alt="{{$post->author}}" class="avatar avatar-165 wp-user-avatar wp-user-avatar-165 alignnone photo" />
                                    </div>
                                    <div class="author-description">
                                        <h5><a href="{{$post->author_url}}">{{$post->author}}</a></h5>
                                        <ul class="jl_auth_link clearfix">
                                            @if($post->website)
                                            <li>
                                                <a href="{{$post->website}}" target="_blank"><i class="jli-link"></i></a>
                                            </li>
                                            @endif
                                            @if($post->linkedin)
                                            <li>
                                                <a href="{{$post->linkedin}}" target="_blank"><i class="jli-linkedin"></i></a>
                                            </li>
                                            @endif
                                            @if($post->facebook)
                                            <li>
                                                <a href="{{$post->facebook}}" target="_blank"><i class="jli-facebook"></i></a>
                                            </li>
                                            @endif
                                            @if($post->instagram)
                                            <li>
                                                <a href="{{$post->instagram}}" target="_blank"><i class="jli-instagram"></i></a>
                                            </li>
                                            @endif
                                            @if($post->twitter)
                                            <li>
                                                <a href="{{$post->twitter}}" target="_blank"><i class="jli-twitter"></i></a>
                                            </li>
                                            @endif
                                        </ul>
                                        @if($post->about)
                                        <p>
                                          {{$post->about}}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(count($related_articles) > 0)
                            <div class="related-posts">
                                <h4>Related Articles</h4>
                                <div class="single_related_post">
                                    @foreach($related_articles as $r)
                                    <div class="jl_m_right jl_m_list jl_m_img">
                                        <div class="jl_m_right_w">
                                            <div class="jl_m_right_img jl_radus_e">
                                                <a href="#">
                                                    <img
                                                        width="500"
                                                        height="350"
                                                        src="{{$r->image}}"
                                                        class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image"
                                                        alt="{{$r->title}}"
                                                        loading="lazy"
                                                    />
                                                </a>
                                            </div>
                                            <div class="jl_m_right_content">
                                                <span class="jl_f_cat"><a class="post-category-color-text" style="background: #eba845;" href="{{$r->category_url}}" title="{{$r->category}}">{{$r->category}}</a></span>
                                                <h2 class="entry-title" title="{{$r->title}}="><a href="{{$r->post_url}}" tabindex="-1">{{$r->title}}</a></h2>
                                                <span class="jl_post_meta">
                                                    @if($post->created_at != $post->updated_at)
                                                        <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                                                    @else
                                                        <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                                                    @endif
                                                    <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
                                                </span>
                                                <p>{{Str::limit($r->summary,200,'...')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- end post -->
                    <div class="brack_space"></div>
                </div>
            </div>
            <div class="col-md-4" id="sidebar">
                @include('frontend::optimal.components.side-bar')
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/history.js/1.8/bundled/html4+html5/jquery.history.js"></script>
<script src="{{asset('admin/js/keepscrolling.jquery.js')}}"></script>
<script>
    ( function( $, undefined ) {

$( document ).ready( function() {
    $( "#content_main" ).keepScrolling({
        floor: "#footer",
        article: ".main_content",
        data : [{
            "id": 1,
            "address": "post-one",
            "title": "Post One"
        }, {
            "id": 2,
            "address": "post-two",
            "title": "Post Two"
        }, {
            "id": 3,
            "address": "post-three",
            "title": "Post Three"
        }, {
            "id": 4,
            "address": "post-four",
            "title": "Post Four"
        }, {
            "id": 5,
            "address": "post-five",
            "title": "Post Five"
        }]
    });
} );
})( jQuery );

    $(function() {


        window.wasScrolled = false;
        $(window).bind('scroll',function(){
            if (!window.wasScrolled){
                var social = $('.post_content').find('div');
                var has_insta = false;
                var has_twitter = false;
                $.each(social, function (i, v) {
                    var attr = $(v).attr('data-oembed-url');
                    if (typeof attr !== typeof undefined && attr !== false) {
                        if (attr.indexOf("instagram.com") != -1) {
                            has_insta = true;
                        }
                        if (attr.indexOf("twitter.com") != -1) {
                            has_twitter = true;
                        }
                    }
                });

                var all_iframe = document.getElementsByTagName('i-frame');
                if(all_iframe) {
                    $.each(all_iframe, function (i, v) {
                        replaceElementTag('i-frame', '<iframe></iframe>');
                    });
                }

                if(has_insta) {
                    var body = document.getElementsByTagName('body')[0];
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.src = '//platform.instagram.com/en_US/embeds.js';
                    body.appendChild(script);
                }

                if(has_twitter) {
                    var body = document.getElementsByTagName('body')[0];
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.charset = 'utf-8';
                    script.src = '//platform.twitter.com/widgets.js';
                    body.appendChild(script);
                }
                var body = document.getElementsByTagName('body')[0];
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.async = 'async';
                    script.src = '{{ isset($configurations['share-this-url']) ? $configurations['share-this-url'] : null }}';
                    body.appendChild(script);

                window.wasScrolled = true;
            }
        })
    });
    function replaceElementTag(targetSelector, newTagString) {
        $(targetSelector).each(function(){
            var newElem = $(newTagString, {html: $(this).html()});
            $.each(this.attributes, function() {
                newElem.attr(this.name, this.value);
            });
            $(this).replaceWith(newElem);
        });
    }

</script>
@endsection