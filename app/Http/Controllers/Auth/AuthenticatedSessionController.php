<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Token;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;


class AuthenticatedSessionController extends Controller
{
    use SEOTools;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        $this->seo()->setTitle('ورود / عضویت');
        return view('auth.login');
    }

    public function createTeacher()
    {
        $this->seo()->setTitle('ورود / عضویت معلمین');
        return view('auth.teacherLogin');

    }


    public function store(LoginRequest $request)
    {

        $request->authenticate();
        return redirect(route('verifyPhone'));

//        $request->session()->regenerate();
//        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verifyPhone(): view
    {
        if (session()->get('type') == 'login') {
            $this->seo()->setTitle('تایید ورود');
            return view('auth.verify-phone');
        } else {
            if (session()->get('teacher') == 0) {
                $this->seo()->setTitle('تایید ثبت نام');
                return view('auth.verify-phone');
            } else {
                $this->seo()->setTitle('تایید ثبت نام معلمین');
                return view('auth.teacherVerify-phone');
            }
        }
    }


    public function doVerifyPhone(Request $request)
    {
        $request['code'] = $request['otp1'] . $request['otp2'] . $request['otp3'] . $request['otp4'];
        $valid = Validator::make($request->all(), [
            'code' => ['required', 'numeric', 'digits:4']
        ]);


        if ($valid->fails()) {
            \alert()->error('خطا', $valid->messages()->all()[0]);
            return back();
        }

        if (!session()->has('code_id') || !session()->has('phone')) {
            \alert()->error('خطا', 'مشکلی به وجود آمده است. دوباره اقدام کنید.');
            return redirect()->route('login');
        }

        $token = Token::where('phone', session()->get('phone'))->find(session()->get('code_id'));

        if (!$token || empty($token->id)) {
            return redirect()->route('login');
        }

        if (!$token->isValidUsed()) {
            \alert()->error('خطا', 'کُد یا استفاده شده است.');
            return redirect()->back();
        }

        if (!$token->isValidExpired()) {
            \alert()->error('خطا', 'کُد منقضی شده است.');
            return redirect()->back();
        }


        if ($token->code !== $request->input('code')) {
            \alert()->error('خطا', 'کُد وارد شده اشتباه است.');
            return back();
        }

        $token->update([
            'used' => true
        ]);

        $rememberMe = session()->get('remember');

        if (session()->get('type') == 'login') {
            $user = User::find(session()->get('user_id'));
        } else {
            $user = User::create([
                'phone' => session()->get('phone'),
                'is_teacher' => session()->get('teacher')
            ]);

            $token = new Token();
            $token->sendWelcome($user->phone);

        }

        auth()->login($user, $rememberMe);

        if ($user->is_teacher == 1 ) {
         return redirect(route('teachers.dashboard')) ;
        }

        return redirect()->intended('/');
    }


}
