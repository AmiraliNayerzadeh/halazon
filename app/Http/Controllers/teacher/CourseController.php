<?php

namespace App\Http\Controllers\teacher;

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
use Illuminate\Support\Facades\Cache;
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
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->user()->id)->paginate(12);
        $this->seo()->setTitle('دوره ها');
        return view('teacher.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->seo()->setTitle('ایجاد دوره جدید');

        $allCategories = auth()->user()->categories()->where('parent_id' , '!=' , null)->get();
        $categories = null;
        if (!is_null($allCategories)) {
            foreach ($allCategories as $item) {
                if ($item->children) {
                    foreach ($item->children as $child) {
                        $categories[] = $child ;
                    }
                }
            }
        }



        return view('teacher.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:online,offline',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,heic,heif',
            'video' => 'nullable|mimes:mp4,mov,hevc,quicktime,mkv,avi,webm,flv' ,
            'description' => 'nullable',
            'degrees' => 'required_if:is_draft,0|exists:degrees,id|array',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'nullable|integer|min:1|required_unless:type,offline',
            'weeks' => 'nullable|integer|min:1|max:7|required_unless:type,offline',
            'minutes' => 'nullable|integer|min:1|required_unless:type,offline',
            'capacity' => 'nullable|integer|min:1|required_unless:type,offline',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'category' => ['required_if:is_draft,0', 'exists:categories,id'],

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

        if ($request->hasFile('image')) {
            $directory = "/storage/photos/course/";
            $fileName = 'photo_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs("public/photos/course", $fileName);
            $image = $directory . $fileName ;
        }

        if ($request->hasFile('video')) {
            $directory = "/storage/video/course/";
            $fileName = 'video_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('video')->getClientOriginalExtension();
            $path = $request->file('video')->storeAs("public/video/course", $fileName);
            $video = $directory . $fileName ;
        }

        $course = Course::create([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'image' => isset($image) ? $image : null,
            'video' => isset($video) ? $video : null,
            'description' => $request->input('description'),
            'age_from' => $request->input('age_from'),
            'age_to' => $request->input('age_to'),
            'class_duration' => $request->input('class_duration'),
            'weeks' => $request->input('weeks'),
            'minutes' => $request->input('minutes'),
            'capacity' => $request->input('capacity'),
            'price' => $request->input('price'),
            'discount_price' => $request->input('discount_price'),
            'teacher_id' => auth()->user()->id,
            'slug' =>str_replace(' ' , '-' , $request['title']),
            'is_draft' => 1,
        ]);



        try {
            $categoryIds = (array) $request->category; // اطمینان از اینکه یک آرایه است
            $parents = $categoryIds;
            foreach ($categoryIds as $categoryId) {
                $category = Category::find($categoryId);

                // اطمینان از وجود دسته‌بندی
                while ($category && $category->parent_id !== null) {
                    // بررسی ایمن
                    if ($category->parent) {
                        $parents[] = $category->parent->id;
                        $category = $category->parent;
                    } else {
                        break;
                    }
                }
            }

            $course->categories()->sync($parents);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }


        try {
            $course->degrees()->sync($request['degrees']);
        } catch (\Exception $exception) {
            alert()->error('خطا', "دوره ثبت شد اما مشکلی دسته بندی آن ثبت نشد.");
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


        Alert::success(" دوره  $course->title با موفقیت ایجاد شد. ");

        if ($course->type == "offline") {
            return redirect(route('teachers.headline.index', $course));
        }

        if ($course->type == "online") {
            return redirect(route('teachers.schedules.index', $course));
        }

        return redirect(route('teachers.courses.index'));

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

        $allCategories = auth()->user()->categories()->where('parent_id' , '!=' , null)->get();
        $categories = null;
        if (!is_null($allCategories)) {
            foreach ($allCategories as $item) {
                if ($item->children) {
                    foreach ($item->children as $child) {
                        $categories[] = $child ;
                    }
                }
            }
        }

        return view('teacher.courses.edit', compact('course', 'questions' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:online,offline',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,heic,heif',
            'video' => 'nullable|mimes:mp4,mov,hevc,quicktime,mkv,avi,webm,flv' ,
            'description' => 'nullable',
            'degrees' => 'required_if:is_draft,0|exists:degrees,id|array',
            'age_from' => 'required_if:is_draft,0|integer|min:0',
            'age_to' => 'required_if:is_draft,0|integer|gte:age_from',
            'class_duration' => 'nullable|integer|min:1|required_unless:type,offline',
            'weeks' => 'nullable|integer|min:1|max:7|required_unless:type,offline',
            'minutes' => 'nullable|integer|min:1|required_unless:type,offline',
            'capacity' => 'nullable|integer|min:1|required_unless:type,offline',
            'price' => 'required_if:is_draft,0|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price|min:0',
            'homework' => 'nullable|string',
            'is_draft' => 'required|boolean',
            'category' => ['required_if:is_draft,0', 'exists:categories,id'],
            /*Questions*/
            'questions' => 'nullable|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.answer' => 'required|string',
        ]);


        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        if ($request->hasFile('image')) {
            $directory = "/storage/photos/course/";
            $fileName = 'photo_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs("public/photos/course", $fileName);
            $image = $directory . $fileName ;
        }

        if ($request->hasFile('video')) {
            $directory = "/storage/video/course/";
            $fileName = 'video_' . now()->format('Y-m-d_H-i-s') . '.' . $request->file('video')->getClientOriginalExtension();
            $path = $request->file('video')->storeAs("public/video/course", $fileName);
            $video = $directory . $fileName ;
        }


        $course->update([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'image' => isset($image) ? $image : $course->image ,
            'video' => isset($video) ? $video : $course->video ,
            'description' => $request->input('description'),
            'age_from' => $request->input('age_from'),
            'age_to' => $request->input('age_to'),
            'class_duration' => $request->input('class_duration'),
            'weeks' => $request->input('weeks'),
            'minutes' => $request->input('minutes'),
            'capacity' => $request->input('capacity'),
            'price' => $request->input('price'),
            'discount_price' => $request->input('discount_price'),
            'teacher_id' => auth()->user()->id,

        ]);



        if (count($course->schedules) > 0) {
            foreach ($course->schedules as $time) {
                $time->update([
                    'teacher_id' => auth()->user()->id
                ]);
            }
        }


        try {
            $categoryIds = (array) $request->category;
            $parents = $categoryIds;
            foreach ($categoryIds as $categoryId) {
                $category = Category::find($categoryId);

                while ($category && $category->parent_id !== null) {
                    if ($category->parent) {
                        $parents[] = $category->parent->id;
                        $category = $category->parent;
                    } else {
                        break;
                    }
                }
            }

            $course->categories()->sync($parents);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
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

        Alert::success(" دوره  $course->title با موفقیت بروزرسانی شد. ");
        return back();
    }


    public function schedule(Course $course)
    {
        $this->seo()->setTitle("زمان بندی دوره $course->title");

        if ($course->type == "offline") {
            Alert::info("دوره آفلاین نیازی به زمان بندی ندارد");

            return redirect(route('teachers.headline.index', $course));
        }

        return view('teacher.courses.schedule.index', compact('course'));

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


        Alert::success(" زمان بندی برای$course->title با موفقیت ایجاد شد. ");
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
        return view('teacher.courses.headlines.index', compact('course'));
    }


    public function uploadVideo(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:mp4,mov,ogg,qt|max:51200', // 50MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('videos', 'liara'); // مسیر و دیسک ذخیره

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
            'video_url' => 'nullable', // 50MB
            'is_free' => 'nullable',
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        if ($course->type == "offline" && $request['video_url'] == null) {
            alert()->error('خطا', "ویدیو شما بارگزاری نشد. از اتصال اینترنت خود اطمینان پیدا کنید.");
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


}
