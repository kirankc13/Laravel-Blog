<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9" lang="en-US"> <![endif]-->
<html lang="en-US">
    <head>

        @if(isset($settings['google-analytics']))
            {!! $settings['google-analytics'] !!}
        @endif
        <!-- Website Meta Tags -->
        @yield('meta_tags')
        <!-- Stylesheets-->
        <link rel="stylesheet" rel="dns-prefetch" href="{{asset('optimal/css/style.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('optimal/css/custom.css')}}" type="text/css" media="all" />
        <!-- End Stylesheets-->
        @if(isset($settings['adsense']))
            {!! $settings['adsense'] !!}
        @endif
    </head>
    <!-- End Head -->