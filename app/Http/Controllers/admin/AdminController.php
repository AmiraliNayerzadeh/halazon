<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use SEOTools;

    public function dashboard()
    {
        $this->seo()->setTitle('داشبورد');

        return view('admin.dashboard');
    }

    public function UploadEditor(Request $request)
    {


        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/editor', $fileName, 'public');

            return response()->json([
                'uploaded' => true,
                'url' => Storage::url($filePath),
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'فایلی ارسال نشده است.'
            ]
        ]);

    }
    
    
}
