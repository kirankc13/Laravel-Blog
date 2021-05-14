<footer id="footer-container" class="jl_footer_act enable_footer_columns_dark">
    <div class="footer-columns">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div id="sprasa_about_us_widget-2" class="widget jellywp_about_us_widget">
                        <div class="widget_jl_wrapper about_widget_content">
                            <div class="jellywp_about_us_widget_wrapper">
                                @if(isset($settings['dark-logo']) && isset($settings['website-name']))
                                <img class="footer_logo_about" src="{{$settings['dark-logo']}}" alt="{{$settings['website-name']}}" />
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
                            <form method="POST" action="{{route('subscribe')}}">
                                {{csrf_field()}}
                            <span class="comment-form-email">
                                <div class="input-group mb-3">
                                    <input type="email" required class="form-control" placeholder="Email Address" aria-label="Recipient's username" name="email" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button type="submit">Subscribe</button>
                                    </div>
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
<!-- End footer -->
<div id="go-top">
    <a href="#go-top"><i class="jli-up-chevron"></i></a>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('optimal/js/jquery.js')}}"></script>
@if(!isset($_COOKIE['cookie_consent']))
<script type="text/javascript">
    function setMyCookie() {
        var now = new Date();
        var expires = new Date(now.setTime(now.getTime() + 3600 * 1000 * 24 * 365 )); //Expire in one year
        document.cookie = 'cookie_consent=1;path=/;expires='+expires.toGMTString()+';';
        $('#cookie-consent').remove();
    }
</script>
@endif
<script>
    $('#dismiss-message').click(function(){
        $('.alert-dismissible').remove();
    });
</script>
@yield('js')
</body>
</html>
