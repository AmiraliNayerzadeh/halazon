<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SupportController extends Controller
{
    public function submitSupport(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required',
            'message'=> 'required' ,
            'id' => 'required' ,
            'type' => 'required'

        ]);

        if ($valid->fails()) {
            alert()->error('Error', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        $existingRequest = Support::where('user_id', auth()->user()->id)
            ->where('title', $request->input('title'))
            ->first();

        if ($existingRequest) {
            alert()->error('خطا', 'شما قبلاً درخواستی با همین عنوان ثبت کرده‌اید. لطفاً منتظر تایید باشید.');
            return back()->withInput();
        }


        Support::create([
            'user_id' => \auth()->user()->id,
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            'supportable_id' => $request->input('id'),
            'supportable_type' => $request->input('type'),
        ]);


        Alert::success("درخواست شما با موفقیت ایجاد گردید.");
        return redirect()->back();
    }
}
