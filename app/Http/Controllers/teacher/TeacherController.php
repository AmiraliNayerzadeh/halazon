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
        $this->seo()->setTitle('داشبورد پنل معمین');

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
            'nationalCode' => ['required', 'numeric',],
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
        // گرفتن کاربر لاگین شده
        $user = auth()->user();


        $valid = Validator::make($request->all(), [
            'avatar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'id_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'last_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'resume' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->storeAs('public/uploads/avatar', $request->file('avatar')->getClientOriginalName());
            $user->avatar = $avatarPath;
        }

        if ($request->hasFile('id_card')) {
            $idCardPath = $request->file('id_card')->storeAs('public/uploads/id_card', $request->file('id_card')->getClientOriginalName());
            $user->id_card = $idCardPath;
        }

        if ($request->hasFile('last_certificate')) {
            $certificatePath = $request->file('last_certificate')->storeAs('public/uploads/last_certificate', $request->file('last_certificate')->getClientOriginalName());
            $user->last_certificate = $certificatePath;
        }

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->storeAs('public/uploads/resume', $request->file('resume')->getClientOriginalName());
            $user->resume = $resumePath;
        }

        // ذخیره اطلاعات به‌روز شده
        $user->save();

        Alert::success("با موفقیت ثبت شد");


        // هدایت کاربر به صفحه قبلی یا نمایش پیام موفقیت
        return redirect()->back()->with('success', 'فایل‌ها با موفقیت آپلود و ذخیره شدند.');
    }


}
