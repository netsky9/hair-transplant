<?php
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/form', [ContactController::class, 'submit'])->name('contact-form');

Route::prefix('blog')->group(function () {
    Route::get('/posts', [\App\Http\Controllers\Blog\PostController::class, 'index'])->name('blog.posts');
    Route::get('/posts/{slug}', [\App\Http\Controllers\Blog\PostController::class, 'show'])->name('blog.posts.show');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


/**
 * Admin panel
 */
Route::middleware(['auth', 'isadmin'])->prefix('admin/blog')->namespace('\App\Http\Controllers\Blog\Admin')->group(function () {
    /**
     * Categories routes
     */
    Route::resource('categories', CategoryController::class, [
        'only'=>['index', 'edit', 'store', 'update', 'create'],
        'names'=>'blog.admin.categories'
    ]);

    /**
     * Posts routes
     */
    Route::resource('posts', PostController::class, [
        'names'=>'blog.admin.posts'
    ]);
});
/**
 * Restore deleted post
 */
Route::get('admin/blog/posts/restore/{post}', [\App\Http\Controllers\Blog\Admin\PostController::class, 'restore'])
    ->name('blog.admin.posts.restore')
    ->middleware(['auth', 'isadmin']);


Route::middleware(['auth', 'isadmin'])->prefix('admin/clinics')->namespace('\App\Http\Controllers\Clinics\Admin')->group(function () {
    /**
     * Clinica routes
     */
    Route::resource('posts', ClinicController::class, [
        'names'=>'clinics.admin.posts'
    ]);
});

/**
 * Upload clinic's gallery
 */
Route::post('admin/clinics/posts/upload/{post}', [\App\Http\Controllers\Clinics\Admin\ClinicController::class, 'upload'])
    ->name('clinics.admin.posts.upload')
    ->middleware(['auth', 'isadmin']);


