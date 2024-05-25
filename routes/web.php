<?php

use App\Http\Controllers\PostController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'create'])->name('post#home');
Route::get('customer/create', [PostController::class, 'create'])->name('post#createPage');
Route::post('post/create', [PostController::class, 'postCreate'])->name('post#create');
Route::get('post/delete/{id}', [PostController::class, 'postDelete'])->name('post#delete');
Route::get('post/update/{id}', [PostController::class, 'postUpdate'])->name('post#update');
Route::get('post/edit/{id}', [PostController::class, 'postEdit'])->name('post#edit');
Route::post('postUpdate/', [PostController::class, 'updatePage'])->name('updatePage');
