<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($blogs as $blog)
    <url>
        <loc>{{route('blog.show' , ['category' => $blog->categories[0]->slug, 'blog' => $blog->slug])}}</loc>
        <lastmod>{{ $blog->updated_at->toDateString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

</urlset>
