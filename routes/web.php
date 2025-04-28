<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::middleware([Authenticate::class,IsUser::class])->group(function () {
    Route::get('/', [ShortUrlController::class, 'index'])->name('home');
    Route::get('/short-url', [ShortUrlController::class, 'viewCreate'])->name('shortUrl.view.create');
    Route::post('/create-short-url', [ShortUrlController::class, 'store'])->name('shortUrl.create');
    Route::get('/short-url/{id}', [ShortUrlController::class, 'viewUpdate'])->name('shortUrl.view.update');
    Route::patch('/update-short-url/{id}', [ShortUrlController::class, 'update'])->name('shortUrl.update');
    Route::get('/delete-short-url/{id}', [ShortUrlController::class, 'delete'])->name('shortUrl.delete');
});


Route::middleware([Authenticate::class,IsAdmin::class])->group(function () {
    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::post('admin/create-short-url', [AdminController::class, 'store'])->name('admin.shortUrl.create');
    Route::get('admin/short-url/{id}', [AdminController::class, 'viewUpdate'])->name('admin.shortUrl.view.update');
    Route::patch('admin/update-short-url/{id}', [AdminController::class, 'update'])->name('admin.shortUrl.update');
    Route::delete('admin/delete-short-url/{id}', [AdminController::class, 'delete'])->name('admin.shortUrl.delete');
   });

// Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');
// Route::post('admin/create-short-url', [AdminController::class, 'store'])->name('admin.shortUrl.create')->middleware('is_admin');
// Route::patch('admin/update-short-url/{id}', [ShortUrlController::class, 'update'])->name('shortUrl.update')->middleware('is_admin');
// Route::delete('admin/delete-short-url/{id}', [AdminController::class, 'delete'])->name('admin.shortUrl.delete')->middleware('is_admin');

// Route::middleware([IsAdmin::class])->group(function () {
    // Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
// });
