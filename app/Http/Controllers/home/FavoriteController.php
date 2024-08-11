<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'id' => ['required','integer'] ,
            'type' => ['required','string'] ,

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }


        $user = Auth::user() ;
        $exists = $user->favorites()->where('favoriteable_type', $request->type)->where('favoriteable_id', $request->id)->exists();


        if (!$exists) {
            $user->favorites()->create([
                'favoriteable_type' => $request->type,
                'favoriteable_id' => $request->id,
            ]);
        } else {
            Alert::info("شما قبلا این مورد را به علاقه مندی های خود اضافه کرده اید.");
            return redirect()->back();
        }

        Alert::success("با موفقیت به علاقه مندی ها اضافه شد.");
        return redirect()->back();

    }

    public function delete(Request $request)
    {
        $valid = Validator::make($request->all() , [
            'id' => ['required','integer'] ,
            'type' => ['required','string'] ,

        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }
        $user = Auth::user();

        $user->favorites()
            ->where('favoriteable_type', $request->type)
            ->where('favoriteable_id', $request->id)
            ->delete();

        Alert::success("با موفقیت از لیست علاقه مندی ها حدف شد.");
        return redirect()->back();
    }


}
