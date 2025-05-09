    <?php

use App\Http\Controllers\home\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\home\HomeController::class, 'home'])->name('home');

Route::get('/about', [\App\Http\Controllers\home\HomeController::class, 'about'])->name('about');

Route::get('/terms', [\App\Http\Controllers\home\HomeController::class, 'terms'])->name('terms');

Route::get('/contact-us', [\App\Http\Controllers\home\HomeController::class, 'contact'])->name('contact.index');
Route::post('/contact-us', [\App\Http\Controllers\home\HomeController::class, 'contactStore'])->name('contact.store');

Route::get('/category/{category:slug}', [\App\Http\Controllers\home\CategoryController::class, 'main'])->name('category');


Route::get('/course', [\App\Http\Controllers\home\CourseController::class, 'index'])->name('course.index');
Route::get('/course/{course:slug}', [\App\Http\Controllers\home\CourseController::class, 'show'])->name('course.show');

Route::get('/course/{course:slug}/{headline:slug}', [\App\Http\Controllers\home\CourseController::class, 'headline'])->name('headline.show');

//Route::get('/course/{course:slug}/headline/{course:slug}', [\App\Http\Controllers\home\DegreeController::class , 'index'])->name('degrees.index');


/*Add teacher Route*/
Route::get('/teacher/', [\App\Http\Controllers\home\TeacherController::class, 'index'])->name('teacher.index');
Route::get('teacher/{user:slug}', [\App\Http\Controllers\home\TeacherController::class, 'show'])->name('teacher.show');
Route::post('teacher/{user:slug}/fallow', [\App\Http\Controllers\home\TeacherController::class, 'fallow'])->name('teacher.fallow');
Route::post('teacher/{user:slug}/unfollow', [\App\Http\Controllers\home\TeacherController::class, 'unfollow'])->name('teacher.unfollow');

Route::get('work-as-teacher', [\App\Http\Controllers\home\TeacherController::class, 'landing'])->name('teacher.landing');

Route::get('/blog/', [\App\Http\Controllers\home\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{category:slug}/{blog:slug}/', [\App\Http\Controllers\home\BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{category:slug}', [\App\Http\Controllers\home\BlogController::class, 'category'])->name('blog.category');


Route::post('/favorites/store', [\App\Http\Controllers\home\FavoriteController::class, 'store'])->name('favorites.store')->middleware('auth');
Route::delete('/favorites/delete', [\App\Http\Controllers\home\FavoriteController::class, 'delete'])->name('favorites.delete')->middleware('auth');

Route::post('/comment/store', [\App\Http\Controllers\home\CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::get('/degrees/', [\App\Http\Controllers\home\DegreeController::class, 'index'])->name('degrees.index');
Route::get('/degrees/{degree:slug}', [\App\Http\Controllers\home\DegreeController::class, 'show'])->name('degrees.show');


Route::post('/lead' , [\App\Http\Controllers\home\HomeController::class, 'leadStore'])->name('lead.store');

Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/comments', [ProfileController::class, 'comment'])->name('profile.comment');
    Route::get('/favorites', [ProfileController::class, 'favorite'])->name('profile.favorite');
    Route::get('/setting', [ProfileController::class, 'setting'])->name('profile.setting');
    Route::put('/setting/{user}/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/payment', [ProfileController::class, 'payment'])->name('profile.payment');


});


Route::post('/profile/submit/support', [\App\Http\Controllers\home\SupportController::class, 'submitSupport'])->name('submit.support')->middleware('auth');



Route::middleware('auth')->prefix('cart')->group(function () {
    Route::get('/', [\App\Http\Controllers\home\CartController::class, 'index'])->name('cart.index');
    Route::post('/', [\App\Http\Controllers\home\CartController::class, 'store'])->name('cart.store');
    Route::put('/{id}', [\App\Http\Controllers\home\CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [\App\Http\Controllers\home\CartController::class, 'destroy'])->name('cart.destroy');

});

Route::middleware('auth')->prefix('order')->group(function () {
    Route::post('/store/{cart}', [\App\Http\Controllers\home\OrderController::class, 'store'])->name('order.store');
    Route::get('/status/{order}', [\App\Http\Controllers\home\OrderController::class, 'status'])->name('order.status');
});


Route::prefix('sitemaps')->group(function () {
    Route::get('/static.xml', [\App\Http\Controllers\SitemapController::class, 'static'])->name('sitemap.static');
    Route::get('/blogs.xml', [\App\Http\Controllers\SitemapController::class, 'blogs'])->name('sitemap.blogs');
    Route::get('/blogs-category.xml', [\App\Http\Controllers\SitemapController::class, 'blogCategory'])->name('sitemap.blogs.category');
});




Route::post('/editor/upload/image', [\App\Http\Controllers\admin\AdminController::class, 'UploadEditor'])->name('upload.image');


require __DIR__ . '/auth.php';
