<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
// Route::POST('add-update-book', function () {
    
// });
// Route::get('cat', function () {
//     return view('category.index');
// });

Route::resource('product', ProductController::class);
// Route::post('product/store', [ProductController::class, 'store']);

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');
//  category  crud routes
Route::get('category', [CategoryController::class, 'index']);
Route::post('add-update-book', [CategoryController::class, 'store']);
Route::post('delete-book', [CategoryController::class, 'destroy']);
Route::post('edit-book', [CategoryController::class, 'edit']);
require __DIR__.'/auth.php';
