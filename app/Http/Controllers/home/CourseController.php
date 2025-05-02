<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Headline;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    use SEOTools;


    public function index()
    {
        $this->seo()->setTitle("دوره‌های آموزشی آنلاین و آفلاین برای کودکان، نوجوانان و جوانان | حلزون");
        $this->seo()->setDescription("با دوره‌های آموزشی متنوع حلزون، یادگیری را برای کودکان، نوجوانان و جوانان به تجربه‌ای هیجان‌انگیز تبدیل کنید! آموزش‌های آنلاین و آفلاین شامل مهارت‌های هنری، علمی، ورزشی و رشد فردی، به صورت ویژه برای سنین مختلف طراحی شده‌اند. بهترین دوره‌ها برای رشد و پرورش استعدادها در حلزون!");

        $page = request('page', 1); // اگر صفحه مشخص نشده، پیش‌فرض صفحه 1
        $cacheKey = "courses_page_" . $page;

        $courses = Cache::remember($cacheKey, 60 * 60, function () use ($page) {
            return Course::where('is_draft', 0)->paginate(24, ['*'], 'page', $page);
        });

        SEOMeta::setCanonical(route("course.index"));

        SEOMeta::setRobots('index, follow');

        return view('home.courses.index', compact('courses'));

    }


    public function show(Course $course)
    {

        if (!is_null($course->meta_title)) {
            $this->seo()->setTitle($course->meta_title);
        } else {
            $this->seo()->setTitle($course->title);
        }

        $this->seo()->setDescription($course->meta_description) ;

        SEOMeta::setCanonical(route("course.show" , $course));

        SEOMeta::setRobots('index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');


        $questions= Cache::remember('questions_course'.$course->id , 60*120 , function ()use ($course) {
            return $course->questions ;
        });


        return view('home.courses.show', compact('course' , 'questions'));
    }


    public function headline(Course $course, Headline $headline)
    {
        if ($course->type == 'offline') {
            $this->seo()->setTitle($headline->title);

            return view('home.courses.headline', compact('course', 'headline'));
        }
        abort(404);
    }


}
