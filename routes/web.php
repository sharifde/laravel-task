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

//  role and user  routes
// Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
// });

// end of roles and user routes
// products routes
Route::get('product', [ProductController::class,'index']);
Route::post('delete-product', [ProductController::class, 'destroy']);
Route::post('product/store', [ProductController::class, 'store']);
Route::post('edit-product', [ProductController::class, 'edit']);

use App\Http\Controllers\AjaxCRUDImageController;

// Route::get('ajax-crud-image-upload', [ProductController::class, 'index']);
// Route::post('add-update-book', [ProductController::class, 'store']);
// Route::post('edit-book', [ProductController::class, 'edit']);
// Route::post('delete-product', [ProductController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('admin.index')->with('user', User::all())->with('product', Product::all())
    ->with('category', Category::All());
})->middleware(['auth'])->name('dashboard');
//  category  crud routes
Route::get('category', [CategoryController::class, 'index']);
Route::post('add-update-book', [CategoryController::class, 'store']);
Route::post('delete-book', [CategoryController::class, 'destroy']);
Route::post('edit-book', [CategoryController::class, 'edit']);
require __DIR__.'/auth.php';
