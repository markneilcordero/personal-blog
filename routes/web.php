<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TagsController;



// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [PostsController::class, 'index']);
Route::get('/dashboard', [PostsController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostsController::class);
    Route::resource('comments', CommentsController::class);
    Route::resource('tags', TagsController::class);
});

Auth::routes();