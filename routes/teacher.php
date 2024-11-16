<?php

use App\Http\Controllers\home\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/',[\App\Http\Controllers\teacher\TeacherController::class, 'index'] )->name('dashboard');


Route::resource('/courses' , \App\Http\Controllers\teacher\CourseController::class);

Route::get('/courses/schedules/{course}', [\App\Http\Controllers\teacher\CourseController::class , 'schedule'])->name('schedules.index');
Route::post('/courses/schedules/{course}', [\App\Http\Controllers\teacher\CourseController::class , 'scheduleStore'])->name('schedules.store');

Route::post('/upload-video/{course}', [\App\Http\Controllers\S3Controller::class, 'uploadVideo'])->name('video.upload');

Route::get('/courses/headlines/{course}', [\App\Http\Controllers\teacher\CourseController::class , 'headline'])->name('headline.index');
Route::post('/courses/headlines/{course}', [\App\Http\Controllers\teacher\CourseController::class , 'headlineStore'])->name('headline.store');
Route::put('/courses/headlines/{headline}', [\App\Http\Controllers\teacher\CourseController::class , 'headlineUpdate'])->name('headline.update');
Route::post('/courses/headline/upload-video', [\App\Http\Controllers\teacher\CourseController::class, 'uploadVideo'])->name('headline.uploadVideo');