<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LikeController;

// -------------------------------
// Static Pages (Landing Sections)
// -------------------------------
Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::view('/team', 'pages.team')->name('team');
Route::view('/tour', 'pages.tour')->name('tour');
Route::view('/careers', 'pages.careers')->name('careers');
Route::view('/contact', 'pages.contact')->name('contact');

// -------------------------------
// Blog Routes
// -------------------------------
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

// -------------------------------
// Likes & Subscriptions
// -------------------------------
Route::post('/blog/{blog}/like', [LikeController::class, 'toggle'])->name('blog.like');

// Subscription routes
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('/subscribe/confirm/{token}', [SubscriptionController::class, 'confirm'])->name('subscribe.confirm');
Route::post('/blog/subscribe', [SubscriptionController::class, 'store'])->name('blog.subscribe');

require __DIR__ . '/admin.php';
