<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Artisan;
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
    return view('login');
});
// Route::get('/admin', function () {
//     return view('welcome');
// })->name('admin.dashboard');

Route::post('/login',[AdminController::class,'AdminLogin'])->name('admin_login');
Route::post('register',[AdminController::class,'Register'])->name('register');
Route::get('get-register',[AdminController::class,'getRegister'])->name('registeration');

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => 'auth'],function(){
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('logout',[AdminController::class,'Logout'])->name('logout');
Route::get('role',[RoleController::class,'indexR'])->name('role');
Route::post('role-store',[RoleController::class,'store'])->name('role_store');
Route::resource('permission',PermissionController::class);

Route::get('/role-has-permission',[PermissionController::class,'rolePermission'])->name('rolePermission');
Route::post('/fetch-permission',[PermissionController::class,'fetchPermission'])->name('fetchPermission');
Route::post('/assign-permission',[PermissionController::class,'assignPermission'])->name('assignPermission');
});



Route::get('/optimize', function(){
    Artisan::call('optimize');
});
Route::get('/optimize-clear', function(){
    Artisan::call('optimize:clear');
});
