<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class S3Controller extends Controller
{
    public function uploadVideo(Request $request , Course $course)
    {
        $request->validate([
            'file' => 'required|mimes:mp4,mov,avi,m4v|max:819200'
        ]);

        $file = $request->file('file');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $folder = $course->title;

        // آپلود فایل به فولدر اختصاصی
        $path = Storage::disk('liara')->putFileAs($folder, $file, $fileName);

        if ($path) {
            $url = Storage::disk('liara')->url($path);
            return response()->json(['url' => $url], 200);
        }

        return response()->json(['error' => 'File upload failed'], 500);
    }

}
