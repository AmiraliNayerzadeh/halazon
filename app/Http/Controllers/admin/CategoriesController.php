<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MedicineCategory;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('parent_id' , null)->paginate(21);
        $this->seo()->setTitle('دسته بندی ها');
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle('ایجاد دسته بندی');

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'title_en' => ['required'] ,
            'parent' => ['nullable'] ,
            'image' => ['nullable'] ,
            'description' => ['nullable','string'],
            'slug' => ['nullable' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],

        ]) ;

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }



        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug']= str_replace(' ' , '-', $request->slug);
        }else
            $request['slug']= str_replace(' ' , '-', $request->title_en);
        /*End Slug Handler*/



        $category = Category::create($request->all());

        Alert::success("دسته بندی $category->title با موفقیت ایجاد شد. ");
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->seo()->setTitle("مشاهده زیر دسته بندی $category->title ");
        return view('admin.categories.show' , compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->seo()->setTitle("ویرایش دسته بندی $category->title ");
        return view('admin.categories.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'title_en' => ['required'] ,
            'parent' => ['nullable'] ,
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



        $category->update($request->all());

        Alert::success("دسته بندی $category->title با موفقیت بروزرسانی شد. ");
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
