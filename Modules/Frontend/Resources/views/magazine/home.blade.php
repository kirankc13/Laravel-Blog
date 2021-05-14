<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stuffs That Matter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/img/icon/fabicon.png">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/fontawesome.css">
    <link rel="stylesheet" href="assets/css/plugins/modal-video.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <link rel="stylesheet" href="assets/css/plugins/stellarnav.css">
    <link rel="stylesheet" href="assets/css/theme.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        .latest-post-image .post_img img {
            height: 500px;
            width: 100%;
            object-position: top;
        }
        @media(max-width:767.98px){
            .latest-post-image .post_img img {
                height: 350px;
            }
        }
        @media(max-width:650px){
            .latest-post-image .post_img img {
                height: 300px;
            }
        }
        @media(max-width: 580.98px) {
            .latest-post-image .post_img img {
                height: 263px;
            }
        }
        @media(max-width: 400px) {
            .latest-post-image .post_img img {
                height: 250px;
            }
        }
        @media(max-width: 375px) {
            .latest-post-image .post_img img {
                height: 235px;
            }
        }
        @media(max-width:320px){
            .latest-post-image .post_img img {
                height: 200px;
            }
        }
    </style>
</head>

<body class="theme-1">
    <div class="preloader">
        <div>
            <div class="nb-spinner"></div>
        </div>
    </div>
    <div class="searching">
        <div class="container">
            <div class="row">
                <div class="col-8 text-center m-auto">
                    <div class="v1search_form">
                        <form action="#">
                            <input type="search" placeholder="Search Here...">
                            <button type="submit" class="cbtn1">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="close_btn"> <i class="fal fa-times"></i>
        </div>
    </div>
    <div class="topbar white_bg" id="top">
        <div class="container">
            <div class="row top-nav">
                <div class="col-md-6 col-lg-8 align-self-center">
                    <div class="top-nav-items inline">
                        <ul>
                            <li>
                                <a href="#" title="Home">Home</a>
                            </li>
                            <li>
                                <a href="#">About</a>
                            </li>

                            <li>
                                <a href="#">Advertise</a>
                            </li>

                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>

                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 align-self-center">
                    <div class="text-right">
                        <div class="social1">
                            <ul class="inline">
                                <li><a href="#"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border_black"></div>

    <div class="logo_area white_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{setting('admin-logo')}}" alt="image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 align-self-center">
                    <div class="banner1">
                        <a href="#">
                            <img src="assets/img/bg/banner1.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu" id="header"><a href="#top" class="up_btn up_btn1"><i class="far fa-chevron-double-up"></i></a>
        <div class="main-nav clearfix is-ts-sticky">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-3 col-md-6 col-lg-8">
                        <div class="newsprk_nav stellarnav">
                            <ul id="newsprk_menu">
                                @foreach($categories as $c)
                                <li><a href="#">{{$c->title}} @if(count($c->children) > 0)<i class="fal fa-angle-down"></i>@endif</a>
                                @if(count($c->children) > 0)
                                    <ul>
                                    @foreach($c->children as $child)
                                        <li><a href="about.html">{{$child->title}}</a>
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-9 col-md-6 col-lg-4 align-self-center dark-mode-search">
                        <div class="menu_right">
                            <div class="users_area">
                                <ul class="inline">
                                    <li>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                            <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
                                        </div>
                                    </li>
                                    <li class="search_btn"><i class="far fa-search"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($latest_posts) > 0)
    <!-- Latest Section -->
    @php
        $count = count($latest_posts) - 3;
        $slider_posts = array_reverse(array_slice(array_reverse($latest_posts), -$count, $count, true));
        $sidebar_posts = array_slice($latest_posts, -3, 3, true);
    @endphp
    <div class="post_gallary_area fifth_bg mb40">
        <div class="container padding-top-60">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                    <!-- Slider Section -->
                        <div class="col-xl-8">
                            <div class="slider_demo2">
                            @foreach($slider_posts as $post)
                                <div class="single_post post_type6 xs-mb30 latest-post-image">
                                    <div class="post_img gradient1">
                                        <img src="{{$post->image}}" alt="{{$post->title}}">
                                    </div>
                                    <div class="single_post_text">
                                        <div class="meta meta_separator1">
                                            <a title="{{$post->title}}" href="{{$post->category_url}}">{{$post->category}}</a>
                                            @if($post->created_at != $post->updated_at)
                                                <time title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}">{{date_format($post->updated_at,'F d, Y')}}</time>
                                            @else
                                                <time title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}">{{date_format($post->created_at,'F d, Y')}}</time>
                                            @endif
                                        </div>
                                        <h4><a href="{{$post->post_url}}" class="background-color" title="{{$post->title}}">{{$post->title}}</a></h4>
                                        <p class="post-p">{{Str::limit($post->summary,150)}}</p>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <div class="slider_demo1">
                            @foreach($slider_posts as $post)
                                <div class="single_gallary_item">
                                    <img class="slider-image" src="{{$post->image}}" alt="{{$post->title}}">
                                </div>
                            @endforeach
                            </div>
                        </div>
                    <!-- End Slider Section -->
                    <!-- Latest Sidebar Section -->
                       <div class="col-xl-4">
                            <div class="widget tab_widgets mb30">
                                <div class="single_post2_carousel">
                                @foreach($sidebar_posts as $post)
                                    <div class="single_post widgets_small">
                                        <div class="post_img">
                                            <div class="img_wrap">
                                                <a href="{{$post->post_url}}">
                                                <img class="latest-sidebar-img" src="{{$post->image}}" alt="{{$post->title}}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="single_post_text">
                                            <div class="meta2 meta_separator1">
                                                <a href="{{$post->category_url}}">{{$post->category}}</a>
                                                @if($post->created_at != $post->updated_at)
                                                    <time title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}">{{date_format($post->updated_at,'F d, Y')}}</time>
                                                @else
                                                    <time title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}">{{date_format($post->created_at,'F d, Y')}}</time>
                                                @endif
                                            </div>
                                            <h4><a href="{{$post->post_url}}" title="{{$post->title}}">{{$post->title}}</a></h4>
                                        </div>
                                    </div>
                                    @if($loop->iteration == 3)
                                        <div class="space-14"></div>
                                        <div class="banner2">
                                            <a href="#">
                                                <img src="assets/img/bg/sidebar-1.png" alt="">
                                            </a>
                                        </div>
                                    @else
                                        <div class="space-14"></div>
                                        <div class="border_black"></div>
                                        <div class="space-14"></div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- End Latest Sidebar Section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Latest Section -->
    @endif

    @if(isset($section['one']))
    @if(count($section['one']->posts) > 0)
    <!-- Start First Section -->
    @php
        $count = count($section['one']->posts) - 6;
        $first_slider = array_slice(array_reverse($section['one']->posts), -$count, $count, true);
        $second = array_slice($section['one']->posts, -6, 6, true);
        $second_section = array_slice(array_reverse($second), -3, 3, true);
        $first_section = array_slice($second, -3, 3, true);
    @endphp
     <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-8 mb30">
                <h2 class="widget-title">{{$section['one']->category->title}}</h2>
                <div class="carousel_post2_type3 nav_style1 owl-carousel">
                @foreach($first_slider as $post)
                    <div class="single_post post_type3">
                        <div class="post_img">
                            <div class="img_wrap">
                                <img style="height:250px; width:350px;" src="{{$post->image}}" alt="{{$post->title}}">
                            </div>
                        </div>
                        <div class="single_post_text">
                            <div class="meta2">
                                <a title="{{$post->category}}" href="{{$post->category_url}}">{{$post->category}}</a>
                                @if($post->created_at != $post->updated_at)
                                    <time title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}">{{date_format($post->updated_at,'F d, Y')}}</time>
                                @else
                                    <time title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}">{{date_format($post->created_at,'F d, Y')}}</time>
                                @endif
                            </div>
                            <h4><a title="{{$post->title}}" href="{{$post->category_url}}">{{$post->title}}</a></h4>
                            <div class="space-10"></div>
                            <p class="post-p">{{Str::limit($post->summary,120)}}</p>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="border_black"></div>
                <div class="space-30"></div>
                <div class="row">
                    <div class="col-lg-6">
                    @foreach($second_section as $post)
                        <div class="single_post widgets_small">
                            <div class="post_img">
                                <div class="img_wrap">
                                    <img style="height:77px; width:100px;" src="{{$post->image}}" alt="{{$post->title}}">
                                </div>
                            </div>
                            <div class="single_post_text">
                                <div class="meta2">
                                <a title="{{$post->category}}" href="{{$post->category_url}}">{{$post->category}}</a>
                                @if($post->created_at != $post->updated_at)
                                    <time title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}">{{date_format($post->updated_at,'F d, Y')}}</time>
                                @else
                                    <time title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}">{{date_format($post->created_at,'F d, Y')}}</time>
                                @endif
                            </div>
                                <h4><a href="{{$post->post_url}}" title="{{$post->title}}">{{$post->title}}</a></h4>
                            </div>
                        </div>
                        @if($loop->iteration != 3)
                        <div class="space-15"></div>
                        <div class="border_black"></div>
                        <div class="space-15"></div>
                        @endif
                    @endforeach
                    </div>
                    <div class="col-lg-6">
                        @foreach($first_section as $post)
                        <div class="single_post widgets_small">
                            <div class="post_img">
                                <div class="img_wrap">
                                    <img style="height:77px; width:100px;" src="{{$post->image}}" alt="{{$post->title}}">
                                </div>
                            </div>
                            <div class="single_post_text">
                                <div class="meta2">
                                <a title="{{$post->category}}" href="{{$post->category_url}}">{{$post->category}}</a>
                                @if($post->created_at != $post->updated_at)
                                    <time title="{{date_format($post->updated_at,'F d, Y h:i A')}}" datetime="{{$post->updated_at}}">{{date_format($post->updated_at,'F d, Y')}}</time>
                                @else
                                    <time title="{{date_format($post->created_at,'F d, Y h:i A')}}" datetime="{{$post->created_at}}">{{date_format($post->created_at,'F d, Y')}}</time>
                                @endif
                            </div>
                                <h4><a href="{{$post->post_url}}" title="{{$post->title}}">{{$post->title}}</a></h4>
                            </div>
                        </div>
                            @if($loop->iteration != 3)
                            <div class="space-15"></div>
                            <div class="border_black"></div>
                            <div class="space-15"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="follow_box widget mb30 mt-md-60">
                    <h2 class="widget-title">Follow Us</h2>
                    <div class="social_shares">
                        <a class="single_social social_facebook" href="#"> <span class="follow_icon"><i
                                    class="fab fa-facebook-f"></i></span>
                            34,456 <span class="icon_text">Fans</span>
                        </a>
                        <a class="single_social social_twitter" href="#"> <span class="follow_icon"><i
                                    class="fab fa-twitter"></i></span>
                            34,456 <span class="icon_text">Followers</span>
                        </a>
                        <a class="single_social social_youtube" href="#"> <span class="follow_icon"><i
                                    class="fab fa-youtube"></i></span>
                            34,456 <span class="icon_text">Subscribers</span>
                        </a>
                        <a class="single_social social_instagram" href="#"> <span class="follow_icon"><i
                                    class="fab fa-instagram"></i></span>
                            34,456 <span class="icon_text">Followers</span>
                        </a>
                    </div>
                </div>
               <div class="widget category mb30">
                    <div class="banner2">
                        <a href="#">
                            <img src="assets/img/bg/sidebar-1.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End First Section -->
    @endif
    @endif
    <div class="container">
        <div class="banner_area mt20 mb30 xs-mt30">
            <a href="#">
                <img src="assets/img/bg/banner1.png" alt="">
            </a>
        </div>
    </div>

    @if(isset($section['one']))
    @if(count($section['one']->posts) > 0)
    <!-- Start Second Section -->
    <div class="feature_carousel_area mb40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2 class="widget-title">{{$section['two']->category->title}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="feature_carousel owl-carousel nav_style1">
                    @foreach($section['two']->posts as $post)
                        <div class="single_post post_type6 post_type7">
                            <div class="post_img gradient1">
                                <a href="{{$post->post_url}}" title="{{$post->title}}">
                                    <img class="pop-culture-image" src="{{$post->image}}" alt="{{$post->title}}">
                                </a>
                            </div>
                            <div class="single_post_text">
                                <div class="meta5">
                                    <a title="{{$post->category}}" href="{{$post->category_url}}">{{$post->category}}</a>
                                    <a href="#">March 26, 2020</a>
                                </div>
                                <h4>
                                    <a title="{{$post->title}}" href="{{$post->post_url}}">{{$post->title}}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Second Section -->
    @endif
    @endif

    <div class="entertrainments">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="sports">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="heading">
                                            <h2 class="widget-title">Sports News</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single_post post_type3 mb30">
                                            <div class="post_img">
                                                <a href="#">
                                                    <img src="assets/img/sports/sportsbig1.jpg" alt="">
                                                </a> <span class="tranding">
                                                    <i class="fas fa-bolt"></i>
                                                </span>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta3"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Copa America: Luis Suarez from devastated
                                                        US</a></h4>
                                                <div class="space-10"></div>
                                                <p class="post-p">The property, complete with 30-seat screening from
                                                    room, a 100-seat amphitheater and a swimming pond with sandy shower…
                                                </p>
                                                <div class="space-20"></div> <a href="#" class="readmore">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="sports_carousel owl-carousel nav_style1">

                                            <div class="sports_carousel_item">
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/sports/sports2.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/sports/sports3.jpg" alt="">
                                                            </a>
                                                        </div> <span class="tranding">
                                                            <i class="fas fa-bolt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4>
                                                            <a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/sports/sports4.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/sports/sports5.jpg" alt="">
                                                            </a>
                                                        </div> <span class="tranding">
                                                            <i class="fas fa-bolt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/sports/sports6.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sports_carousel_item">
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/blog/blog_small1.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/blog/blog_small2.jpg" alt="">
                                                            </a>
                                                        </div> <span class="tranding">
                                                            <i class="fas fa-bolt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4>
                                                            <a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/blog/blog_small3.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#"><img src="assets/img/blog/blog_small4.jpg"
                                                                    alt=""></a>
                                                        </div>
                                                        <span class="tranding">
                                                            <i class="fas fa-bolt"></i>
                                                        </span>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                                <div class="space-15"></div>
                                                <div class="single_post widgets_small">
                                                    <div class="post_img">
                                                        <div class="img_wrap">
                                                            <a href="#">
                                                                <img src="assets/img/blog/blog_small5.jpg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single_post_text">
                                                        <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                            <a href="#">March 26, 2020</a>
                                                        </div>
                                                        <h4><a href="post1.html">Copa America: Luis Suarez from
                                                                devastated US</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="banner_area mt20 mb30 xs-mt30">
                        <a href="#">
                            <img src="assets/img/bg/banner1.png" alt="">
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="businerss_news">
                                <div class="row">
                                    <div class="col-6 align-self-center">
                                        <h2 class="widget-title">Business News</h2>
                                    </div>
                                    <div class="col-6 text-right align-self-center"> <a href="#"
                                            class="see_all mb20">See All</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="single_post post_type3 post_type12 mb30">
                                            <div class="post_img">
                                                <div class="img_wrap">
                                                    <a href="#">
                                                        <img src="assets/img/business/business1.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta3"> <a href="#">uiux.subash</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Copa America: Luis Suarez from devastated
                                                        US</a></h4>
                                                <div class="space-10"></div>
                                                <p class="post-p">The property, complete with 30-seat screening from
                                                    room, a 100-seat amphitheater and a swimming pond with…</p>
                                                <div class="space-20"></div> <a href="#" class="readmore">Read more</a>
                                            </div>
                                        </div>
                                        <div class="single_post post_type3 post_type12 mb30">
                                            <div class="post_img">
                                                <div class="img_wrap">
                                                    <a href="#">
                                                        <img src="assets/img/business/business2.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta3"> <a href="#">uiux.subash</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Copa America: Luis Suarez from devastated
                                                        US</a></h4>
                                                <div class="space-10"></div>
                                                <p class="post-p">The property, complete with 30-seat screening from
                                                    room, a 100-seat amphitheater and a swimming pond with…</p>
                                                <div class="space-20"></div> <a href="#" class="readmore">Read more</a>
                                            </div>
                                        </div>
                                        <div class="single_post post_type3 post_type12 mb30">
                                            <div class="post_img">
                                                <div class="img_wrap">
                                                    <a href="#">
                                                        <img src="assets/img/business/business3.jpg" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta3"> <a href="#">uiux.subash</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Copa America: Luis Suarez from devastated
                                                        US</a></h4>
                                                <div class="space-10"></div>
                                                <p class="post-p">The property, complete with 30-seat screening from
                                                    room, a 100-seat amphitheater and a swimming pond with…</p>
                                                <div class="space-20"></div> <a href="#" class="readmore">Read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6 col-lg-12">

                            <div class="widget mb30">
                                <h2 class="widget-title">Most share</h2>
                                <div class="widget4_carousel owl-carousel nav_style1">

                                    <div class="carousel_items">
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>1</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Nancy zhang a chinese busy woman and dhaka</a>
                                                </h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>2</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Harbour amid a Slowen down in singer city</a>
                                                </h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>3</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Cheap smartphone sensor could help you old food
                                                        safe</a></h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                            </div>
                                        </div>
                                        <div class="box widget news_letter mb30">
                                            <h2 class="widget-title">News Letter</h2>
                                            <p>Your email address will not be this published. Required fields are News Today.</p>
                                            <div class="space-20"></div>
                                            <div class="signup_form">
                                                <form action="https://quomodosoft.com/html/newsprk/index.html">
                                                    <input class="signup" type="email" placeholder="Your email">
                                                    <input type="button" class="cbtn" value="sign up">
                                                </form>
                                                <div class="space-10"></div>
                                                <p>We hate spam as much as you do</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel_items">
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>1</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Nancy zhang a chinese busy woman and dhaka</a>
                                                </h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>2</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Harbour amid a Slowen down in singer city</a>
                                                </h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>3</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Cheap smartphone sensor could help you old food
                                                        safe</a></h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>4</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">Nancy zhang a chinese busy woman and dhaka</a>
                                                </h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                        <div class="single_post widgets_small widgets_type4">
                                            <div class="post_img number">
                                                <h2>5</h2>
                                            </div>
                                            <div class="single_post_text">
                                                <div class="meta2"> <a href="#">TECHNOLOGY</a>
                                                    <a href="#">March 26, 2020</a>
                                                </div>
                                                <h4><a href="post1.html">The secret to moving this ancient sphinx
                                                        screening</a></h4>
                                                <ul class="inline socail_share">
                                                    <li> <a href="#"><i class="fab fa-twitter"></i>2.2K</a>
                                                    </li>
                                                    <li> <a href="#"><i class="fab fa-facebook-f"></i>2.2K</a>
                                                    </li>
                                                </ul>
                                                <div class="space-15"></div>
                                                <div class="border_black"></div>
                                            </div>
                                        </div>
                                        <div class="space-15"></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-6 col-lg-12">

                            <div class="widget upcomming_macth mb30">
                                <div class="row">
                                    <div class="col-8 align-self-center">
                                        <h2 class="widget-title">Upcoming Matches</h2>
                                    </div>
                                    <div class="col-4 text-right align-self-center"> <a href="#"
                                            class="see_all mb20">See All</a>
                                    </div>
                                </div>
                                <div class="single_post post_type13 widgets_small">
                                    <div class="post_img">
                                        <a href="#">
                                            <img src="assets/img/flag/match1.png" alt="">
                                        </a>
                                    </div>
                                    <div class="single_post_text">
                                        <h4><a href="#" class="playing_teams">Germany <span>VS &nbsp;</span>France</a>
                                        </h4>
                                        <p class="meta macth_meta">Tomorrow &nbsp;|&nbsp;<span> M22:30 (CST) </span>
                                            &nbsp;</p>
                                    </div>
                                    <div class="circle_match_time">
                                        <div class="first_circle circle"></div>
                                    </div>
                                </div>
                                <div class="space-10"></div>
                                <div class="border_black"></div>
                                <div class="space-10"></div>
                                <div class="single_post post_type13 widgets_small">
                                    <div class="post_img">
                                        <a href="#">
                                            <img src="assets/img/flag/match2.png" alt="">
                                        </a>
                                    </div>
                                    <div class="single_post_text">
                                        <h4><a href="#" class="playing_teams">Spain <span>VS &nbsp;</span>Portugal</a>
                                        </h4>
                                        <p class="meta macth_meta">Tomorrow&nbsp;|&nbsp;<span> M22:30 (CST) </span>
                                            &nbsp;</p>
                                    </div>
                                    <div class="circle_match_time">
                                        <div class="second_circle circle"></div>
                                    </div>
                                </div>
                                <div class="space-10"></div>
                                <div class="border_black"></div>
                                <div class="space-10"></div>
                                <div class="single_post post_type13 widgets_small">
                                    <div class="post_img">
                                        <a href="#">
                                            <img src="assets/img/flag/match3.png" alt="">
                                        </a>
                                    </div>
                                    <div class="single_post_text">
                                        <h4><a href="#" class="playing_teams">Russia <span>VS &nbsp;</span>Italy</a>
                                        </h4>
                                        <p class="meta macth_meta">Tomorrow&nbsp;|&nbsp;<span> M22:30 (CST) </span>
                                            &nbsp;</p>
                                    </div>
                                    <div class="circle_match_time">
                                        <div class="third_circle circle"></div>
                                    </div>
                                </div>
                                <div class="space-10"></div>
                                <div class="border_black"></div>
                                <div class="space-10"></div>
                                <div class="single_post post_type13 widgets_small">
                                    <div class="post_img">
                                        <a href="#">
                                            <img src="assets/img/flag/match4.png" alt="">
                                        </a>
                                    </div>
                                    <div class="single_post_text">
                                        <h4><a href="#" class="playing_teams">Croatia <span>VS &nbsp;</span>England</a>
                                        </h4>
                                        <p class="meta macth_meta">Tomorrow&nbsp;|&nbsp;<span> M22:30 (CST) </span>
                                            &nbsp;</p>
                                    </div>
                                    <div class="circle_match_time">
                                        <div class="fourth_circle circle"></div>
                                    </div>
                                </div>
                                <div class="space-10"></div>
                                <div class="border_black"></div>
                                <div class="space-10"></div>
                                <div class="single_post post_type13 widgets_small">
                                    <div class="post_img">
                                        <a href="#">
                                            <img src="assets/img/flag/match5.png" alt="">
                                        </a>
                                    </div>
                                    <div class="single_post_text">
                                        <h4><a href="#" class="playing_teams">Germany <span>VS &nbsp;</span>France</a>
                                        </h4>
                                        <p class="meta macth_meta">Tomorrow&nbsp;|&nbsp;<span> M22:30 (CST) </span>
                                            &nbsp;</p>
                                    </div>
                                    <div class="circle_match_time">
                                        <div class="fifth_circle circle"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-lg-12">
                            <div class="banner2 mb30">
                                <a href="#">
                                    <img src="assets/img/bg/sidebar-1.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="space-70"></div>

    <div class="footer footer_area1 primay_bg">
        <div class="container">
            <div class="cta">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <div class="footer_logo logo">
                            <a href="index.html">
                                <img src="assets/img/logo/footer_logo.png" alt="logo">
                            </a>
                        </div>
                        <div class="social2">
                            <ul class="inline">
                                <li><a href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a>
                                </li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 offset-lg-2 align-self-center">
                        <div class="signup_form">
                            <form action="https://quomodosoft.com/html/newsprk/index.html" method="post">
                                <input xclass="signup" type="email" placeholder="Your email address">
                                <input type="button" class="cbtn" value="sign up">
                            </form>
                            <p>We hate spam as much as you do</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border_white"></div>
            <div class="space-40"></div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-sm-6 col-lg">
                            <div class="single_footer_nav border_white_right">
                                <h3 class="widget-title2">News categories</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul>
                                            <li><a href="#">Politics</a>
                                            </li>
                                            <li><a href="#">Business</a>
                                            </li>
                                            <li><a href="#">TECHNOLOGY</a>
                                            </li>
                                            <li><a href="#">Science</a>
                                            </li>
                                            <li><a href="#">Health</a>
                                            </li>
                                            <li><a href="#">Sports</a>
                                            </li>
                                            <li><a href="#">Entertainment</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul>
                                            <li><a href="#">Education</a>
                                            </li>
                                            <li><a href="#">Obituaries</a>
                                            </li>
                                            <li><a href="#">Corrections</a>
                                            </li>
                                            <li><a href="#">Education</a>
                                            </li>
                                            <li><a href="#">Today’s Paper</a>
                                            </li>
                                            <li><a href="#">Corrections</a>
                                            </li>
                                            <li><a href="#">Foods</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg">
                            <div class="single_footer_nav">
                                <h3 class="widget-title2">Living</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul>
                                            <li><a href="#">Crossword</a>
                                            </li>
                                            <li><a href="#">Food</a>
                                            </li>
                                            <li><a href="#">Automobiles</a>
                                            </li>
                                            <li><a href="#">Education</a>
                                            </li>
                                            <li><a href="#">Health</a>
                                            </li>
                                            <li><a href="#">Magazine</a>
                                            </li>
                                            <li><a href="#">Weddings</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul>
                                            <li><a href="#">Classifieds</a>
                                            </li>
                                            <li><a href="#">Photographies</a>
                                            </li>
                                            <li><a href="#">NYT Store</a>
                                            </li>
                                            <li><a href="#">Journalisms</a>
                                            </li>
                                            <li><a href="#">Public Editor</a>
                                            </li>
                                            <li><a href="#">Tools & Services</a>
                                            </li>
                                            <li><a href="#">My Account</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-40"></div>
                    <div class="border_white"></div>
                    <div class="space-40"></div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-5">
                            <div class="single_footer_nav border_white_right">
                                <h3 class="widget-title2">Opinion</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul>
                                            <li><a href="#">Today’s Opinion</a>
                                            </li>
                                            <li><a href="#">Op-Ed Contributing</a>
                                            </li>
                                            <li><a href="#">Contributing Writers</a>
                                            </li>
                                            <li><a href="#">Business News</a>
                                            </li>
                                            <li><a href="#">Collections</a>
                                            </li>
                                            <li><a href="#">Today’s Paper</a>
                                            </li>
                                            <li><a href="#">Saturday Review</a>
                                            </li>
                                            <li><a href="#">Product Review</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-7">
                            <div class="twitter_feeds">
                                <h3 class="widget-title2">Twitter feed</h3>
                                <div class="single_twitter_feed border_white_bottom">
                                    <div class="twitter_feed_icon"> <i class="fab fa-twitter"></i>
                                    </div>
                                    <h6>Cyber Monday Sale, Save 33% on Jannah theme during our year-end Sale, Purchase a
                                        new license for your next project… <span>@newspark #TECHNOLOGY
                                            https://dribbble.com/subash_chandra</span></h6>
                                    <p>March 26, 2020</p>
                                </div>
                                <div class="single_twitter_feed">
                                    <div class="twitter_feed_icon"> <i class="fab fa-twitter"></i>
                                    </div>
                                    <h6>Cyber Monday Sale, Save 33% on Jannah theme during our year-end Sale, Purchase a
                                        new license for your next project… <span>@newspark #TECHNOLOGY
                                            https://dribbble.com/subash_chandra</span></h6>
                                    <p>March 26, 2020</p>
                                </div>
                                <div class="single_twitter_feed">
                                    <div class="twitter_feed_icon"> <i class="fab fa-twitter"></i>
                                    </div>
                                    <h6>Cyber Monday Sale, Save 33% on Jannah theme during our year-end Sale, Purchase a
                                        new license for your next project… <span>@newspark #TECHNOLOGY
                                            https://dribbble.com/subash_chandra</span></h6>
                                    <p>March 26, 2020</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="extra_newss border_white_left pl-4">
                        <h3 class="widget-title2">More news</h3>
                        <div class="single_extra_news border_white_bottom">
                            <p>TECHNOLOGY <span> / March 26, 2020</span>
                            </p> <a href="#">Nancy zhang a chinese busy woman and dhaka</a>
                            <span class="news_counter">1</span>
                        </div>
                        <div class="single_extra_news border_white_bottom">
                            <p>TECHNOLOGY <span> / March 26, 2020</span>
                            </p> <a href="#">Nancy zhang a chinese busy woman and dhaka</a>
                            <span class="news_counter">2</span>
                        </div>
                        <div class="single_extra_news border_white_bottom">
                            <p>TECHNOLOGY <span> / March 26, 2020</span>
                            </p> <a href="#">Nancy zhang a chinese busy woman and dhaka</a>
                            <span class="news_counter">3</span>
                        </div>
                        <div class="single_extra_news border_white_bottom">
                            <p>TECHNOLOGY <span> / March 26, 2020</span>
                            </p> <a href="#">Nancy zhang a chinese busy woman and dhaka</a>
                            <span class="news_counter">4</span>
                        </div>
                        <div class="single_extra_news">
                            <p>TECHNOLOGY <span> / March 26, 2020</span>
                            </p> <a href="#">Nancy zhang a chinese busy woman and dhaka</a>
                            <span class="news_counter">5</span>
                        </div>
                        <div class="space-40"></div>
                        <div class="border_white_bottom"></div>
                        <div class="space-40"></div>
                        <div class="footer_contact">
                            <h3 class="widget-title2">Newspark news services</h3>
                            <div class="single_fcontact">
                                <div class="fcicon">
                                    <img src="assets/img/icon/mobile.png" alt="">
                                </div> <a href="#">On your mobile</a>
                            </div>
                            <div class="single_fcontact">
                                <div class="fcicon">
                                    <img src="assets/img/icon/speacker.png" alt="">
                                </div> <a href="#">On smart speakers</a>
                            </div>
                            <div class="single_fcontact">
                                <div class="fcicon">
                                    <img src="assets/img/icon/evelope.png" alt="">
                                </div> <a href="#">Contact Newspark news</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <p>&copy; Copyright 2020, All Rights Reserved</p>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="copyright_menus text-right">
                            <div class="language"></div>
                            <div class="copyright_menu inline">
                                <ul>
                                    <li><a href="#">About</a>
                                    </li>
                                    <li><a href="#">Advertise</a>
                                    </li>
                                    <li><a href="#">Privacy & Policy</a>
                                    </li>
                                    <li><a href="#">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/plugins/jquery.2.1.0.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/jquery.nav.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.min.js"></script>
    <script src="assets/js/plugins/jquery-modal-video.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.js"></script>
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/circle-progress.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/stellarnav.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $('#darkSwitch').click(function(){
            if ($(this).is(':checked')){
                $('body').addClass("dark-theme primary_bg");
                $('body').removeClass("theme-1");
                $('.logo_area').removeClass("white_bg");
                $('.logo_area').addClass("dark-2");
                $('.main-menu').addClass('dark-2');
                $('.post_gallary_area').removeClass('fifth_bg');
                $('.post_gallary_area').addClass('primay_bg');
                $('.post_gallary_area').addClass('dark-v');
                $('.topbar').removeClass("white_bg");
                $('.border_black').addClass('border_white');
                $('.border_black').removeClass('border_black');
                $('.top-nav').addClass('white');
            }else{
                $('body').removeClass("dark-theme primary_bg");
                $('body').addClass("theme-1");
                $('.logo_area').removeClass("dark-2");
                $('.logo_area').addClass("white_bg");
                $('.main-menu').removeClass('dark-2');
                $('.post_gallary_area').addClass('fifth_bg');
                $('.post_gallary_area').removeClass('primay_bg');
                $('.post_gallary_area').removeClass('dark-v')
                $('.topbar').addClass("white_bg");
                $('.border_white').addClass('border_black');
                $('.border_white').removeClass('border_white');
                $('.top-nav').removeClass('white');
            }
        });

        $(".search_btn").click(function() {
          $('.searching').addClass('search-animation');
        });
        $(".close_btn").click(function() {
          $('.searching').removeClass('search-animation');
        })
    </script>
</body>
</html>
