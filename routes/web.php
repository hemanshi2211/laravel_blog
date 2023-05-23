<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
});

// category
Route::get('category',[CategoryController::class, 'index']);
Route::post('store',[CategoryController::class, 'store']);
Route::get('category/edit/{category}',[CategoryController::class, 'edit']);
Route::get('category/update/{category}',[CategoryController::class, 'update']);
Route::post('category/delete/{id}', [CategoryController::class, 'delete']);

// posts
Route::get('posts',[PostsController::class, 'index']);
Route::get('post/create',[PostsController::class, 'create']);
Route::post('posts',[PostsController::class, 'store']);
Route::get('post/edit/{id}',[PostsController::class, 'edit']);
Route::post('post/update/{id}',[PostsController::class, 'update']);


Route::post('post/delete/{id}',[PostsController::class, 'delete']);
