<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    // Role::create(['name' => 'writer']);
    // Permission::create(['name' => 'edit post']);
    // $role = Role::findById(2);
    // $permission = Permission::all();
    // $role->syncPermissions($permission);
    // $permission->removeRole($role);
    // $role->revokePermissionTo($permission);
    // auth()->user()->givePermissionTo('update post');

    return view('welcome');
});
Route::get('admin/index', function(){ return view('admin.index'); })->middleware('auth');
Route::resource('register', RegisterController::class);
Route::get('login',[SessionController::class, 'index']);
Route::post('login',[SessionController::class, 'store']);
Route::get('logout',[SessionController::class, 'destroy'])->middleware('auth');
// category
Route::get('category',[CategoryController::class, 'index'])->middleware('auth');
Route::post('store',[CategoryController::class, 'store'])->middleware('auth');
Route::get('category/edit/{category}',[CategoryController::class, 'edit'])->middleware('auth');
Route::get('category/update/{category}',[CategoryController::class, 'update'])->middleware('auth');
Route::post('category/delete/{id}', [CategoryController::class, 'delete'])->middleware('auth');

// posts
Route::get('posts',[PostsController::class, 'index'])->middleware('auth');
Route::get('post/create',[PostsController::class, 'create'])->middleware('auth');
Route::post('posts',[PostsController::class, 'store'])->middleware('auth');
Route::get('post/edit/{id}',[PostsController::class, 'edit'])->middleware('auth');
Route::post('post/update/{id}',[PostsController::class, 'update'])->middleware('auth');
Route::post('post/delete/{id}',[PostsController::class, 'delete'])->middleware('auth');
Route::get('status/{post}',[PostsController::class, 'status'])->middleware('auth');
//user
Route::patch('user/state/{id}',[UserController::class, 'stateUpdate'])->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
//role
Route::resource('role', RoleController::class)->middleware('auth');
Route::patch('role/permission/{id}',[RoleController::class, 'stateUpdate'])->middleware('auth');
