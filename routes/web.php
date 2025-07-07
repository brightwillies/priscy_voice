<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return response()->json([
        'message' => 'You are unauthorized',
    ], 401);
})->name('login');

Route::post('/login', function () {
    return response()->json([
        'message' => 'You are unauthorized',
    ], 401);
})->name('login');

Route::get('/donate-now', function () {
    return view('donate-now');
});


Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('about-us');
Route::get('/events', [FrontendController::class, 'events'])->name('team');
Route::get('/categories/{category}', [FrontendController::class, 'blogCategory'])->name('blogCategory');
Route::get('/blogs', [FrontendController::class, 'blogs'])->name('blogs');
Route::get('/blog/{id}', [FrontendController::class, 'singleBlog']);


Route::post('/comments/{blog}', [FrontendController::class, 'storeComment'])->name('comments.store');
Route::post('/likes/{blog}', [FrontendController::class, 'toggleLike'])->name('likes.toggle');

Route::get('/events/{id}', [FrontendController::class, 'singleEvent']);
Route::get('/gallery', [FrontendController::class, 'gallery']);
Route::get('/gallery/{id}', [FrontendController::class, 'viewGallery']);
Route::get('/contact-us', [FrontendController::class, 'contact']);

Route::get('/admin-login', [DashboardController::class, 'index']);
Route::get('/admin-forgot-password', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/{any?}', [DashboardController::class, 'index']);
Route::get('/dashboard/gallery/{any?}', [DashboardController::class, 'index']);
Route::get('/dashboard/event/{any?}', [DashboardController::class, 'index']);
Route::get('/dashboard/event-registrants/{any}', [DashboardController::class, 'index']);
Route::get('/dashboard/event-details/{any?}', [DashboardController::class, 'index']);
Route::get('/dashboard/blog/{any?}', [DashboardController::class, 'index']);
Route::get('/dashboard/blog-comments/{any?}', [DashboardController::class, 'index']);
