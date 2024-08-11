<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    use SEOTools ;
    public function index()
    {
        $this->seo()->setTitle('پروفایل کاربری') ;
        $user = \auth()->user();
        return \view('home.profile.index' , compact('user'));
    }


    public function comment()
    {
        $this->seo()->setTitle('دیدگاه و پرسش ها') ;
        $user = \auth()->user();
        $comments = $user->comments ;

        return view('home.profile.comment' , compact('comments'));
    }

    public function favorite()
    {
        $this->seo()->setTitle('علاقه مندی ها') ;
        $user = \auth()->user();

        $favorites = $user->favorites ;
        /*2347*/
        return view('home.profile.favorite' , compact('favorites'));
    }

}
