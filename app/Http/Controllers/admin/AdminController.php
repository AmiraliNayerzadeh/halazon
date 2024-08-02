<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use SEOTools;

    public function dashboard()
    {
        $this->seo()->setTitle('داشبورد');

        return view('admin.layout.master');
    }
}
