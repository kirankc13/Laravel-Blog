<meta charset="utf-8">
<title>{{$post->meta_title}}</title>
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
<meta property="og:title" content="{{$post->title}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:description" content="{{$post->meta_desc}}">
<meta name="description" content="{{$post->meta_desc}}">
<meta property="og:image" content="{{ $post->image }}">
<meta property="og:image:secure_url" content="{{ $post->image }}">

<meta name=”twitter:title” content="{{$post->title}}">
<meta name=”twitter:description” content="{{$post->meta_desc}}">
<meta name=”twitter:image” content="{{ $post->image }}">
<meta name="twitter:card" content="#">
<meta name="twitter:site" content="#">
<meta name="twitter:creator" content="#">
<meta property="twitter:url" content="{{ $post->post_url }}">
<meta name="keywords" content="">
@if(Request::routeIs('post'))
<link rel="amphtml" href="{{$post->amp_url}}">
@else
<link rel="canonical" href="{{$post->post_url}}">
@endif

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Article",
		"mainEntityOfPage": {
			"@type": "WebPage",
			"@id": "{{url()->current()}}"
		},
		"headline": "{{$post->title}}",
		"description": "{{$post->meta_desc}}",
		"image": "{{ $post->image }}",
		"author": {
			"@type": "Person",
			"name": "{{$post->author}}"
		},
		"publisher": {
			"@type": "Organization",
			"name": "{{ isset($settings['website-name']) ? $settings['website-name'] : '' }}",
			"logo": {
				"@type": "ImageObject",
				"url": "{{ isset($settings['logo']) ? $settings['logo'] : ''  }}",
				"width": 171,
				"height": 50
			}
		},
		"datePublished": "{{$post->created_at}}",
		"dateModified": "{{$post->updated_at}}"
	}
</script>
