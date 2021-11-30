<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Member Route
Route::resource('/member', MemberController::class);
Route::get('/memberall', [MemberController::class, 'allMember']);

// BookCategory Route
Route::resource('/bookcategory', BookCategoryController::class);
Route::get('/allcategory', [BookCategoryController::class, 'allBookCategory']);

// Book Route
Route::resource('/book', BookController::class);
Route::get('/allbook', [BookController::class, 'allBook']);
