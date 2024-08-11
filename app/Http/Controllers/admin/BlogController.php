<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(24);
        $this->seo()->setTitle('تمام نوشته ها');
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle("ایجاد مقاله جدید");
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'user_id' => ['required' , 'exists:users,id'] ,
            'description' => ['required_if:status,0','string'],
            'image' => ['required_if:status,0'] ,
            'video' => ['nullable'] ,
            'category' => ['required_if:status,0', 'exists:categories,id'],
            'slug' => ['nullable' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],
            'status' => ['required' , 'boolean'],

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug'] = str_replace([' ','‌'], '-', $request->slug);
        } else {
            $request['slug'] = str_replace([' ','‌'], '-', $request->title);
            /*End Slug Handler*/
        }

        $blog = Blog::create($request->all());

        try {
            $blog->categories()->sync($request['category']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "مقاله ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }
        Alert::success("مقاله   $blog->title با موفقیت ایجاد شد. ");
        return redirect(route('admin.blogs.index'));

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
    public function edit(Blog $blog)
    {
        $this->seo()->setTitle("ویرایش مقاله $blog->title ");
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $valid = Validator::make($request->all() , [
            'title' => ['required' , 'string' , 'min:2'] ,
            'user_id' => ['required' , 'exists:users,id'] ,
            'description' => ['required_if:status,0','string'],
            'image' => ['required_if:status,0'] ,
            'video' => ['nullable'] ,
            'category' => ['required_if:status,0', 'exists:categories,id'],
            'slug' => ['nullable' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],
            'status' => ['required' , 'boolean'],

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug'] = str_replace([' ','‌'], '-', $request->slug);
        } else {
            $request['slug'] = str_replace([' ','‌'], '-', $request->title);
            /*End Slug Handler*/
        }

        $blog->update($request->all());

        try {
            $blog->categories()->sync($request['category']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "مقاله ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }
        Alert::success("مقاله$blog->title با موفقیت بروز شد. ");
        return redirect(route('admin.blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
