<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    use SEOTools ;
    public function main(Category $category)
    {
        if (!is_null($category->meta_title)) {
            $this->seo()->setTitle("$category->meta_title");
        } else {
            $this->seo()->setTitle("$category->title");
        }
        SEOMeta::setCanonical(route('category', $category));
        $courses = $category->courses()->where('status' , 'منتشر شده')->paginate(12);


        $blogs = Cache::remember('blogs_category_' . $category->id, 60 * 60, function () use ($category) {
            return $category->blogs()
                ->latest()->where('status' , 1)
                ->take(5)
                ->get();
        });


        return view('home.categories.main' , compact('category' , 'courses' , 'blogs'));

    }
}
