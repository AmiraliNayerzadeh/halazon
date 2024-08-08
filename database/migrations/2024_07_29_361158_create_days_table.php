<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('day_farsi');
            $table->string('day_english');
        });


        DB::table('days')->insert([
            ["id" => 1, "day_farsi" => "شنبه", "day_english" => "Saturday"],
            ["id" => 2, "day_farsi" => "یک‌شنبه", "day_english" => "Sunday"],
            ["id" => 3, "day_farsi" => "دوشنبه", "day_english" => "Monday"],
            ["id" => 4, "day_farsi" => "سه‌شنبه", "day_english" => "Tuesday"],
            ["id" => 5, "day_farsi" => "چهارشنبه", "day_english" => "Wednesday"],
            ["id" => 6, "day_farsi" => "پنج‌شنبه", "day_english" => "Thursday"],
            ["id" => 7, "day_farsi" => "جمعه", "day_english" => "Friday"],
        ]);


    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};
