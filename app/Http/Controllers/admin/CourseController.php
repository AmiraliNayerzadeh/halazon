<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Day;
use App\Models\Headline;
use App\Models\PartTime;
use App\Models\Question;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;

class CourseController extends Controller
{
    use SEOTools;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $this->seo()->setTitle('دوره ها');


        $title= $request['title'];
        $teacher= $request['teacher'];
        $type= $request['type'];

        $item = Course::query() ;

        if (!is_null($title)) {
            $item->where('title' , 'LIKE' , "%$title%");
        }

        if (!is_null($teacher)) {
            $item->where('teacher_id'  , $teacher);
        }

        if (!is_null($type)) {
            $item->where('type'  , $type);
        }

        $courses = $item->latest()->paginate(12)->withQueryString();


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
            'video' => 'nullable',
            'description' => 'required_if:is_draft,0|string',
            'teacher_id' => 'required|exists:users,id',
            'degrees' => 'required_if:is_draft,0|exists:degrees,id|array',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'nullable|integer|min:1|required_unless:type,offline',
            'weeks' => 'nullable|integer|min:1|required_unless:type,offline',
            'minutes' =>'nullable|integer|min:1|required_unless:type,offline',
            'capacity' => 'nullable|integer|min:1|required_unless:type,offline',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'is_draft' => 'required|boolean',
            'category' => ['required_if:is_draft,0', 'exists:categories,id'],
            'revenue' => ['required', 'integer', 'min:0', 'max:100'],
            'slug' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            /*Questions*/
            'questions.learning_goal' => 'required|string',
            'questions.assessment_method' => 'required|string',
            'questions.requirements' => 'required|string',
            'questions.duration_needed' => 'required|string',

        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        if ($request['is_draft'] == 1) {
            $request['status'] = 'پیش نویس';
        } else {
            $request['status'] = 'در انتظار تایید اولیه';
        }


        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug'] = str_replace([' ', '‌'], '-', $request->slug);
        } else {
            $request['slug'] = str_replace([' ', '‌'], '-', $request->title);
            /*End Slug Handler*/
        }


        $course = Course::create($request->all());

        try {
            $course->categories()->sync($request['category']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }


        try {
            $course->degrees()->sync($request['degrees']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }

        $questions = $request->input('questions');

        $questionTexts = [
            'learning_goal' => 'هدف یادگیری این دوره چیست؟',
            'assessment_method' => 'چگونه قصد دارید پیشرفت دانش‌آموزان را ارزیابی کنید؟',
            'requirements' => 'چه مواردی برای شرکت در این دوره مورد نیاز است؟',
            'duration_needed' => 'برای مطالعه در هر هفته به چه میزان زمان نیاز است؟',
        ];


        foreach ($questions as $key => $value) {
            if (isset($questionTexts[$key])) {

                Question::create([
                    'question' => $questionTexts[$key],
                    'answer' => $value,
                    'user_id' => auth()->id(),
                    'questionable_id' => $course->id,
                    'questionable_type' => get_class($course),

                ]);
            }
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

        $questions = $course->questions;

        return view('admin.courses.edit', compact('course', 'questions'));
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
            'video' => 'nullable',
            'description' => 'required_if:is_draft,0|string',
            'teacher_id' => 'required|exists:users,id',
            'degrees' => 'required_if:is_draft,0|exists:degrees,id|array',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'nullable|integer|min:1|required_unless:type,offline',
            'weeks' => 'nullable|integer|min:1|required_unless:type,offline',
            'minutes' =>'nullable|integer|min:1|required_unless:type,offline',
            'capacity' => 'nullable|integer|min:1|required_unless:type,offline',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'homework' => 'nullable|string',
            'is_draft' => 'required|boolean',
            'category' => ['required_if:is_draft,0', 'exists:categories,id'],
            'revenue' => ['required', 'integer', 'min:0', 'max:100'],
            'slug' => ['required', 'string'],
            'meta_title' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
            /*Questions*/
            'questions' => 'nullable|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.answer' => 'required|string',
        ]);


        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        if ($request['is_draft'] == 0) {
            $request['status'] = 'پیش نویس';
        }else {
            $request['status'] = 'منتشر شده';
        }


        /*Slug Handler*/
        if (!is_null($request['slug'])) {
            $request['slug'] = str_replace([' ', '‌'], '-', $request->slug);
        } else {
            $request['slug'] = str_replace([' ', '‌'], '-', $request->title);
//            Str::slug($request['slug']) ;
            /*End Slug Handler*/
        }


        $course->update($request->all());


        if (count($course->schedules) > 0) {
            foreach ($course->schedules as $time) {
                $time->update([
                    'teacher_id' => $request['teacher_id']
                ]);
            }
        }


        try {
            $course->categories()->sync($request['category']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
            return back()->withInput();
        }


        try {
            $course->degrees()->sync($request['degrees']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "دوره ثبت شد اما مشکلی مقطع آن ثبت نشد.");
            return back()->withInput();
        }

        if (!is_null($request->input('questions'))) {
            foreach ($request->input('questions', []) as $questionData) {
                $question = Question::find($questionData['id']);
                if ($question && $question->questionable_id == $course->id) {
                    $question->update([
                        'answer' => $questionData['answer'],
                    ]);
                }
            }
        }


        Alert::success("دوره$course->title با موفقیت ایجاد شد. ");
        return redirect()->back();
    }


    public function schedule(Course $course)
    {
        $this->seo()->setTitle("زمان بندی دوره $course->title");
        return view('admin.courses.schedule.index', compact('course'));

    }


    public function scheduleStore(Request $request, Course $course)
    {

        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'start_course' => 'required',
            'time_course' => 'required|date_format:H:i',
            'days' => 'required|array|min:1|exists:days,id',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        // اعتبارسنجی تعداد روزهای انتخاب شده
        if (count($request->days) != $course->weeks) {
            alert()->error('خطا', 'تعداد روزهای انتخاب شده با توجه به انتخاب شما باید  ' . $course->weeks . ' روز باشد.');
            return back()->withInput();
        }


        if (!is_null($request->start_course)) {
            list($year, $month, $day) = explode('/', $request->start_course);
            $start = Jalalian::fromFormat('Y/m/d', "$year/$month/$day")->toCarbon()->format('Y-m-d');
        } else {
            alert()->error('خطا', 'فیلد تاریخ شروع به درستی وارد نشده است. اصلاح کنید.');
            return back()->withInput();
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $start);


        foreach ($request->days as $day) {
            $DayItem = Day::find($day);
            $days[] = ['id' => $DayItem->id, 'day' => $DayItem['day_english']];
        }


        if (!in_array($startDate->format('l'), array_column($days, 'day'))) {
            alert()->error('خطا', 'تاریخ شروع باید برابر با یکی از روزهای انتخاب شده باشد.');
            return back()->withInput();
        }


        $part = PartTime::create([
            'title' => $request['title'],
            'course_id' => $course->id,
            'status' => 1,
        ]);


        $remainingClasses = $course->class_duration;
        $currentDate = $startDate;
        $items = [];


        // پیدا کردن اولین تاریخ مناسب
        $found = false;
        foreach ($days as $day) {
            if ($currentDate->format('l') == $day['day']) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            foreach ($days as $day) {
                if ($currentDate->format('l') != $day['day']) {
                    $currentDate = Carbon::parse($currentDate)->next($day['day']);
                    break;
                }
            }
        }

        while ($remainingClasses > 0) {
            foreach ($days as $day) {
                if ($remainingClasses <= 0) {
                    break;
                }

                // برای اولین بار از تاریخ فعلی استفاده کنید
                if ($remainingClasses == $course->class_duration) {
                    $scheduleDate = $currentDate;
                } else {
                    $scheduleDate = Carbon::parse($currentDate)->next($day['day']);
                }

                CourseSchedule::create([
                    'course_id' => $course->id,
                    'schedule_id' => $part->id,
                    'teacher_id' => $course->teacher_id,
                    'day_id' => $day['id'],
                    'start_time' => $request['time_course'],
                    'start_date' => $scheduleDate->format('Y-m-d'),
                ]);


                $remainingClasses--;
                $currentDate = $scheduleDate;
            }

            // اضافه کردن روزهای باقیمانده هفته به تاریخ فعلی
            $currentDate = Carbon::parse($currentDate)->addDays(1);
        }


        Alert::success("زمان بندی برای   $course->title با موفقیت ایجاد شد. ");
        return back();

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function time(Request $request, Course $course)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $request['status'] = 1;
        $request['course_id'] = $course->id;

        PartTime::create($request->all());
        Alert::success("زمان بندی جدید برای دوره $course->title با موفقیت ایجاد شد. ");
        return back();
    }


    public function headline(Course $course)
    {
        $this->seo()->setTitle("سرفصل های $course->title");
        return view('admin.courses.headlines.index', compact('course'));
    }


    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:mp4,mov,ogg,qt,hevc,avi,mkv,webm,flv,3gp,3g2|max:409600',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('videos', 'liara');

        if ($filePath) {
            return response()->json(['filePath' => $filePath], 200);
        } else {
            return response()->json(['error' => 'Failed to upload file.'], 500);
        }
    }


    public function headlineStore(Request $request, Course $course)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'link' => 'nullable',
            'description' => 'nullable|string|max:255',
            'video_url' => 'nullable',
            'is_free' => 'nullable',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        $request['slug'] = str_replace([' ', '‌'], '-', $request->title);
        $request['priority'] = $course->headlines()->count() + 1;
        $request['course_id'] = $course->id;

        Headline::create([
            'title' => $request['title'],
            'link' => $request['link'],
            'description' => $request['description'],
            'priority' => $request['priority'],
            'video' => $request['video_url'],
            'course_id' => $course->id,
            'is_free' => $request['is_free'],
            'slug' => $request['slug'],

        ]);


        Alert::success("سر فصل جدید برای دوره $course->title با موفقیت ایجاد شد.");
        return back();


    }


    public function headlineUpdate(Request $request, Headline $headline)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'link' => 'nullable',
            'description' => 'nullable|string|max:255',
            'video' => 'nullable|string|max:255',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


//        if ($headline->course->type == 'offline') {
//            if (is_null($request->video)){
//                alert()->error('خطا', 'هنگامی که دوره به صورت آفلاین است، فایل آموزشی حتماً باید بارگذاری شود.');
//                return back()->withInput();
//            }
//        }


        $headline->update($request->all());

        Alert::success("سر فصل با موفقیت بروز رسانی شد");
        return back();

    }


    public function headlineDelete(Headline $headline)
    {
        $headline->deleteOrFail() ;
        Alert::success("سر فصل با موفقیت حذف شد");
        return back();

    }


}
