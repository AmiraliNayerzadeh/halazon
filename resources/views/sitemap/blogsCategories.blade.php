<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($categories as $category)
    <url>
        <loc>{{route('blog.category' , $category)}}</loc>
        <lastmod>{{ $category->updated_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
