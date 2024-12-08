<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Kavenegar ;


class SupportController extends Controller
{
    use SEOTools ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->seo()->setTitle('لیست درخواست های پشتیبانی') ;

        $supports = Support::latest()->where('parent_id' , null)->paginate(24) ;

        return view('admin.supports.index' , compact('supports')) ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Support $support)
    {
        $this->seo()->setTitle(" مشاهده تیکت $support->id#") ;

        return view('admin.supports.show' , compact('support'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Support $support)
    {

        $support->update([
            'status' => 'open'
        ]) ;


        $newSupport= Support::create([
            'parent_id' => $request['parent_id'] ,
            'message' => $request['message'] ,
            'user_id' => auth()->user()->id  ,
            'supportable_id' => $support->supportable_id  ,
            'supportable_type' => $support->supportable_type  ,
        ]);


        if (!is_null($request['sms']) && $request['sms'] == "on") {
            try{
                $receptor = $support->user->phone;
                $token2 = null;
                $token3 = null;
                $token20 = $support->user->name;
                $token = "عزیز";
                $template= "submitSupport";
                $type = 'sms';

                $result = Kavenegar::VerifyLookup($receptor, $token, $token2, $token3,$token20 ,  $template, $type);
            }
            catch(\Kavenegar\Exceptions\ApiException $e){
                var_dump($e->getMessage());
            }
            catch(\Kavenegar\Exceptions\HttpException $e){
                var_dump($e->getMessage());
            }
        }


        Alert::success("پاسخ با موفقیت ثبت شد.");
        return back() ;
    }


    public function supportUpdate(Support $support , Request $request)
    {

        $valid = Validator::make($request->all() , [
            'status' => ['required'] ,
        ]) ;

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $support->update([
            'status' => $request['status']
        ]) ;

        Alert::success("وضعیت تیکت با موفقیت بروز رسانی شد.");
        return back() ;
        
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
