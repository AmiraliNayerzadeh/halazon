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


Route::resource('/supports' , \App\Http\Controllers\teacher\SupportController::class);



Route::get('/profile', [\App\Http\Controllers\teacher\TeacherController::class, 'profile'])->name('profile.edit');


Route::get('/complete/register', [\App\Http\Controllers\teacher\TeacherController::class, 'completeInformation'])->name('register.complete');

Route::get('/categories/main', [\App\Http\Controllers\teacher\TeacherController::class, 'getMainCategories'])->name('categories.main');
Route::post('/categories/sub', [\App\Http\Controllers\teacher\TeacherController::class, 'getSubCategories'])->name('categories.sub');


Route::put('/complete/information', [\App\Http\Controllers\teacher\TeacherController::class, 'information'])->name('information');
Route::put('/complete/category', [\App\Http\Controllers\teacher\TeacherController::class, 'informationCategory'])->name('information.category');

Route::get('/financial' , [\App\Http\Controllers\teacher\FinancialController::class , 'index'])->name('financial.index') ;


Route::post('/complete/upload-files', [\App\Http\Controllers\teacher\TeacherController::class, 'upload'])->name('files.upload.complete');
