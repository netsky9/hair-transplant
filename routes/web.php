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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/form', [ContactController::class, 'submit'])->name('contact-form');

// неймспейс - это папка
Route::prefix('blog')->namespace('\App\Http\Controllers\Blog')->group(function () {
    Route::resource('posts', PostController::class, [
        'names'=>'blog.posts'
    ]);
});

Route::prefix('admin/blog')->namespace('\App\Http\Controllers\Blog\Admin')->group(function () {
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
        'only'=>['index', 'edit', 'store', 'update', 'create'],
        'names'=>'blog.admin.posts'
    ]);
});