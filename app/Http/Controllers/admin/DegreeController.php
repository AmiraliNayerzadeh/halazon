<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Degree;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DegreeController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degrees = Degree::latest()->paginate(21);
        $this->seo()->setTitle('مقاطع');
        return view('admin.degrees.index', compact('degrees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle('ایجاد مقطع');

        return view('admin.degrees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'image' => ['nullable'] ,
            'description' => ['nullable','string'],
            'slug' => ['required' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        /*Slug Handler*/
            $request['slug']= str_replace([' ','‌'] , '-', $request->slug);
        /*End Slug Handler*/

        $degree = Degree::create($request->all());

        Alert::success("مقطع $degree->title با موفقیت ایجاد شد. ");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Degree $degree)
    {
        $this->seo()->setTitle(" ویرایش دسته بندی $degree->title ");
        return view('admin.degrees.edit' , compact('degree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Degree $degree)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'image' => ['nullable'] ,
            'description' => ['nullable','string'],
            'slug' => ['required' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],

        ]) ;

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        /*Slug Handler*/
        $request['slug']= str_replace([' ','‌'] , '-', $request->slug);
        /*End Slug Handler*/


        $degree->update($request->all());

        Alert::success("دسته بندی $degree->title با موفقیت بروزرسانی شد. ");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
