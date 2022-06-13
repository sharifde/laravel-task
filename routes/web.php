<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

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
    return view('welcome');
});


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
Route::get('/dashboard', function () {
    return view('backend.partial.index')->with('user', User::all())->with('product', Product::all())
    ->with('category', Category::All());
})->middleware(['auth'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
require __DIR__.'/auth.php';
