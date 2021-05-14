<div class="jl_sidebar_w">
    <div id="sprasa_ads300x250_widget-2" class="widget jellywp_ads300x250_widget">
        <div class="widget_jl_wrapper ads_widget_container">
            <div class="widget-title"><h2 class="jl_title_c">Stay Connected</h2></div>
            <div class="jl_single_share_wrapper jl_clear_at">
                <ul class="single_post_share_icon_post">
                    @if(isset($settings['facebook-link']))
                    <li class="single_post_share_facebook"><a href="{{$settings['facebook-link']}}" target="_blank"><i class="jli-facebook"></i></a></li>
                    @endif
                    @if(isset($settings['twitter-link']))
                    <li class="single_post_share_twitter"><a href="{{$settings['twitter-link']}}" target="_blank"><i class="jli-twitter"></i></a></li>
                    @endif
                    @if(isset($settings['pinterest-link']))
                    <li class="single_post_share_pinterest"><a href="{{$settings['pinterest-link']}}" target="_blank"><i class="jli-pinterest"></i></a></li>
                    @endif
                    @if(isset($settings['linkedin-link']))
                    <li class="single_post_share_linkedin"><a href="{{$settings['linkedin-link']}}" target="_blank"><i class="jli-linkedin"></i></a></li>
                    @endif
                    @if(isset($settings['instagram-link']))
                    <li class="single_post_share_instagram"><a href="{{$settings['instagram-link']}}" target="_blank"><i class="jli-instagram"></i></a></li>
                    @endif
                </ul>
                <div class="ads300x250-thumb jl_radus_e">
                    <a href="#"><img src="{{asset('optimal/img/ads.png')}}" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</div>