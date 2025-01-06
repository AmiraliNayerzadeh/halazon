<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use SEOTools;

    public function index()
    {
        $this->seo()->setTitle("📚 مجله حلزون | یادگیری، رشد 🌱 و موفقیت 🚀 در یک قدمی شما");
        $this->seo()->setDescription('"در آرشیو مقالات سایت آموزشی کودکان حلزون، مجموعه‌ای از مقالات آموزشی و مفید برای والدین، مربیان و کودکان فراهم آمده است. از موضوعات تربیتی و روانشناسی کودک تا فعالیت‌های سرگرم‌کننده و آموزش‌های مناسب سنین مختلف، این آرشیو منبعی کامل برای رشد و توسعه کودکان شماست.');
        SEOMeta::setCanonical(route('blog.index'));
        SEOMeta::setRobots('index, follow');

        $blogs = Blog::where('status', 1)->latest()->paginate(24);
        return view('home.blogs.index', compact('blogs'));
    }

    public function show(Category $category, Blog $blog)
    {

        if (!is_null($blog->meta_title)) {
            $this->seo()->setTitle($blog->meta_title);
        } else
            $this->seo()->setTitle($blog->title);

        $this->seo()->setDescription($blog->meta_description);

        SEOMeta::setRobots('index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');


        SEOMeta::setCanonical(route('blog.show', [$blog->categories->first()->slug, $blog->slug]));


        return view('home.blogs.show', compact('blog'));
    }


    public function category(Category $category)
    {
        $this->seo()->setTitle("مقاله های $category->title");
        SEOMeta::setRobots('index, follow');

        $blogs = $category->blogs()->paginate(24);
        return view('home.blogs.category', compact('category', 'blogs'));
    }


}
