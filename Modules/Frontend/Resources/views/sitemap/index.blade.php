<?xml version="1.0" encoding="UTF-8"?>
<?php
	$last_page = $article->lastPage();
	?>
  <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if(count($news) > 0)
    <sitemap>
        <loc>{{URL::to('/sitemap_news.xml')}}</loc>
    </sitemap>
    @endif
    @for($i=1; $i<=$last_page; $i++)
    <sitemap>
       <loc>{{URL::to('/sitemap_'.$i.'.xml')}}</loc>
    </sitemap>
    @endfor
  </sitemapindex>
