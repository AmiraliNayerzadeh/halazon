<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DegreeController extends Controller
{
    use SEOTools ;


    public function index()
    {
        $this->seo()->setTitle('مقاطع');
        SEOMeta::setCanonical(route('degrees.index'));

        $degrees = Cache::remember('degrees' , '10080', function (){
            return Degree::all();
        });
        return view('home.degrees.index' , compact('degrees'));
    }


    public function show(Degree $degree)
    {
        $this->seo()->setTitle("مقطع $degree->title");
        SEOMeta::setCanonical(route('degrees.show' , $degree));

        $courses = $degree->courses()->where('is_draft' , 0)->paginate(12) ;

        return view('home.degrees.show' , compact('degree' , 'courses'));
    }


}
