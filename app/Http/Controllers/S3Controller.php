<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Filters\Video\VideoFilters;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Str;


class S3Controller extends Controller
{

    public function uploadVideo(Request $request, Course $course)
    {
        set_time_limit(999);


        // اعتبارسنجی فایل ورودی
        $request->validate([
            'file' => 'required|mimes:mp4,mov,avi,m4v|max:819200',
        ]);



        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $folder = str_replace(' ', '-', $course->id);

        // مسیر ذخیره اولیه فایل آپلود شده
        $originalFilePath = $file->storeAs("/course/" . $folder, $fileName, 'local');



        try {
            // مسیرهای FFMpeg و Ffprobe از env
            $ffmpegPath = env('FFMPEG_PATH');
            $ffprobePath = env('FFPROBE_PATH');


            // مسیر ویدیوی ورودی و خروجی
            $inputFilePath = storage_path("app/{$originalFilePath}");
            $outputFileName = 'watermarked_' . $fileName;
            $outputFilePath = storage_path("app/course/{$folder}/{$outputFileName}");

            // مسیر واترمارک
            $watermarkPath = public_path('assets/watermark.png');



            // تنظیم ابعاد و اعمال واترمارک با دستور FFMpeg
            $command = "{$ffmpegPath} -i {$inputFilePath} -i {$watermarkPath} -filter_complex \"[0:v]scale=w=1280:h=720:force_original_aspect_ratio=decrease,pad=1280:720:(ow-iw)/2:(oh-ih)/2[v];[v][1:v]overlay=W-w-3:H-h-3\" -c:v libx264 -crf 23 -preset veryfast -c:a aac -b:a 128k -movflags +faststart {$outputFilePath}";




            // اجرای دستور FFMpeg
            exec($command . " 2>&1", $output, $resultCode);



            // ثبت لاگ‌های خطای احتمالی
            Log::error("FFMpeg Command: " . $command);
            Log::error("Command Output: " . implode("\n", $output));
            Log::error("Command Result Code: " . $resultCode);

            // بررسی کد نتیجه اجرای دستور
            if ($resultCode !== 0) {
                return response()->json([
                    'error' => 'Processing failed. Output: ' . implode("\n", $output),
                ], 500);
            }


            // آپلود فایل خروجی در دیسک لیارا
            $path = Storage::disk('liara')->putFileAs($folder, new \Illuminate\Http\File($outputFilePath), $outputFileName);

            if ($path) {
                $url = Storage::disk('liara')->url($path);

                // پاک کردن فایل‌های لوکال
                unlink($inputFilePath);
                unlink($outputFilePath);

                return response()->json(['url' => $url], 200);
            }
        } catch (\Exception $e) {
            Log::error("Exception: " . $e->getMessage());
            return response()->json(['error' => 'Processing failed: ' . $e->getMessage()], 500);
        }

        return response()->json(['error' => 'File upload failed'], 500);
    }



    public function uploadVideo_old(Request $request, Course $course)
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
