<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home.index');
    }


    public function terms()
    {
        dd('this is terms');
    }
}
