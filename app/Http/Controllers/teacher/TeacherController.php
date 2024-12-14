<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    use SEOTools;

    public function index()
    {
        $this->seo()->setTitle('داشبورد پنل معلمین');

        $user = auth()->user();
        $countCourse = count(auth()->user()->courses);

        return view('teacher.dashboard', compact('countCourse', 'user'));

    }


    public function profile()
    {
        $this->seo()->setTitle('اطلاعات حساب کاربری');

        $user = auth()->user();


        $mainCategories = $user->categories()->whereNull('parent_id')->pluck('categories.id')->toArray();

        $subCategories = $user->categories()->whereNotNull('parent_id')->pluck('categories.id')->toArray();


        $categories = Cache::remember('categories_all', now()->addDay(), function () {
            return Category::all();
        });

        return view('teacher.CompleteUser', compact('user', 'categories', 'mainCategories', 'subCategories'));
    }

    public function completeInformation()
    {

        $this->seo()->setTitle('تکمیل ثبت نام');

        $user = auth()->user();


        $mainCategories = $user->categories()->whereNull('parent_id')->pluck('categories.id')->toArray();

        $subCategories = $user->categories()->whereNotNull('parent_id')->pluck('categories.id')->toArray();


        $categories = Cache::remember('categories_all', now()->addDay(), function () {
            return Category::all();
        });

        return view('teacher.CompleteUser', compact('user', 'categories', 'mainCategories', 'subCategories'));
    }

    public function information(Request $request)
    {

        $user = auth()->user();

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'email' => ['nullable', 'unique:users,email,' . $user->id, 'email', 'lowercase', 'max:255'],
            'birthday' => ['required'],
            'nationalCode' => ['required', 'numeric'],
            'description' => ['nullable'],

        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $birthday = null;
        if (!is_null($request->birthday)) {
            list($year, $month, $day) = explode('/', $request->birthday);
            $birthday = Jalalian::fromFormat('Y/m/d', "$year/$month/$day")->toCarbon()->format('Y-m-d');
        }

        $fullName = $request['name'] . ' ' . $request['family'];
        $slug = $request['slug'] = Str::slug($fullName);

        auth()->user()->update(
            [
                'name' => $request['name'],
                'family' => $request['family'],
                'gender' => $request['gender'],
                'email' => $request['email'],
                'birthday' => $birthday,
                'nationalCode' => $request['nationalCode'],
                'description' => $request['description'],
                'slug' => $slug
            ]
        );


        Alert::success("اطلاعات شما با موفقیت ثبت شد.");
        return back();

    }


    public function informationCategory(Request $request)
    {
        $user = auth()->user();

        $valid = Validator::make($request->all(), [
            'main-categories' => ['required', 'array'],
            'main-categories.*' => ['exists:categories,id'],

            'sub-categories' => ['required', 'array'],
            'sub-categories.*' => ['exists:categories,id'],
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $allCategories = array_merge($request['sub-categories'], $request['main-categories']);

        $user->categories()->sync($allCategories);


        Alert::success("دسته بندی های مورد نظر با موفقیت ثبت شد.");
        return back();

    }


    public function getMainCategories()
    {
        $categories = Category::whereNull('parent_id')->get(['id', 'title']);
        return response()->json($categories);
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = Category::whereIn('parent_id', $request->category_ids)->get(['id', 'title']);
        return response()->json($subCategories);
    }

    public function upload(Request $request)
    {
        $user = auth()->user();


        $valid = Validator::make($request->all(), [
            'avatar' => 'nullable|file',
            'id_card' => 'nullable|file',
            'last_certificate' => 'nullable|file',
            'resume' => 'nullable|file',
            'video' => 'nullable|file',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        if ($request->hasFile('avatar')) {
            $directory = "/storage/photos/avatar/";
            $fileName = 'photo_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('avatar')->getClientOriginalExtension();

            // ذخیره فایل در مسیر مشخص شده
            $path = $request->file('avatar')->storeAs("public/photos/avatar", $fileName);

            // ذخیره مسیر کامل در دیتابیس
            $user->avatar = $directory . $fileName;
        }



        if ($request->hasFile('id_card')) {
            $directory = "/storage/photos/id_card/";
            $fileName = 'idcard_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('id_card')->getClientOriginalExtension();

            // ذخیره فایل در مسیر مشخص شده
            $path = $request->file('id_card')->storeAs("public/photos/id_card", $fileName);

            // ذخیره مسیر کامل در دیتابیس
            $user->id_card = $directory . $fileName;
        }

        if ($request->hasFile('last_certificate')) {
            $directory = "/storage/photos/last_certificate/";
            $fileName = 'certificate_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('last_certificate')->getClientOriginalExtension();

            // ذخیره فایل در مسیر مشخص شده
            $path = $request->file('last_certificate')->storeAs("public/photos/last_certificate", $fileName);

            // ذخیره مسیر کامل در دیتابیس
            $user->last_certificate = $directory . $fileName;
        }

        if ($request->hasFile('resume')) {
            $directory = "/storage/photos/resume/";
            $fileName = 'resume_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('resume')->getClientOriginalExtension();

            $path = $request->file('resume')->storeAs("public/photos/resume", $fileName);

            $user->resume = $directory . $fileName;
        }


        if ($request->hasFile('video')) {
            $directory = "/storage/users/video/";
            $fileName = 'video_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('video')->getClientOriginalExtension();

            $path = $request->file('video')->storeAs("public/users/video", $fileName);

            $user->video = $directory . $fileName;
        }

        // ذخیره اطلاعات به‌روز شده
        $user->save();

        Alert::success("با موفقیت ثبت شد");


        // هدایت کاربر به صفحه قبلی یا نمایش پیام موفقیت
        return redirect()->back()->with('success', 'فایل‌ها با موفقیت آپلود و ذخیره شدند.');
    }


}
