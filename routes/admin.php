<?php

use Illuminate\Support\Facades\Route;


Route::get('/' ,[\App\Http\Controllers\admin\AdminController::class , 'dashboard'])->name('dashboard') ;


Route::resource('/users' , \App\Http\Controllers\admin\UserController::class);
Route::resource('/categories' , \App\Http\Controllers\admin\CategoriesController::class);


Route::resource('/courses' , \App\Http\Controllers\admin\CourseController::class);

Route::get('/courses/schedules/{course}', [\App\Http\Controllers\admin\CourseController::class , 'schedule'])->name('schedules.index');
Route::post('/courses/schedules/{course}', [\App\Http\Controllers\admin\CourseController::class , 'scheduleStore'])->name('schedules.store');

Route::post('/upload-video/{course}', [\App\Http\Controllers\S3Controller::class, 'uploadVideo'])->name('video.upload');

Route::get('/courses/headlines/{course}', [\App\Http\Controllers\admin\CourseController::class , 'headline'])->name('headline.index');
Route::post('/courses/headlines/{course}', [\App\Http\Controllers\admin\CourseController::class , 'headlineStore'])->name('headline.store');
Route::put('/courses/headlines/{headline}', [\App\Http\Controllers\admin\CourseController::class , 'headlineUpdate'])->name('headline.update');
Route::delete('/courses/headlines/{headline}', [\App\Http\Controllers\admin\CourseController::class , 'headlineDelete'])->name('headline.delete');
Route::post('/courses/headline/upload-video', [\App\Http\Controllers\admin\CourseController::class, 'uploadVideo'])->name('headline.uploadVideo');


Route::resource('/blogs' , \App\Http\Controllers\admin\BlogController::class);

Route::resource('/degrees' , \App\Http\Controllers\admin\DegreeController::class);

Route::resource('/supports' , \App\Http\Controllers\admin\SupportController::class);
Route::put('/supports/status/{support}', [\App\Http\Controllers\admin\SupportController::class , 'supportUpdate'])->name('supports.status.update');

Route::resource('/comments' , \App\Http\Controllers\admin\commentController::class);


Route::resource('/contacts' , \App\Http\Controllers\admin\ContactController::class)->except(['create' , 'store' , 'edit' , 'show']);


Route::resource('/orders' , \App\Http\Controllers\admin\OrderController::class) ;



Route::get('/headline-arvan', [\App\Http\Controllers\S3Controller::class , 'sendToArvanVideoPlatform']);



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});