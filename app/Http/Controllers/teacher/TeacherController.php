<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class TeacherController extends Controller
{
    use SEOTools ;

    public function index()
    {
        $this->seo()->setTitle('داشبورد پنل معمین') ;



        $countCourse = count(auth()->user()->courses);

        return view('teacher.dashboard' , compact('countCourse' ));

    }
    
}
