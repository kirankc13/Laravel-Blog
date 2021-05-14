<body class="mobile_nav_class jl-has-sidebar {{isset($_COOKIE['dark_mode']) ? 'wp-night-mode-on' : ''}}">
    <div class="options_layout_wrapper jl_clear_at jl_radius jl_none_box_styles jl_border_radiuss jl_en_day_night {{isset($_COOKIE['dark_mode']) ? 'options_dark_skin' : ''}}">
        <div class="options_layout_container full_layout_enable_front">
            <header class="header-wraper jl_header_magazine_style two_header_top_style header_layout_style3_custom jl_cus_top_share">
                <div class="header_top_bar_wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="menu-primary-container navigation_wrapper">
                                    <ul id="jl_top_menu" class="jl_main_menu">
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
                                </div>
                                <div class="jl_top_cus_social">
                                    <div class="menu_mobile_share_wrapper">
                                        <ul class="social_icon_header_top jl_socialcolor">
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
                </div>
                <!-- Start Main menu -->
                <div class="jl_blank_nav"></div>
                <div id="menu_wrapper" class="menu_wrapper jl_menu_sticky jl_stick">
                    <div class="container">
                        <div class="row">
                            <div class="main_menu col-md-12">
                                <div class="logo_small_wrapper_table">
                                    <div class="logo_small_wrapper">
                                        <!-- begin logo -->
                                        <a class="logo_link" href="{{route('home')}}">
                                            @if(isset($settings['logo']) && isset($settings['website-name']))
                                            <img class="jl_logo_n" src="{{$settings['logo']}}" alt="{{$settings['website-name']}}" />
                                            @endif
                                            @if(isset($settings['dark-logo']) && isset($settings['website-name']))
                                            <img class="jl_logo_w" src="{{$settings['dark-logo']}}" alt="{{$settings['website-name']}}" /></a>
                                            @endif
                                        <!-- end logo -->
                                    </div>
                                </div>
                                <div class="search_header_menu jl_nav_mobile">
                                    <div class="menu_mobile_icons">
                                        <div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div>
                                    </div>
                                    <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                                    <div class="jl_day_night {{isset($_COOKIE['dark_mode']) ? 'jl_night_en' : 'jl_day_en'}}">
                                        <span class="jl-night-toggle-icon">
                                            <span class="jl_moon">
                                                <i class="jli-moon"></i>
                                            </span>
                                            <span class="jl_sun">
                                                <i class="jli-sun"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="menu-primary-container navigation_wrapper jl_cus_share_mnu">
                                    <ul id="mainmenu" class="jl_main_menu">
                                        @foreach($categories as $c)
                                        <li class="menu-item {{$c->child ? 'menu-item-has-children' : ''}}">
                                            <a href="{{$c->url}}">{{$c->title}}<span class="border-menu"></span></a>
                                            @if($c->child)
                                            <ul class="sub-menu">
                                                @foreach($c->child as $ch)
                                                <li class="menu-item">
                                                    <a href="{{$ch->url}}">{{$ch->title}}<span class="border-menu"></span></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div id="content_nav" class="jl_mobile_nav_wrapper">
                <div id="nav" class="jl_mobile_nav_inner">
                    <div class="menu_mobile_icons mobile_close_icons closed_menu">
                        <span class="jl_close_wapper"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
                    </div>
                    <ul id="mobile_menu_slide" class="menu_moble_slide">
                        @foreach($categories as $c)
                        <li class="menu-item {{$c->child ? 'menu-item-has-children' : ''}}">
                            <a href="{{$c->url}}">{{$c->title}}<span class="border-menu"></span></a>
                            @if($c->child)
                            <ul class="sub-menu">
                                @foreach($c->child as $ch)
                                <li class="menu-item ">
                                    <a href="{{$ch->url}}">{{$ch->title}}<span class="border-menu"></span></a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
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

                </div>
            </div>
            <div class="search_form_menu_personal">
                <div class="menu_mobile_large_close">
                    <span class="jl_close_wapper search_form_menu_personal_click"><span class="jl_close_1"></span><span class="jl_close_2"></span></span>
                </div>
                <form method="GET" class="searchform_theme" action="{{route('search')}}">
                    <input required type="text" placeholder="Type Keywords" value="" name="query" class="search_btn" /><button type="submit" class="button"><i class="jli-search"></i></button>
                </form>
            </div>
            <div class="mobile_menu_overlay"></div>


