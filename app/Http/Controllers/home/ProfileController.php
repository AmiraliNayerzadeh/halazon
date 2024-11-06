<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    use SEOTools ;
    public function index()
    {
        $this->seo()->setTitle('پروفایل کاربری') ;
        $user = \auth()->user();
        return \view('home.profile.index' , compact('user'));
    }


    public function comment()
    {
        $this->seo()->setTitle('دیدگاه و پرسش ها') ;
        $user = \auth()->user();
        $comments = $user->comments ;

        return view('home.profile.comment' , compact('comments'));
    }

    public function favorite()
    {
        $this->seo()->setTitle('علاقه مندی ها') ;
        $user = \auth()->user();
        $favorites = $user->favorites ;
        return view('home.profile.favorite' , compact('favorites'));
    }


    public function setting()
    {
        $this->seo()->setTitle('اطلاعات کاربری') ;
        $user = \auth()->user();
        return view('home.profile.setting' , compact('user'));
    }

    public function update(Request $request , User $user)
    {
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'birthday' => ['nullable'],
            'nationalCode' => ['nullable', 'numeric', 'unique:users,nationalCode,'.$user->id,],
            'address' => ['nullable'],
            'postalCode' => ['nullable', 'numeric'],
            'categories' => ['nullable' , 'exists:categories,id' , 'array'],
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

        $fullName = $request['name'].' '.$request['family'];
        $slug=$request['slug'] = str_replace([' ','‌'] , '-' ,$fullName);



        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'gender' => $request->gender,
            'birthday' => $birthday,
            'nationalCode' => $request->nationalCode,
            'address' => $request->address,
            'postalCode' => $request->postalCode,
            'slug' => $slug,
        ]);

        $user->categories()->sync($request->categories);

        Alert::success("اطلاعات شما با موفقیت بروزرسانی گردید.");
        return back();

    }


    public function payment()
    {
        $this->seo()->setTitle('لیست تراکنش های من') ;

        $orders = Order::where('user_id' , \auth()->user()->id)->latest()->get();

        return view('home.profile.payments' , compact('orders'));


    }


}
