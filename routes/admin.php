<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/' ,[\App\Http\Controllers\admin\AdminController::class , 'dashboard'])->name('dashboard') ;


Route::resource('/users' , \App\Http\Controllers\admin\UserController::class);
Route::resource('/categories' , \App\Http\Controllers\admin\CategoriesController::class);


Route::resource('/courses' , \App\Http\Controllers\admin\CourseController::class);

Route::post('/courses/time/{course}', [\App\Http\Controllers\admin\CourseController::class , 'time'])->name('time.store');
Route::get('/courses/schedules/{course}', [\App\Http\Controllers\admin\CourseController::class , 'schedule'])->name('schedules.index');











Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});