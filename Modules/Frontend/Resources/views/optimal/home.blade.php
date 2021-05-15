@extends('frontend::layouts.optimal')
@section('meta_tags')
    @include('frontend::optimal.meta-data.home')
@endsection
@section('content')
@php
        $count = count($latest_posts) - 4;
        $slider_posts = array_reverse(array_slice(array_reverse($latest_posts), -$count, $count, true));
        $sidebar_posts = array_slice($latest_posts, -4, 4, true);
@endphp
    <div class="jl_home_bw">
        <section class="home_section1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jl_mright_wrapper jl_clear_at">
                            <div class="jl_mix_post">
                                <div class="jl_m_center blog-style-one blog-small-grid">
                                    <div class="jl_ar_top">
                                        <div class="jl-w-slider jl_full_feature_w">
                                            <div
                                                class="jl-eb-slider jelly_loading_pro"
                                                data-arrows="true"
                                                data-play="true"
                                                data-effect="false"
                                                data-speed="500"
                                                data-autospeed="7000"
                                                data-loop="true"
                                                data-dots="true"
                                                data-swipe="true"
                                                data-items="1"
                                                data-xs-items="1"
                                                data-sm-items="1"
                                                data-md-items="1"
                                                data-lg-items="1"
                                                data-xl-items="1"
                                            >
                                            @foreach($slider_posts as $post)
                                                <div class="item-slide jl_radus_e">
                                                    <div class="slide-inner">
                                                        <div class="jl_full_feature">
                                                            <div class="jl_f_img_bg" style="background-image: url('{{$post->image}}');"></div>
                                                            <a href="{{$post->post_url}}" class="jl_f_img_link"></a>
                                                            <div class="text-box">
                                                                <span class="jl_f_cat"><a class="post-category-color-text" style="background: #4dcf8f;" title="{{$post->category}}" href="{{$post->category_url}}">{{$post->category}}</a></span>
                                                                <h3 class="jl_f_title" title="{{$post->title}}"><a href="{{$post->post_url}}" tabindex="-1">{{$post->title}}</a></h3>
                                                                <span class="jl_post_meta">
                                                                    <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
                                                                    @if($post->created_at != $post->updated_at)
                                                                        <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                                                                    @else
                                                                        <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @foreach($sidebar_posts as $post)
                                <div class="jl_m_right">
                                    <div class="jl_m_right_w">
                                        <div class="jl_m_right_img jl_radus_e">
                                            <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                <img
                                                    src="{{$post->image}}"
                                                    class="attachment-sprasa_small_feature size-sprasa_small_feature wp-post-image"
                                                    alt="{{$post->title}}"
                                                    loading="lazy"
                                                />
                                            </a>
                                        </div>
                                        <div class="jl_m_right_content">
                                            <span class="jl_f_cat"><a class="post-category-color-text" title="{{$post->category}}" style="background: #91bd3a;" href="{{$post->category_url}}">{{$post->category}}</a></span>
                                            <h3 class="entry-title" title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h3>
                                            <span class="jl_post_meta">
                                                <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
                                                @if($post->created_at != $post->updated_at)
                                                    <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                                                @else
                                                    <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container large-banner-ad">
            {!! $settings['banner-ad'] !!}
        </div>
        @if(isset($section['one']))
        @if(count($section['one']->posts) > 0)
        <section class="home_section6">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 grid-sidebar" id="content">
                        <div
                            id="blockid_e3cb9ed"
                            class="block-section jl-main-block"
                            data-blockid="blockid_e3cb9ed"
                            data-name="jl_mgrid"
                            data-page_max="3"
                            data-page_current="1"
                            data-categories="4,6,9"
                            data-author="none"
                            data-order="date_post"
                            data-posts_per_page="8"
                        >
                            <div class="jl_grid_wrap_f jl_clear_at g_2col">
                                <div class="jl-roww content-inner jl-col3 jl-col-row">
                                    <div class="jl_sec_title">
                                        <h3 title="{{$section['one']->category->title}}" class="jl_title_c"><span>{{$section['one']->category->title}}</span></h3>
                                    </div>
                                    @foreach($section['one']->posts as $post)
                                    <div class="jl-grid-cols">
                                        <div class="p-wraper post-2949">
                                            <div class="jl_grid_w">
                                                <div class="jl_img_box jl_radus_e">
                                                    <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                        <img
                                                            src="{{$post->image}}"
                                                            class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image"
                                                            alt="{{$post->title}}"
                                                            loading="lazy"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="text-box">
                                                    <h3 title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h3>
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
                                    </div>
                                    @endforeach
                                    <div class="container">
                                        {!! $settings['banner-ad'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="sidebar">
                        @include('frontend::optimal.components.side-bar')
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif
        @if(isset($section['two']))
        @if(count($section['two']->posts) > 0)
        <section class="home_section3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jl_sec_title">
                            <h3 class="jl_title_c" title="{{$section['two']->category->title}}">{{$section['two']->category->title}}</h3>
                        </div>
                        <div class="jl_mg_wrapper jl_clear_at">
                            <div class="jl_mg_post jl_clear_at">
                                @foreach($section['two']->posts as $post)
                                @if ($loop->first)
                                <div class="jl_mg_main">
                                    <div class="jl_mg_main_w">
                                        <div class="jl_img_box jl_radus_e">
                                            <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                <img
                                                    width="1000"
                                                    height="650"
                                                    src="{{$post->image}}"
                                                    class="attachment-sprasa_feature_large size-sprasa_feature_large wp-post-image"
                                                    alt="{{$post->title}}"
                                                    loading="lazy"
                                                />
                                            </a>
                                        </div>
                                        <div class="text-box">
                                            <h3 class="entry-title" title="{{$post->title}}"><a href="{{$post->post_url}}" tabindex="-1">{{$post->title}}</a></h3>
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
                                @else
                                <div class="jl_mg_sm">
                                    <div class="jl_mg_sm_w">
                                        <div class="jl_f_img jl_radus_e">
                                            <a href="{{$post->post_url}}">
                                                <img
                                                    src="{{$post->image}}"
                                                    class="attachment-sprasa_feature_large size-sprasa_feature_large size-feature-small wp-post-image"
                                                    alt="{{$post->title}}"
                                                    loading="lazy"
                                                />
                                            </a>
                                        </div>
                                        <div class="jl_mg_content">
                                            <h3 class="entry-title" title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h3>
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
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif
        <div class="container large-banner-ad">
            {!! $settings['banner-ad'] !!}
        </div>
        @if(isset($section['three']))
        @if(count($section['three']->posts) > 0)
        <section class="home_section4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="blockid_3f9d058" class="block-section jl-main-block">
                            <div class="jl_grid_wrap_f jl_clear_at g_4col">
                                <div class="jl-roww content-inner jl-col3 jl-col-row">
                                    <div class="jl_sec_title">
                                        <h3 title="{{$section['three']->category->title}}" class="jl_title_c"><span>{{$section['three']->category->title}}</span></h3>
                                    </div>
                                    @foreach($section['three']->posts as $post)
                                    <div class="jl-grid-cols">
                                        <div class="p-wraper post-2691">
                                            <div class="jl_grid_w">
                                                <div class="jl_img_box jl_radus_e">
                                                    <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                        <img
                                                            width="500"
                                                            height="350"
                                                            src="{{$post->image}}"
                                                            class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image"
                                                            alt="{{$post->title}}"
                                                            loading="lazy"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="text-box">
                                                    <h3 title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h3>
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
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif
        @if(isset($section['four']))
        @if(count($section['four']->posts) > 0)
        <section class="home_section2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div
                            id="blockid_72be465"
                            class="block-section jl-main-block"
                            data-blockid="blockid_72be465"
                            data-name="jl_mgrid"
                            data-page_max="11"
                            data-page_current="1"
                            data-author="none"
                            data-order="date_post"
                            data-posts_per_page="6"
                            data-offset="5"
                        >
                            <div class="jl_grid_wrap_f jl_clear_at g_3col">
                                <div class="jl-roww content-inner jl-col3 jl-col-row">
                                    <div class="jl_sec_title">
                                        <h3 class="jl_title_c" title="{{$section['four']->category->title}}"><span>{{$section['four']->category->title}}</span></h3>
                                    </div>
                                    @foreach($section['four']->posts as $post)
                                    <div class="jl-grid-cols">
                                        <div class="p-wraper post-2959">
                                            <div class="jl_grid_w">
                                                <div class="jl_img_box jl_radus_e">
                                                    <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                        <img
                                                            src="{{$post->image}}"
                                                            class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image"
                                                            alt="{{$post->title}}"
                                                            loading="lazy"
                                                        />
                                                    </a>
                                                </div>
                                                <div class="text-box">
                                                    <h3 title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h3>
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
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif
        <div class="container large-banner-ad">
            {!! $settings['banner-ad'] !!}
        </div>
        @if(isset($section['five']))
        @if(count($section['five']->posts) > 0)
        <section class="home_section7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="blockid_84d79c5" class="block-section jl-main-block">
                            <div class="jl_grid_wrap_f jl_sf_grid jl_clear_at">
                                <div class="jl-roww content-inner jl-col3 jl-col-row">
                                    <div class="jl_sec_title">
                                        <h3 class="jl_title_c" title="{{$section['five']->category->title}}"><span>{{$section['five']->category->title}}</span></h3>
                                    </div>
                                    @foreach($section['five']->posts as $post)
                                    <div class="jl-grid-cols">
                                        <div class="p-wraper post-1614">
                                            <div class="jl_m_right jl_sm_list jl_ml jl_clear_at">
                                                <div class="jl_m_right_w">
                                                    <div class="jl_m_right_img jl_radus_e">
                                                        <a href="{{$post->post_url}}" title="{{$post->title}}">
                                                            <img
                                                                src="{{$post->image}}"
                                                                class="attachment-sprasa_feature_small size-sprasa_feature_small wp-post-image"
                                                                alt="{{$post->title}}"
                                                                loading="lazy"
                                                            />
                                                        </a>
                                                    </div>
                                                    <div class="jl_m_right_content">
                                                        <h2 class="entry-title" title="{{$post->title}}"><a href="{{$post->post_url}}">{{$post->title}}</a></h2>
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
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif
    </div>
@endsection