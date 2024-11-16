<?php

use App\Http\Controllers\CategoryController;
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