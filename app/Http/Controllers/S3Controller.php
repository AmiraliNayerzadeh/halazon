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

        $request->validate([
            'file' => 'required|mimes:mp4,mov,avi,m4v|max:819200',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $folder = str_replace(' ', '-', $course->id);

        $originalFilePath = $file->storeAs("/course/" . $folder, $fileName, 'local');
        $revealFilePath = public_path('assets/reveal-first-course.mp4');

        try {
            $ffmpegPath = env('FFMPEG_PATH');

            $inputFilePath = storage_path("app/{$originalFilePath}");
            $watermarkPath = public_path('assets/watermark.png');
            $resizedFilePath = storage_path("app/course/{$folder}/resized_{$fileName}");
            $outputFilePath = storage_path("app/course/{$folder}/final_{$fileName}");

            // تغییر ابعاد ویدیو و افزودن واترمارک
            $resizeAndWatermarkCommand = "{$ffmpegPath} -i {$inputFilePath} -i {$watermarkPath} -filter_complex \"[0:v]scale=w=1280:h=720:force_original_aspect_ratio=decrease,pad=1280:720:(ow-iw)/2:(oh-ih)/2[v];[v][1:v]overlay=W-w-3:H-h-3\" -c:v libx264 -crf 23 -preset veryfast -c:a copy {$resizedFilePath}";
            exec($resizeAndWatermarkCommand . " 2>&1", $resizeOutput, $resizeResultCode);

            if ($resizeResultCode !== 0) {
                Log::error("Resize and Watermark Command: " . $resizeAndWatermarkCommand);
                return response()->json(['error' => 'Resize and watermarking failed.'], 500);
            }

            // ایجاد فایل لیست برای ادغام ویدیوها
            $concatListPath = storage_path("app/course/{$folder}/concat_list.txt");
            file_put_contents($concatListPath, "file '{$revealFilePath}'\nfile '{$resizedFilePath}'");

            // ترکیب ویدیو معرفی و ویدیو آپلود شده
            $concatCommand = "{$ffmpegPath} -f concat -safe 0 -i {$concatListPath} -c copy {$outputFilePath}";
            exec($concatCommand . " 2>&1", $concatOutput, $concatResultCode);

            if ($concatResultCode !== 0) {
                Log::error("Concat Command: " . $concatCommand);
                return response()->json(['error' => 'Video concatenation failed.'], 500);
            }

            // آپلود فایل نهایی روی دیسک لیارا
            $path = Storage::disk('liara')->putFileAs($folder, new \Illuminate\Http\File($outputFilePath), "final_{$fileName}");

            if ($path) {
                $url = Storage::disk('liara')->url($path);

                // پاک کردن فایل‌های موقت
                unlink($inputFilePath);
                unlink($resizedFilePath);
                unlink($concatListPath);
                unlink($outputFilePath);

                return response()->json(['url' => $url], 200);
            }
        } catch (\Exception $e) {
            Log::error("Exception: " . $e->getMessage());
            return response()->json(['error' => 'Processing failed: ' . $e->getMessage()], 500);
        }

        return response()->json(['error' => 'File upload failed'], 500);
    }


    public function uploadVideoWithReveal(Request $request, Course $course)
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
            $outputFileName = 'final_video_' . $fileName;
            $outputFilePath = storage_path("app/course/{$folder}/{$outputFileName}");

            // مسیر واترمارک
            $watermarkPath = public_path('assets/watermark.png');
            $revealFilePath = public_path('assets/reveal-first-course.mp4');

            // مسیر ویدیوهای ترکیبی
            $intermediateFilePath = storage_path("app/course/{$folder}/watermarked_{$fileName}");
            $concatListPath = storage_path("app/course/{$folder}/concat_list.txt");

            // تنظیم ابعاد و اعمال واترمارک بر ویدیوی آپلود شده
            $watermarkCommand = "{$ffmpegPath} -i {$inputFilePath} -i {$watermarkPath} -filter_complex \"[0:v]scale=w=1280:h=720:force_original_aspect_ratio=decrease,pad=1280:720:(ow-iw)/2:(oh-ih)/2[v];[v][1:v]overlay=W-w-3:H-h-3\" -c:v libx264 -crf 23 -preset veryfast -c:a aac -b:a 128k -movflags +faststart {$intermediateFilePath}";

            exec($watermarkCommand . " 2>&1", $watermarkOutput, $watermarkResultCode);
            if ($watermarkResultCode !== 0) {
                Log::error("Watermark Command: " . $watermarkCommand);
                Log::error("Command Output: " . implode("\n", $watermarkOutput));
                return response()->json([
                    'error' => 'Watermark processing failed. Output: ' . implode("\n", $watermarkOutput),
                ], 500);
            }

            // ایجاد فایل لیست ویدیوها برای ادغام
            file_put_contents($concatListPath, "file '{$revealFilePath}'\nfile '{$intermediateFilePath}'");

            // ادغام ویدیوها با استفاده از concat
            $concatCommand = "{$ffmpegPath} -f concat -safe 0 -i {$concatListPath} -c copy {$outputFilePath}";
            exec($concatCommand . " 2>&1", $concatOutput, $concatResultCode);

            if ($concatResultCode !== 0) {
                Log::error("Concat Command: " . $concatCommand);
                Log::error("Command Output: " . implode("\n", $concatOutput));
                return response()->json([
                    'error' => 'Video concatenation failed. Output: ' . implode("\n", $concatOutput),
                ], 500);
            }

            // آپلود فایل خروجی در دیسک لیارا
            $path = Storage::disk('liara')->putFileAs($folder, new \Illuminate\Http\File($outputFilePath), $outputFileName);

            if ($path) {
                $url = Storage::disk('liara')->url($path);

                // پاک کردن فایل‌های لوکال
                unlink($inputFilePath);
                unlink($intermediateFilePath);
                unlink($outputFilePath);
                unlink($concatListPath);

                return response()->json(['url' => $url], 200);
            }
        } catch (\Exception $e) {
            Log::error("Exception: " . $e->getMessage());
            return response()->json(['error' => 'Processing failed: ' . $e->getMessage()], 500);
        }
        return response()->json(['error' => 'File upload failed'], 500);
    }



    public function uploadVideo2(Request $request, Course $course)
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

            // ثبت لاگ‌های خطا احتمالی
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
