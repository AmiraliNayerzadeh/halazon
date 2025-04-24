<?php

namespace App\Http\Controllers;

use App\Models\ArvanVideoPlatform;
use App\Models\Course;
use App\Models\Headline;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\VideoFilters;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use function Clue\StreamFilter\fun;


class S3Controller extends Controller
{

    public function uploadVideo(Request $request, Course $course)
    {
        $file = $request->file('file');
        if ($file) {

            $fileName = time() . '_' . $file->getClientOriginalName();
            $folder = $course->id;
            $originalFilePath = "course/{$folder}/{$fileName}";

            $stored = $file->storeAs("course/{$folder}", $fileName, 'arvan');

            if (!$stored) {
                return response()->json(['error' => 'فایل ذخیره نشد. لطفاً تنظیمات فضای ذخیره‌سازی را بررسی کنید.'], 500);
            }

            $videoUrl = Storage::disk('arvan')->url($originalFilePath);

            return response()->json(['url' => $videoUrl], 200);
        }

        return response()->json(['error' => 'فایل یافت نشد.'], 400);
    }



    public function sendToArvanVideoPlatform()
    {

    }


}
