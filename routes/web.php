<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [BlogController::class , 'blogView']);
Route::get('/blog_details' , [BlogController::class, 'blog_details']);
Route::post('/logout' , [BlogController::class, 'logout'])->name('logout');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.details');


// Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/category' , [CategoryController::class, 'index']);
Route::delete('/category/{id}' , [CategoryController::class , 'destroy'])->name('category.destroy');
Route::get('/category_create' , [CategoryController::class , 'create'])->name('category.create');
Route::post('/category_cr' , [CategoryController::class , 'store'])->name('category.store');
Route::get('/category_edit/{id}' , [CategoryController::class , 'edit'])->name('category.edit');
Route::put('/category_update/{id}' , [CategoryController::class, 'update'])->name('category.update');

Route::get('/category_filter/{id}', [PostController::class, 'filterByCategory'])->name('category.filter');


Route::get('/post' , [PostController::class, 'index']);
Route::delete('/post/{id}' , [PostController::class , 'destroy'])->name('post.destroy');
Route::get('/post_create' , [PostController::class , 'create'])->name('post.create');
Route::post('/post_cr' , [PostController::class , 'store'])->name('post.store');
Route::get('/post_edit/{id}' , [PostController::class , 'edit'])->name('post.edit');
Route::put('/post_update/{id}' , [PostController::class, 'update'])->name('post.update');
Route::get('/post/{id}', [BlogController::class, 'showPost'])->name('post.show');
Route::post('/post/{postId}/comment', [BlogController::class, 'storeComment'])->name('comment.store');
Route::get('/post/{post}', [PostController::class, 'showView'])->name('post.show');
Route::post('/post/{post}/like', [PostController::class, 'toggleLike'])->name('post.like');




Route::resource('users', UserController::class);

Route::get('/loginPage' , [AuthController::class , 'loginPage'])->name('loginPage');
Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::get('/registerPage' , [AuthController::class, 'registerPage'])->name('registerPage');
Route::post('/register' , [AuthController::class, 'register'])->name('register');
