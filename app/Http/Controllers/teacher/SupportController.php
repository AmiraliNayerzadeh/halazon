<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SupportController extends Controller
{
    use SEOTools;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->seo()->setTitle('لیست درخواست های پشتیبانی');

        $supports = Support::latest()->where('parent_id', null)->where('user_id', auth()->user()->id)->paginate(24);

        return view('teacher.supports.index', compact('supports'));

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

        if ($support->user_id == auth()->user()->id) {

            $this->seo()->setTitle(" مشاهده تیکت $support->id#");
            return view('teacher.supports.show', compact('support'));

        } else {
            abort(403);
        }
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
        if ($support->user_id == auth()->user()->id) {


            $support->update([
                'status' => 'open'
            ]);

            Support::create([
                'parent_id' => $request['parent_id'],
                'message' => $request['message'],
                'user_id' => auth()->user()->id,
                'supportable_id' => $support->supportable_id,
                'supportable_type' => $support->supportable_type,
            ]);


            Alert::success("پاسخ با موفقیت ثبت شد.");
            return back();
        } else {
            abort(403);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
