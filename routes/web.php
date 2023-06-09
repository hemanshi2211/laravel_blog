<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShowPost;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


Route::get('/',[ShowPost::class, 'index']);
Route::get('post/{id}/show',[ShowPost::class,'show']);
Route::get('category/{id}', [ShowPost::class,'catShow']);
Route::get('author/{id}',[ShowPost::class,'authorShow']);
Route::post('like/{id}',[LikeController::class, 'store']);

Route::get('admin/index',[CustomAuthController::class, 'dashboard'])->name('adminDashboard');
Route::get('logout',[CustomAuthController::class, 'signOut']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login/create',[CustomAuthController::class, 'index'])->name('login');
    Route::post('login',[CustomAuthController::class, 'customLogin']);
    Route::get('registration/create',[CustomAuthController::class, 'registration']);
    Route::post('registration',[CustomAuthController::class, 'store']);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('category',CategoryController::class)->middleware('category');
    Route::resource('posts',PostController::class)->middleware('post');
    Route::resource('user',UserController::class)->middleware('user');
    Route::resource('role',RoleController::class)->middleware('role');

    Route::patch('status/{id}',[PostController::class,'status']);
    Route::patch('user/state/{id}',[UserController::class, 'stateUpdate']);
    Route::patch('role/permission/{id}',[RoleController::class, 'stateUpdate']);
    Route::post('comment/{id}',[CommentController::class,'store']);

});

Route::get('sendNotification',[TestController::class,'send']);
