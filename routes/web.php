<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssignSubjectController;
use App\Http\Controllers\Admin\GrievanceController;
use App\Http\Controllers\Admin\GrievanceSubjectController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
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
})->name('login');
Route::get('test', function () {
    return view('email_send_otp');
});

Route::prefix('user-login')->as('user-login.')->group(function () {
    Route::post('email-send-otp',[FrontendController::class,'email_verify'])->name('emailverify'); 
    Route::post('verify-otp',[FrontendController::class,'otp_verify'])->name('emailotpverify');
    Route::get('grievance-user-register',[FrontendController::class,'grievance_user_register'])->name('grievanceuser');
    Route::post('grievance-user-register',[FrontendController::class,'submit_user_grievance'])->name('postusergrievance');
    
});
Route::prefix('user')->as('user.')->group(function(){
    Route::get('dashboard',[FrontendController::class,'dashboard'])->name('dashboard');
    Route::get('raise-grievance',[FrontendController::class,'grievance_raise'])->name('grievanceraise');
    Route::post('raise-grievance',[FrontendController::class,'raise_grievance'])->name('raisegrievance');
    Route::get('pending-grievance',[FrontendController::class,'pending_grievance'])->name('grievancepending');
    Route::get('grievance-detail/{id}',[FrontendController::class,'grievance_detail'])->name('grievancedetail');
    Route::get('grievance-close',[FrontendController::class,'grievance_close'])->name('grievanceclose');
});

Route::post('admin-login',[AdminController::class,'AdminLogin'])->name('admin_login');
Route::post('register',[AdminController::class,'Register'])->name('register');
Route::get('get-register',[AdminController::class,'getRegister'])->name('registeration');

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => 'auth'],function(){
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('logout',[AdminController::class,'Logout'])->name('logout');
    Route::get('role',[RoleController::class,'indexR'])->name('role');
    Route::post('role-store',[RoleController::class,'store'])->name('role_store');
    Route::resource('permission',PermissionController::class);

    Route::get('role-has-permission',[PermissionController::class,'rolePermission'])->name('rolePermission');
    Route::post('fetch-permission',[PermissionController::class,'fetchPermission'])->name('fetchPermission');
    Route::post('assign-permission',[PermissionController::class,'assignPermission'])->name('assignPermission');

    Route::resource('subject',GrievanceSubjectController::class);
    Route::get('changeStatus/{id}',[GrievanceSubjectController::class,'is_activeSubject']);
    Route::resource('user',UserController::class);
    Route::resource('assign',AssignSubjectController::class);
    Route::post('assign-user',[AssignSubjectController::class,'assignUser'])->name('assignUser');
    Route::get('new-grievance',[GrievanceController::class,'newGrievance'])->name('newgrievance');
    Route::get('pending-grievance',[GrievanceController::class,'pendingGrievance'])->name('pengrievance');
    Route::get('close-grievance',[GrievanceController::class,'closeGrievance'])->name('closegrievance');
    Route::post('action',[GrievanceController::class,'takeAction'])->name('takeaction');
    Route::post('mark-as-read',[GrievanceController::class,'markRead'])->name('markread');
    Route::get('view-grievcance/{id}',[GrievanceController::class,'viewGrievance'])->name('viewgrievance');
    Route::post('grievance-query',[GrievanceController::class,'grievanceQuery'])->name('grievancequery');
});



Route::get('/optimize', function(){
    Artisan::call('optimize');
});
Route::get('/optimize-clear', function(){
    Artisan::call('optimize:clear');
});





