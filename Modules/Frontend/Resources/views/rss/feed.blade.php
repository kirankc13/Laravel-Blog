<?xml version="1.0" encoding="utf-8"?>
<rss version="0.91">
	<channel>
		<title>
            {{setting('website-meta-title')}}
		</title>
		<link>
			{{URL::to('/')}}
		</link>
		<description>
			{{setting('seo-description')}}
		</description>
		<language>
			en-us
		</language>
		<copyright>
            Copyright {{date('Y')}}, SB Web Technology.
		</copyright>
		<image>
			<title>
				{{setting('website-meta-title')}}
			</title>
			<url>
                {{setting('logo')}}
			</url>
			<link>
                {{URL::to('/')}}
			</link>
			<width>
				40
			</width>
			<height>
				25
			</height>
			<description>
				{{setting('seo-description')}}
			</description>
		</image>
        @foreach($articles as $a)
		<item>
			<title>
				{{$a->title}}
			</title>
			<link>
                {{URL::to('/'.$a->cat_slug.'/'.$a->slug.'.html')}}
			</link>
			@php
				$extension = pathinfo($a->image, PATHINFO_EXTENSION);
			@endphp
            <category>{{URL::to($a->cat_slug.'.html')}}</category>
			<description>
				{{$a->summary}}
			</description>
            <pubDate>{{date(DATE_RFC822, strtotime($a->created_at))}}</pubDate>
		</item>
        @endforeach
	</channel>
</rss>
