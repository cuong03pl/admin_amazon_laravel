<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\JobsUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create-account', [UserController::class, 'create'])->name('user.create-account');
Route::post('/user/create-account', [UserController::class, 'store'])->name('user.create-account');
Route::delete('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');


Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/products/{id}/detail', [ProductController::class, 'detail'])->name('products.detail');


Route::get('/jobs/index', [JobsController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobsController::class, 'create'])->name('jobs.create');
Route::post('/jobs/store', [JobsController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{id}/edit', [JobsController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/update', [JobsController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}/delete', [JobsController::class, 'delete'])->name('jobs.delete');
Route::get('/jobs/{id}/export', [JobsController::class, 'export'])->name('jobs.export');

Route::get('/jobs-user/index', [JobsUserController::class, 'index'])->name('jobs-user.index');
Route::get('/jobs-user/{id}/show', [JobsUserController::class, 'show'])->name('jobs-user.show');
Route::get('/jobs-user/{id}/edit', [JobsUserController::class, 'edit'])->name('jobs-user.edit');
Route::post('/jobs-user/update', [JobsUserController::class, 'update'])->name('jobs-user.update');

require __DIR__ . '/auth.php';
