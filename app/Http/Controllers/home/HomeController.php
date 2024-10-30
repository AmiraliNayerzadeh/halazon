<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use App\Models\Degree;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use SEOTools ;
    public function home()
    {

        $this->seo()->setTitle('پلتفرم آموزشی حلزون') ;

        $countTeacher = Cache::remember('countTeacher' , '720' , function () {
            return count(User::where('is_teacher' , 1)->where('is_verify' , 1)->take(6)->get()) ;
        });

        $degrees = Cache::remember('degress' , 10080 , function (){
            return  Degree::all();
        });


        $mainCategory = Cache::remember('mainCategory' , 10080 , function (){
            return  Category::where('parent_id' , null)->get();
        });



        $courses = Cache::remember('lastCourse' ,'2880' , function (){
            return Course::where('is_draft' , 0)->where('type','online')->take(6)->get();
        });


        $teachers = Cache::remember('teacher' ,'720' , function (){
            return User::where('is_teacher' , 1)->where('is_verify' , 1)->take(6)->get();
        });


        $blogs = Cache::remember('lastBlog' ,'2880' , function (){
            return Blog::where('status' , 1)->take(6)->get();
        });


        return view('home.home.index' , compact('degrees' , 'mainCategory' , 'courses' , 'teachers' , 'countTeacher' , 'blogs'));
    }


    public function terms()
    {
        dd('this is terms');
    }
}
