<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

# Home

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

# Admin Authentication

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminController::class, 'loginForm'])
        ->name('admin.login');

    Route::post('/login', [AdminController::class, 'login']);

    Route::post('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

});

# Protected Routes

Route::middleware('auth:admin')->group(function () {

    # Blogs
 

    Route::resource('blogs', BlogController::class);

    # Admins
   

    Route::resource('admins', AdminController::class);

    # Users
  

    Route::resource('users', UserController::class);

    # Trash
 

    Route::get('/trash', [BlogController::class, 'trash'])
        ->name('trash');

    #Restore Admin
  

    Route::post('/admins/restore/{id}', [AdminController::class, 'restore'])
        ->name('admins.restore');

    #Force Delete Admin
   

    Route::delete('/admins/force-delete/{id}', [AdminController::class, 'forceDelete'])
        ->name('admins.forceDelete');

});