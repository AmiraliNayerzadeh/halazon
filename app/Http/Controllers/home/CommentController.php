<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'id' => ['required','integer'] ,
            'type' => ['required','string'] ,
            'comment' => ['required','string'] ,
            'score' => ['nullable','int' , 'between:1,5'] ,

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $user = Auth::user() ;

        $user->comments()->create([
            'commentable_id' => $request->id,
            'commentable_type' => $request->type,
            'comment' => $request->comment,
            'score' => $request->score,
        ]);


        Alert::success("نظر شما با موفقیت ثبت شد و بعد از تایید نمایش داده خواهد شد.");
        return redirect()->back();

    }
}
