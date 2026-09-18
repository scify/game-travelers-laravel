{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($pages as $page)
    <url>
        <loc>{{ route($page['route']) }}</loc>
        <changefreq>{{ $page['frequency'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <image:image>
            <image:loc>{{ asset('images/taxidiotes_logo.webp') }}</image:loc>
            <image:caption>{{ $page['caption'] }}</image:caption>
        </image:image>
    </url>
@endforeach
</urlset>
