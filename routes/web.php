<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/category' , [CategoryController::class, 'index']);
Route::delete('/category/{id}' , [CategoryController::class , 'destroy'])->name('category.destroy');
Route::get('/category_create' , [CategoryController::class , 'create'])->name('category.create');
Route::post('/category_cr' , [CategoryController::class , 'store'])->name('category.store');
Route::get('/category_edit/{id}' , [CategoryController::class , 'edit'])->name('category.edit');
Route::put('/category_update/{id}' , [CategoryController::class, 'update'])->name('category.update');

Route::get('/post' , [PostController::class, 'index']);
Route::delete('/post/{id}' , [PostController::class , 'destroy'])->name('post.destroy');
Route::get('/post_create' , [PostController::class , 'create'])->name('post.create');
Route::post('/post_cr' , [PostController::class , 'store'])->name('post.store');
Route::get('/post_edit/{id}' , [PostController::class , 'edit'])->name('post.edit');
Route::put('/post_update/{id}' , [PostController::class, 'update'])->name('post.update');