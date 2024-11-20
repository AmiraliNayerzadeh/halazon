<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Degree;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    use SEOTools ;
    public function home()
    {

        $this->seo()->setTitle('پلتفرم آموزشی حلزون') ;

        $countTeacher = Cache::remember('countTeacher' , '720' , function () {
            return count(User::where('is_teacher' , 1)->where('is_verify' , 1)->take(6)->get()) ;
        });

        $degrees = Cache::rememberForever('degrees', function () {
            return Degree::whereIn('id', [1, 2, 3, 4])->get();
        });




        $mainCategory = Cache::remember('mainCategory' , 10080 , function (){
            return  Category::where('parent_id' , null)->get();
        });



        $courses = Cache::remember('lastCourse' ,'2880' , function (){
            return Course::where('status', "منتشر شده")->where('type','online')->take(6)->get();
        });


        $teachers = Cache::remember('teacher' ,'720' , function (){
            return User::where('is_teacher' , 1)->where('is_verify' , 1)->take(6)->get();
        });


        $blogs = Cache::remember('lastBlog' ,'2880' , function (){
            return Blog::where('status' , 1)->take(6)->get();
        });


        return view('home.home.index' , compact('degrees' , 'mainCategory' , 'courses' , 'teachers' , 'countTeacher' , 'blogs'));
    }


    public function contact()
    {
        $this->seo()->setTitle("تماس با ما") ;

        return view('home.landing.contact');

    }

    public function contactStore(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'name' => ['required' , 'string' , 'min:2'] ,
            'phone' => ['required'] ,
            'email' => ['nullable'] ,
            'description' => ['nullable'] ,
        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        Contact::create($request->all()) ;


        Alert::success("درخواست تماس شما با موفقیت ثبت شد. کارشناسان ما در اسرع وقت با شما تماس خواهند گرفت.");

        return back();


    }


    public function about()
    {
        $this->seo()->setTitle("درباره ما");
        return view('home.landing.about');
    }

    public function terms()
    {
        $this->seo()->setTitle("قوانین و مقررات حلزون");
        return view('home.landing.terms');


    }
    
    
    
    
}
