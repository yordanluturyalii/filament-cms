<?php

use App\Enum\ArticleStatus;
use App\Http\Controllers\AuthCallbackController;
use App\Http\Controllers\AuthRedirectController;
use App\Livewire\Pages\Article;
use App\Livewire\Pages\Category;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/articles/{article:slug}', Article::class)->name('article.show');
Route::get('/categories/{category:slug}', Category::class)->name('category.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware('guest')->group(function () {
    Route::get('/auth/redirect/{service}', AuthRedirectController::class)->name('auth.redirect');
    Route::get('/auth/callback/{service}', AuthCallbackController::class)->name('auth.callback');
});
