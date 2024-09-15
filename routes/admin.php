<?php

use Illuminate\Support\Facades\Route;


Route::get('/' ,[\App\Http\Controllers\admin\AdminController::class , 'dashboard'])->name('dashboard') ;


Route::resource('/users' , \App\Http\Controllers\admin\UserController::class);
Route::resource('/categories' , \App\Http\Controllers\admin\CategoriesController::class);


Route::resource('/courses' , \App\Http\Controllers\admin\CourseController::class);

Route::get('/courses/schedules/{course}', [\App\Http\Controllers\admin\CourseController::class , 'schedule'])->name('schedules.index');
Route::post('/courses/schedules/{course}', [\App\Http\Controllers\admin\CourseController::class , 'scheduleStore'])->name('schedules.store');


Route::get('/courses/headlines/{course}', [\App\Http\Controllers\admin\CourseController::class , 'headline'])->name('headline.index');
Route::post('/courses/headlines/{course}', [\App\Http\Controllers\admin\CourseController::class , 'headlineStore'])->name('headline.store');
Route::put('/courses/headlines/{headline}', [\App\Http\Controllers\admin\CourseController::class , 'headlineUpdate'])->name('headline.update');
Route::post('/courses/headline/upload-video', [\App\Http\Controllers\admin\CourseController::class, 'uploadVideo'])->name('headline.uploadVideo');


Route::resource('/blogs' , \App\Http\Controllers\admin\BlogController::class);


Route::resource('/degrees' , \App\Http\Controllers\admin\DegreeController::class);

Route::resource('/comments' , \App\Http\Controllers\admin\commentController::class);








Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});