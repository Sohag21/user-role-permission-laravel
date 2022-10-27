<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserContoller;
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
    return view('welcome')->name('home');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth'])->name('admin-dashboard');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    // roles
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermissions'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'removePermissions'])->name('roles.permissions.remove');
    // permission
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'giveRoles'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRoles'])->name('permissions.roles.remove');
    // user
    Route::get('/users', [UserContoller::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserContoller::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserContoller::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserContoller::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserContoller::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserContoller::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserContoller::class, 'removePermission'])->name('users.permissions.remove');


});

require __DIR__.'/auth.php';
