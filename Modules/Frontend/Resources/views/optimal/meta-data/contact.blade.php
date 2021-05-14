<meta charset="utf-8">
<title>{{$page->meta_title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
@if(isset($settings['robots-tag']))
<meta name="robots" content="{{$settings['robots-tag']}}"/>
@endif
@if(isset($settings['syndication-source']))
<meta name="syndication-source" content="{{$settings['syndication-source']}}">
@endif
@if(isset($settings['fb-app-id']))
<meta property="fb:app_id" content="{{$settings['fb-app-id']}}">
@endif
@if(isset($settings['fb-admins']))
<meta property="fb:admins" content="{{$settings['fb-admins']}}"/>
@endif
@if(isset($settings['p-domain-verify']))
<meta name="p:domain_verify" content="{{$settings['p-domain-verify']}}">
@endif
@if(isset($settings['apple-touch-icon']))
<link rel="apple-touch-icon" sizes="180x180" href="{{$settings['apple-touch-icon']}}">
@endif
@if(isset($settings['favicon-32']))
<link rel="icon" type="image/png" sizes="32x32" href="{{$settings['favicon-32']}}">
@endif
@if(isset($settings['favicon-16']))
<link rel="icon" type="image/png" sizes="16x16" href="{{$settings['favicon-16']}}">
@endif
@if(isset($settings['rss-feed']))
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{{$settings['rss-feed']}}" />
@endif
@if(isset($settings['og:type']))
<meta property=”og:type” content="{{$settings['og:type']}}">
@endif
<meta property="og:title" content="{{$page->meta_title}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:description" content="{{$page->meta_desc}}">
<meta name="description" content="{{$page->meta_desc}}">
<meta name=”twitter:title” content="{{$page->meta_title}}">
<meta name=”twitter:description” content="{{$page->meta_desc}}">
@if($page->image)
<meta property="og:image" content="{{render($page->image)}}">
<meta name=”twitter:image” content="{{render($page->image)}}">
<meta property="og:image:secure_url" content="{{render($page->image)}}">
@else
   @if(isset($settings['og:image']))
<meta property="og:image" content="{{$settings['og:image']}}">
<meta property="og:image:secure_url" content="{{$settings['og:image']}}">
<meta name=”twitter:image” content="{{$settings['og:image']}}">
   @endif
@endif
<link rel="canonical" href="{{url()->current()}}">