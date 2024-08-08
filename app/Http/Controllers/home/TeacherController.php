<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $teachers = User::where('is_teacher', 1)->paginate(18);
        return view('home.teacher.index', compact('teachers'));
    }

    public function show(User $user)
    {
        $this->seo()->setTitle($user->name . ' ' . $user->family);
        return view('home.teacher.show', compact('user'));
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
        return back();    }


}
