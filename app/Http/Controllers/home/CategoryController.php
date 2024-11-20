<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

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

        $courses = $category->courses()->where('status' , 'منتشر شده')->paginate(12);


        return view('home.categories.main' , compact('category' , 'courses'));

    }
}
