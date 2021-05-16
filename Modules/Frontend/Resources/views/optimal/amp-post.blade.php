<!doctype html>
<html ⚡ lang="en-us">
<head>
    @include('frontend::optimal.meta-data.post')
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
    <link rel="preload" as="script" href="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js">
    <link rel="preload" href="hero-img.jpg" as="image">
    <link rel="preconnect dns-prefetch" href="https://fonts.gstatic.com/" crossorigin>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-dynamic-css-classes" src="https://cdn.ampproject.org/v0/amp-dynamic-css-classes-0.1.js"></script>
    <!-- Import other AMP Extensions here -->
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-next-page" src="https://cdn.ampproject.org/v0/amp-next-page-1.0.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    @foreach ($amp_scripts as $script)
    {!! $script !!}
    @endforeach
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    @include('frontend::optimal.components.amp-css')
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
</head>
<body>
    <div class="options_layout_wrapper jl_clear_at jl_radius jl_none_box_styles jl_border_radiuss jl_en_day_night {{isset($_COOKIE['dark_mode']) ? 'options_dark_skin' : ''}}">
        <div class="options_layout_container full_layout_enable_front">
            <nav class="navbar" next-page-hide>
                <div class="container">
                    <button class="hamburger-menu" on="tap:amp-mobile-sidebar"><span></span> <span></span> <span></span></button>
                    <!-- <button on="tap:amp-mobile-sidebar">Open Sidebar</button> -->
                    <div class="logo">
                        <a href="{{route('home')}}">
                            @if(isset($settings['logo']) && isset($settings['website-name']))
                            <amp-img
                            alt="{{$settings['website-name']}}"
                            src="{{$settings['logo']}}"
                            width="130px"
                            height="20px"
                            layout="fixed"
                            class="dark"
                            style="width: 160px; height: 50px; --loader-delay-offset: 250ms;"
                            >
                        </amp-img>
                        @endif
                    </a>
                </div>
                <div class="search-button">
                    <input type="checkbox" id="opensearch"/>
                    <label for="opensearch">
                        <i class="jli-search"></i>
                    </label>
                    <div class="search-box">
                        <div class="search_form_menu_personal search_form_menu_personal_active">
                            <label for="opensearch">
                            <div class="menu_mobile_large_close">
                                <span class="jl_close_wapper search_form_menu_personal_click"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
                            </div>
                        </label>
                            <form method="GET" class="searchform_theme" action="{{route('search')}}" target="_top">
                                <input required="" type="text" placeholder="Type Keywords" value="" name="query" class="search_btn"><button type="submit" class="button"><i class="jli-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <amp-sidebar id="amp-mobile-sidebar" layout="nodisplay" next-page-hide>

            <amp-nested-menu layout="fill">
                <button on="tap:amp-mobile-sidebar.close" class="sidebar-close">
                    <div class="menu_mobile_icons mobile_close_icons closed_menu">
                        <span class="jl_close_wapper"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
                    </div>
                </button>
                <ul class="mobile-menu">
                    @foreach($categories as $c)
                    <li>
                        <a href="{{$c->url}}" title="{{$c->title}}">{{$c->title}}</a>
                    </li>
                    @endforeach
                </ul>
                <div id="sprasa_about_us_widget-3" class="widget jellywp_about_us_widget">
                    <div class="widget_jl_wrapper about_widget_content">
                        <div class="jellywp_about_us_widget_wrapper">
                            <div class="social_icons_widget">
                                <ul class="social-icons-list-widget icons_about_widget_display">
                                    @if(isset($settings['facebook-link']))
                                    <li class="facebook"><a href="{{$settings['facebook-link']}}" target="_blank"><i class="jli-facebook"></i></a></li>
                                    @endif
                                    @if(isset($settings['twitter-link']))
                                    <li class="twitter"><a href="{{$settings['twitter-link']}}" target="_blank"><i class="jli-twitter"></i></a></li>
                                    @endif
                                    @if(isset($settings['pinterest-link']))
                                    <li class="instagram"><a href="{{$settings['pinterest-link']}}" target="_blank"><i class="jli-pinterest"></i></a></li>
                                    @endif
                                    @if(isset($settings['linkedin-link']))
                                    <li class="linkedin"><a href="{{$settings['linkedin-link']}}" target="_blank"><i class="jli-linkedin"></i></a></li>
                                    @endif
                                    @if(isset($settings['instagram-link']))
                                    <li class="instagram"><a href="{{$settings['instagram-link']}}" target="_blank"><i class="jli-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul id="mobile_menu_slide" class="menuBox">
                    <li class="menu-item current-menu-item current_page_item">
                        <a href="{{route('home')}}">Home<span class="border-menu"></span></a>
                    </li>
                    <li class="menu-item menu-item-4278">
                        <a href="{{route('page','about-us')}}">About Us<span class="border-menu"></span></a>
                    </li>
                    <li class="menu-item menu-item-4279">
                        <a href="{{route('page','advertise')}}">Advertise<span class="border-menu"></span></a>
                    </li>
                    <li class="menu-item menu-item-4275">
                        <a href="{{route('page','privacy-policy')}}">Privacy Policy<span class="border-menu"></span></a>
                    </li>
                    <li class="menu-item menu-item-4277">
                        <a href="{{route('page','contact')}}">Contact Us<span class="border-menu"></span></a>
                    </li>
                </ul>

            </amp-nested-menu>
        </amp-sidebar>

        <div class="search_form_menu_personal" next-page-hide>
            <div class="menu_mobile_large_close">
                <span class="jl_close_wapper search_form_menu_personal_click"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
            </div>
            <form method="GET" class="searchform_theme" action="{{route('search')}}" accept-charset="utf-8" target="_top">
                <input required type="text" placeholder="Type Keywords" value="" name="query" class="search_btn" /><button type="submit" class="button"><i class="jli-search"></i></button>
            </form>
        </div>
        <div class="mobile_menu_overlay" next-page-hide></div>
        <section id="content_main" class="clearfix jl_spost">
            <div class="container">
                <div class="row main_content">
                    <div class="loop-large-post" id="content">
                        <div class="container post-banner-ad">
                            {!! $settings['amp-banner-ad'] !!}
                        </div>
                        <nav class="breadcrumbs-container" aria-label="Breadcrumb">
                            <ol class="breadcrumbs-list">
                                <li class="breadcrumbs-item">
                                    <a class="breadcrumbs-link" href="{{route('home')}}"> <span class="breadcrumbs-title"> Home </span> </a>
                                    <span class="icon breadcrumbs-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 48" aria-hidden="true" style="transform: rotate(180deg);" tabindex="-1">
                                            <path fill="#000" d="M19.98 5L4 24.2l15.98 19.2.02-4.512L7.874 24.2 20 9.512z"></path>
                                        </svg>
                                    </span>
                                </li>
                                <li class="breadcrumbs-item breadcrumbs-item-last">
                                    <a class="breadcrumbs-link" href="{{$post->category_url}}"> <span class="breadcrumbs-title"> {{$post->category}} </span> </a>
                                    <span class="icon breadcrumbs-icon breadcrumbs-icon-last">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 48" aria-hidden="true" style="transform: rotate(180deg);" tabindex="-1">
                                            <path fill="#000" d="M19.98 5L4 24.2l15.98 19.2.02-4.512L7.874 24.2 20 9.512z"></path>
                                        </svg>
                                    </span>
                                </li>
                                <li class="breadcrumbs-item visually-hidden" aria-current="page">{{$post->title}}</li>
                            </ol>
                        </nav>

                        <div class="widget_container content_page">
                            <!-- start post -->
                            <div
                            class="post-2970 post type-post status-publish format-gallery has-post-thumbnail hentry category-business tag-inspiration tag-morning tag-tip tag-tutorial post_format-post-format-gallery"
                            id="post-2970"
                            >
                            <div class="single_section_content box blog_large_post_style">
                                <div class="jl_single_style2">
                                    <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                        <h1 class="single_post_title_main">{{$post->title}}</h1>
                                        <p class="post_subtitle_text">
                                            {{$post->sub_title}}
                                        </p>
                                        <span class="meta-category-small single_meta_category"><a class="post-category-color-text" style="background: #eba845;" href="{{$post->category_url}}">{{$post->category}}</a></span>
                                        <span class="jl_post_meta">
                                            <span class="jl_author_img_w"><i class="jli-user"></i><a href="{{$post->author_url}}" title="Posts by {{$post->author}}" rel="author">{{$post->author}}</a></span>
                                            @if($post->created_at != $post->updated_at)
                                            <span class="post-date" title="{{date_format($post->updated_at,'F d, Y h:i A')}}"><i class="jli-pen"></i>{{date_format($post->updated_at,'F d, Y')}}</span>
                                            @else
                                            <span class="post-date" title="{{date_format($post->created_at,'F d, Y h:i A')}}"><i class="jli-pen"></i>{{date_format($post->created_at,'F d, Y')}}</span>
                                            @endif
                                            <span class="post-read-time"><i class="jli-watch-2"></i>{{$post->time}}</span>
                                        </span>
                                    </div>
                                    <div class="single_content_header jl_single_feature_below">
                                        <div class="image-post-thumb jlsingle-title-above">
                                            <amp-img
                                            src="{{$post->image}}"
                                            srcset="{{$post->image}} 640w,
                                            {{$post->image}} 320w"
                                            height="1800"
                                            width="2777"
                                            layout="responsive"
                                            alt="{{$post->title}}"
                                            style="width: 100%;
                                            object-fit: contain; margin-bottom:10px;"
                                            ></amp-img>
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
                                                            {!! $settings['amp-between-articles-ad'] !!}
                                                        </div>
                                                @endif
                                        {!! $c !!}
                                        @endforeach
                                 </div>
                             </div>
                             <div class="clearfix"></div>
                             <div class="container post-banner-ad">
                                {!! $settings['amp-banner-ad'] !!}
                            </div>
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
                        </div>
                    </div>
                    <!-- end post -->
                    <div class="brack_space"></div>
                    @if($related_articles != null)
					@if(count($related_articles) > 0)
					<amp-next-page>
						<script type="application/json">
							[
								@foreach($related_articles as $rp)
								{
									"title": "{!!$rp->title!!}",
									"image": "{{$rp->image ? asset($rp->image) : asset('frontend/images/dummy.png')}}",
									"url": "{{$rp->amp_url}}"
								}
								@if(!$loop->last)
								,
								@endif
								@endforeach
								]
						</script>
						<div class="amp-next-page-sample-separator" separator>
							<hr>
						</div>
					</amp-next-page>
					@endif
					@endif
                </div>
            </div>
        </div>
    </div>
</section>
<footer id="footer-container" class="jl_footer_act enable_footer_columns_dark" next-page-hide>
    <div class="footer-columns">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div id="sprasa_about_us_widget-2" class="widget jellywp_about_us_widget">
                        <div class="widget_jl_wrapper about_widget_content">
                            <div class="jellywp_about_us_widget_wrapper">
                                @if(isset($settings['dark-logo']) && isset($settings['website-name']))
                                <amp-img width="130" height="18" class="footer_logo_about" src="{{$settings['dark-logo']}}" alt="{{$settings['website-name']}}"></amp-img>
                                @endif
                                @if(isset($settings['footer-about-description']))
                                <p>
                                    {{$settings['footer-about-description']}}
                                </p>
                                @endif
                                <div class="social_icons_widget"><ul class="social-icons-list-widget icons_about_widget_display"></ul></div>
                            </div>
                        </div>
                    </div>
                    <div id="sprasa_about_us_widget-4" class="widget jellywp_about_us_widget">
                        <div class="widget_jl_wrapper about_widget_content">
                            <div class="jellywp_about_us_widget_wrapper">
                                <div class="social_icons_widget">
                                    <ul class="social-icons-list-widget icons_about_widget_display">
                                        @if(isset($settings['facebook-link']))
                                        <li class="facebook"><a href="{{$settings['facebook-link']}}" target="_blank"><i class="jli-facebook"></i></a></li>
                                        @endif
                                        @if(isset($settings['twitter-link']))
                                        <li class="twitter"><a href="{{$settings['twitter-link']}}" target="_blank"><i class="jli-twitter"></i></a></li>
                                        @endif
                                        @if(isset($settings['pinterest-link']))
                                        <li class="instagram"><a href="{{$settings['pinterest-link']}}" target="_blank"><i class="jli-pinterest"></i></a></li>
                                        @endif
                                        @if(isset($settings['linkedin-link']))
                                        <li class="linkedin"><a href="{{$settings['linkedin-link']}}" target="_blank"><i class="jli-linkedin"></i></a></li>
                                        @endif
                                        @if(isset($settings['instagram-link']))
                                        <li class="instagram"><a href="{{$settings['instagram-link']}}" target="_blank"><i class="jli-instagram"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget_jl_wrapper jl_clear_at">
                        <div id="sprasa_category_image_widget_register-2" class="widget jellywp_cat_image">
                            <div class="widget-title"><h2 class="jl_title_c">Categories</h2></div>
                            <div class="wrapper_category_image">
                                <div class="category_image_wrapper_main">
                                    @foreach($categories as $c)
                                    @if($loop->iteration > 6)
                                    @break
                                    @endif
                                    <div class="jl_cat_img_w">
                                        <div class="jl_cat_img_c">
                                            <a class="category_image_link" id="category_color_2" href="{{$c->url}}"></a>
                                            <div class="category_image_bg_image jl_f_img_bg" style="background-image: url('{{$c->image}}');"></div>
                                            <span class="jl_cm_overlay"><span class="jl_cm_name">{{$c->title}}</span></span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="widget_jl_wrapper jl_clear_at">
                        <div id="sprasa_category_image_widget_register-2" class="widget jellywp_cat_image">
                            <div class="widget-title"><h2 class="jl_title_c">Newsletter</h2></div>
                            @if(isset($settings['footer-newsletter-description']))
                            <p>{{$settings['footer-newsletter-description']}}</p>
                            @endif
                            <form method="POST" on="submit-success:email_input.hide" action-xhr="{{route('amp.subscribe')}}" method="POST" target="_top">
                                {{csrf_field()}}
                                <span class="comment-form-email">
                                    <div class="input-group mb-3" id="email_input">
                                        <input type="email" required class="form-control" placeholder="Email Address" name="email" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit">Subscribe</button>
                                        </div>
                                    </div>
                                    <div class="success-for-submit" style="text-align: center;" submit-success>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success!</strong> Thank your Signing Up to our newsletter.
                                        </div>
                                    </div>
                                    <div class="success-for-submit" style="text-align: center;" submitting>
                                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                    </div>
                                    <div submit-error  style="text-align: center;" class="error-for-submit">
                                        <span>Error submitting the form!</span>
                                    </div>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom enable_footer_copyright_dark">
        <div class="container">
            <div class="row bottom_footer_menu_text">
                <div class="col-md-12">
                    <div class="jl_ft_w">
                        Copyright © {{ now()->year }} {{$settings['website-name'] ? $settings['website-name'] : ''}}.
                        <ul id="menu-footer-menu" class="menu-footer">
                            <li class="menu-item menu-item-5"><a title="Home" href="{{route('home')}}">Home</a></li>
                            <li class="menu-item menu-item-6"><a title="About Us" href="{{route('page','about')}}">About Us</a></li>
                            <li class="menu-item menu-item-7"><a title="Privacy Policy" href="{{route('page','privacy-policy')}}">Privacy Policy</a></li>
                            <li class="menu-item menu-item-9"><a title="Contact" href="{{route('page','contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('frontend::optimal.components.messages')

    @if(!isset($_COOKIE['cookie_consent']))
    <div class="cookie-popup" id="cookie-consent" style="display: block;">
        <div class="cookie-inner">
            <div class="cookie-text">This website uses cookies to ensure you get the best experience on our website. To find out more, read our <a onmouseover="this.style.color='blue'" onmouseout="this.style.color='white'" href="{{route('page','privacy-policy#cookie_policy')}}" title="Cookie Policy" style="color: white;">Cookie Policy</a>.</p>
            </div> <button class="cookieaccept" onclick="setMyCookie();">Ok</button>
        </div>
    </div>
    @endif
</footer>



{{-- <amp-analytics type="gtag" data-credentials="include">
    <script type="application/json">
        {
          "vars" : {
          "gtag_id": "UA-XXXXX-Y",
          "config" : {
          "UA-XXXXX-Y": {
          "groups": "default"
      }
  }
}
}
</script>
</amp-analytics> --}}
</body>
</html>