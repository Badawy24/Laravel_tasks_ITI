<?php

use App\Http\Controllers\CommentContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');

Route::post('/posts',[PostController::class,'store'])->name('posts.store');

Route::get('/posts/{posts}/edit',[PostController::class,'edit'])->name('posts.edit');

Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::put('/posts/{posts}',[PostController::class,'update'])->name('posts.update');

Route::delete('/posts/{posts}',[PostController::class,'destroy'])->name('posts.destroy');

// Route::resource();


Route::post('/posts/{post}/comments', [CommentContoller::class, 'addComment'])->name('posts.comments');
