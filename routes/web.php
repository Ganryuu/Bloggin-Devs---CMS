<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SliderController;

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

Route::get('/larapage', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('category/{slug}', [WebsiteController::class, 'category'])->name('category');
Route::get('post/{slug}', [WebsiteController::class, 'post'])->name('post');
Route::get('page/{slug}', [WebsiteController::class, 'page'])->name('page');
Route::get('contact', [WebsiteController::class, 'showContactForm'])->name('contact.show');
Route::post('contact', [WebsiteController::class, 'submitContactForm'])->name('contact.submit');


Route::get('/admin/home', [HomeController::class, 'index']);
Route::group(['prefix'  => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('posts', PostController::class);
    Route::resource('pages', PageController::class);
    Route::resource('galeries', GaleryController::class);
});
