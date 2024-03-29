<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile', [App\Http\Controllers\UserController::class, 'updateUser'])->middleware('auth');

Route::get('/posts/like/{_id}', [App\Http\Controllers\PostController::class, 'like'])->name('like')->middleware('auth');

Route::get('/posts/comment/{_id}/{_cid?}', [App\Http\Controllers\PostController::class, 'getComments'])->name('comment')->middleware('auth');
Route::post('/posts/comment/{_id}/{_cid?}', [App\Http\Controllers\PostController::class, 'createComment'])->name('comment.create')->middleware('auth');
Route::get('/posts/comment/delete/{_id}/{_cid}', [App\Http\Controllers\PostController::class, 'deleteComment'])->name('comment.delete')->middleware('auth');
Route::get('/posts/comment/edit/{_id}/{_cid}', [App\Http\Controllers\PostController::class, 'editComment'])->name('comment.edit')->middleware('auth');
Route::post('/posts/comment/edit/{_id}/{_cid}', [App\Http\Controllers\PostController::class, 'editContentComment'])->name('comment.edit.content')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{_id?}', [App\Http\Controllers\PostController::class, 'form'])->name('post.form')->middleware('auth');
Route::post('/post/create', [App\Http\Controllers\PostController::class, 'save'])->name('post.create')->middleware('auth');
Route::put('/post/update/{_id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update')->middleware('auth');
Route::get('/post/delete/{_id}', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete')->middleware('auth');
