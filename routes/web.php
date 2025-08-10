<?php

use App\Http\Controllers\article\ArticleController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\UserController;
use App\Http\Middleware\EnsureAdminOnly;
use App\Http\Middleware\EnsurePublisherOrAdminOnly;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified' , EnsurePublisherOrAdminOnly::class])
    ->name('dashboard');


Route::middleware(['auth', EnsureAdminOnly::class])->group(function () {
    Route::resource('user', UserController::class)->only(['index']);
});

Route::middleware(['auth', EnsurePublisherOrAdminOnly::class])->group(function () {
    Route::get('/user/categories/{user}', [UserController::class, 'categories'])->name('user.categories');

    Route::resource('user', UserController::class)->except(['index']);
    Route::resource('article', ArticleController::class);
    Route::resource('category',CategoryController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('article', ArticleController::class)->only(['show','index']);
    Route::resource('category', CategoryController::class)->only(['show','index']);
});


require __DIR__.'/auth.php';
