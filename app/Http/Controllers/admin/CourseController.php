<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\PartTime;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{
    use SEOTools;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->paginate('12');
        $this->seo()->setTitle('دوره ها');
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle('ایجاد دوره جدید');
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required_if:is_draft,0|string|in:online,offline',
            'image' => 'nullable',
            'description' => 'required_if:is_draft,0|string',
            'teacher_id' => 'required|exists:users,id',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'required_if:is_draft,0|integer|min:1',
            'weeks' => 'required_if:is_draft,0|integer|min:1',
            'minutes' => 'required_if:is_draft,0|integer|min:1',
            'capacity' => 'required_if:is_draft,0|integer|min:1',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'homework' => 'nullable|string',
            'is_draft' => 'required|boolean',
            'category' => ['required_if:is_draft,0' , 'exists:categories,id'],
            'slug' => ['nullable' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],
        ]);

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        if ($request['is_draft'] == 1) {
            $request['status'] = 'پیش نویس';
        } else {
            $request['status'] = 'در انتظار تایید اولیه';
        }


        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug'] = str_replace(' ', '-', $request->slug);
        } else {
            $request['slug'] = str_replace(' ', '-', $request->title);
            /*End Slug Handler*/
        }



        $course = Course::create($request->all());

        try {
            $course->categories()->sync($request['category']);
        }catch (\Exception $exception){
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }

        Alert::success("دوره  $course->title با موفقیت ایجاد شد. ");
        return redirect(route('admin.courses.index'));

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
    public function edit(Course $course)
    {
        $this->seo()->setTitle("ویرایش دوره $course->title");
            return view('admin.courses.edit', compact('course') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required_if:is_draft,0|string|in:online,offline',
            'image' => 'nullable',
            'description' => 'required_if:is_draft,0|string',
            'teacher_id' => 'required|exists:users,id',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'required_if:is_draft,0|integer|min:1',
            'weeks' => 'required_if:is_draft,0|integer|min:1',
            'minutes' => 'required_if:is_draft,0|integer|min:1',
            'capacity' => 'required_if:is_draft,0|integer|min:1',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'homework' => 'nullable|string',
            'is_draft' => 'required|boolean',
            'category' => ['required_if:is_draft,0' , 'exists:categories,id'],
            'slug' => ['required' , 'string'],
            'meta_title' => ['nullable' , 'string'],
            'meta_keywords' => ['nullable' , 'string'],
            'meta_description' => ['nullable' , 'string'],
        ]);

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        if ($request['is_draft'] == 1) {
            $request['status'] = 'پیش نویس';
        }



        $course->update($request->all());

        try {
            $course->categories()->sync($request['category']);
        }catch (\Exception $exception){
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }

        Alert::success("دوره  $course->title با موفقیت ایجاد شد. ");
        return redirect(route('admin.courses.index'));
    }



    public function schedule(Course $course)
    {

        $days = [
            ["id" => 1, "day_farsi" => "شنبه", "day_english" => "Saturday"],
            ["id" => 2, "day_farsi" => "یک‌شنبه", "day_english" => "Sunday"],
            ["id" => 3, "day_farsi" => "دوشنبه", "day_english" => "Monday"],
            ["id" => 4, "day_farsi" => "سه‌شنبه", "day_english" => "Tuesday"],
            ["id" => 5, "day_farsi" => "چهارشنبه", "day_english" => "Wednesday"],
            ["id" => 6, "day_farsi" => "پنج‌شنبه", "day_english" => "Thursday"],
            ["id" => 7, "day_farsi" => "جمعه", "day_english" => "Friday"]
        ];

        $this->seo()->setTitle("زمان بندی دوره $course->title");
        return view('admin.courses.schedule.index' , compact('course' , 'days'));

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function time(Request $request , Course $course)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $request['status'] = 1 ;
        $request['course_id'] = $course->id ;

        PartTime::create($request->all());
        Alert::success("زمان بندی جدید برای دوره $course->title با موفقیت ایجاد شد. ");
        return back();
    }





}
