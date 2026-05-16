<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
<url>
    <loc>{{ is_array($url) ? $url['loc'] : $url }}</loc>
    @if (is_array($url) && !empty($url['lastmod']))
    <lastmod>{{ $url['lastmod'] }}</lastmod>
    @endif
    @if (is_array($url) && !empty($url['changefreq']))
    <changefreq>{{ $url['changefreq'] }}</changefreq>
    @endif
    @if (is_array($url) && !empty($url['priority']))
    <priority>{{ $url['priority'] }}</priority>
    @endif
</url>
@endforeach
</urlset>
