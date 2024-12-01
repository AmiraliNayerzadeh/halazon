<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function static()
    {
        $xml = view('sitemap.static')->render();
        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    public function blogs()
    {
        $blogs = Cache::remember('sitemap_blog' , 60*60 , function () {
           return Blog::where('status' , 1)->get();
        });

        $xml = view('sitemap.blogs', compact('blogs'))->render();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function blogCategory()
    {
        $categories = Cache::remember('sitemap_blog_category' , 60*60 , function () {
            return Category::where('parent_id' , null)->get();
        });

        $xml = view('sitemap.blogsCategories', compact('categories'))->render();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
    
}
