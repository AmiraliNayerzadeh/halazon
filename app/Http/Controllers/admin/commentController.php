<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class commentController extends Controller
{
    use SEOTools;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(24);
        $this->seo()->setTitle('تمام نظرات');
        return view('admin.comments.index', compact('comments'));
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
        $valid = Validator::make($request->all(), [
            'commentable_id' => ['required'],
            'commentable_type' => ['required'],
            'parent' => ['required'],
            'user_id' => ['required', 'exists:users,id'],
            'comment' => ['required', 'string'],
        ]);


        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $comment = Comment::create([
            'commentable_id' => $request['commentable_id'],
            'commentable_type' => $request['commentable_type'],
            'parent' => $request['parent'],
            'user_id' => $request['user_id'],
            'comment' => $request['comment'],
            'status' => 1,
        ]);

        Alert::success("دیدگاه با موفقیت ایجاد شد.");
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->seo()->setTitle("ویرایش دیدگاه $comment->comment");
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {


        $valid = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'comment' => ['required', 'string'],
            'publish' => ['required', 'boolean'],
        ]);

        if ($valid->fails()) {
            alert()->error('خطا', $valid->messages()->all()[0]);
            return back()->withInput();
        }

        $comment->update([
            'user_id' => $request['user_id'],
            'comment' => $request['comment'],
            'status' => $request['publish'],
        ]);


        Alert::success("دیدگاه با موفقیت بروزرسانی شد.");
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
