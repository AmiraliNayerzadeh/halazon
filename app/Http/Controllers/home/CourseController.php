<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use SEOTools;

    public function show(Course $course)
    {
        if (!is_null($course->meta_title)) {
            $this->seo()->setTitle($course->meta_title);
        } else {
            $this->seo()->setTitle($course->title);
        }




        return view('home.courses.show' , compact('course')) ;


    }
}
