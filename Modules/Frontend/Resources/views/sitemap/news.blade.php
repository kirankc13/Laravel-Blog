<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
@foreach ($article as $content)
  <url>
    <loc>{{URL::to('/'.$content->cat_slug.'/'.$content->slug)}}</loc>
    <news:news>
    <news:publication>
      <news:name>{{setting('website-name')}}</news:name>
      <news:language>en</news:language>
    </news:publication>
    <news:publication_date>{{ date('Y-m-d', strtotime($content->updated_at)) }}</news:publication_date>
      <news:title>{{ $content->title }}</news:title>
    </news:news>
  </url>
@endforeach
</urlset>
