<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/' ,[\App\Http\Controllers\home\HomeController::class , 'home'])->name('home') ;

Route::get('/terms', [\App\Http\Controllers\home\HomeController::class , 'terms'])->name('terms');

Route::get('/category/{category:slug}', [\App\Http\Controllers\home\CategoryController::class , 'main'])->name('category');


Route::get('/course/{course:slug}', [\App\Http\Controllers\home\CourseController::class , 'show'])->name('course.show');

/*Add teacher Route*/
Route::get('/teacher/', [\App\Http\Controllers\home\TeacherController::class , 'index'])->name('teacher.index');
Route::get('teacher/{user:slug}', [\App\Http\Controllers\home\TeacherController::class , 'show'])->name('teacher.show');
Route::post('teacher/{user:slug}/fallow', [\App\Http\Controllers\home\TeacherController::class , 'fallow'])->name('teacher.fallow');
Route::post('teacher/{user:slug}/unfollow', [\App\Http\Controllers\home\TeacherController::class, 'unfollow'])->name('teacher.unfollow');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
