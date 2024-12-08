<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherController extends Controller
{
    use SEOTools;

    public function index()
    {
        $this->seo()->setTitle('معلمین حلزون');
        SEOMeta::setCanonical(route('teacher.index'));

        $teachers = User::where('is_teacher', 1)->where('is_verify' , 1)->where('slug', '!=', null)->paginate(18);
        return view('home.teacher.index', compact('teachers'));
    }

    public function show(User $user)
    {

        if ($user->is_teacher == 1 && $user->is_verify == 1) {
            $this->seo()->setTitle($user->name . ' ' . $user->family. " | مدرس زمینه " . $user->categories[0]->title. " در حلزون ");
            SEOMeta::setCanonical(route('teacher.show', $user));
            return view('home.teacher.show', compact('user'));
        } else {
            abort(404) ;
        }
    }

    public function fallow(User $user)
    {
        if (Auth::user()) {
            $teacher = User::findOrFail($user->id);
            if ($teacher->isTeacher() && !Auth::user()->following->contains($user->id)) {
                Auth::user()->following()->attach($user->id);
            }

            Alert::success("شما معلم $user->name $user->family را دنبال کردید. ");
            return back();
        } else {
            Alert::info("برای دنبال کردن معلمین ابتدا باید وارد حساب کاربری شوید.");
            return redirect(route('login'));

        }
    }


    public function unfollow(User $user)
    {
        $teacher = User::findOrFail($user->id);

        if (Auth::user()->following->contains($user->id)) {
            Auth::user()->following()->detach($user->id);
        }

        Alert::success("شما معلم $user->name $user->family را دیگر دنبال نمی کنید. ");
        return back();

    }


    public function landing()
    {
        $this->seo()->setTitle("همکاری با حلزون | به جمع مدرسین ما بپیوندید و آموزش دهید");
        $this->seo()->setDescription("در پلتفرم آموزشی حلزون، به‌عنوان مدرس یا معلم به دانش‌آموزان سراسر کشور آموزش دهید. برای شروع همکاری و کسب درآمد از تخصص خود، همین حالا ثبت‌نام کنید و جزئیات بیشتر را درباره نحوه تدریس آنلاین در حلزون بیابید.");

        return view('home.teacher.landing');

    }


}
