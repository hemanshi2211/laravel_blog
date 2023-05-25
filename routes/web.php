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
Route::get('admin/index', function(){ return view('admin.index'); });
Route::resource('register', RegisterController::class);
Route::get('login',[SessionController::class, 'index']);
Route::post('login',[SessionController::class, 'store']);
Route::get('logout',[SessionController::class, 'destroy']);
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
Route::get('status/{post}',[PostsController::class, 'status']);
//user
Route::patch('user/state/{id}',[UserController::class, 'stateUpdate']);
Route::resource('user', UserController::class);
//role
Route::resource('role', RoleController::class);
