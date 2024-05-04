<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceUnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
  Route::redirect('/', '/dashboard');

  Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
  });

  Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('view.list.user');
    Route::get('/user/create', 'viewCreateUser')->name('view.create.user');
    Route::post('/user/create', 'apiCreateUser')->name('api.create.user');
    Route::get('/user/update/{id}', 'viewUpdateUser')->name('view.update.user');
    Route::put('/user/update/{id}', 'apiUpdateUser')->name('api.update.user');
  });

  Route::controller(ServiceUnitController::class)->group(function () {
    Route::get('/service-unit', 'index')->name('view.list.service-unit');
    Route::get('/service-unit/create', 'viewCreateServiceUnit')->name('view.create.service-unit');
    Route::post('/service-unit/create', 'apiCreateServiceUnit')->name('api.create.service-unit');
    Route::get('/service-unit/update/{id}', 'viewUpdateServiceUnit')->name('view.update.service-unit');
    Route::put('/service-unit/update/{id}', 'apiUpdateServiceUnit')->name('api.update.service-unit');
  });

  Route::controller(CompanyController::class)->group(function () {
    Route::get('/company', 'index')->name('view.list.company');
    Route::get('/company/create', 'viewCreateCompany')->name('view.create.company');
    Route::post('/company/create', 'apiCreateCompany')->name('api.create.company');
    Route::get('/company/update/{id}', 'viewUpdateCompany')->name('view.update.company');
    Route::put('/company/update/{id}', 'apiUpdateCompany')->name('api.update.company');
  });

  Route::controller(RoleController::class)->group(function () {
    Route::get('/role', 'index')->name('view.list.role');
    Route::get('/role/create', 'viewCreateRole')->name('view.create.role');
    Route::post('/role/create', 'apiCreateRole')->name('api.create.role');
    Route::get('/role/update/{id}', 'viewUpdateRole')->name('view.update.role');
    Route::put('/role/update/{id}', 'apiUpdateRole')->name('api.update.role');
  });

  Route::controller(AttendanceController::class)->group(function () {
    Route::get('/attendance', 'index')->name('view.list.attendance');
    // Route::get('/attendance/create', 'viewCreateAttendance')->name('view.create.attendance');
    // Route::post('/attendance/create', 'apiCreateAttendance')->name('api.create.attendance');
    // Route::get('/attendance/update/{id}', 'viewUpdateAttendance')->name('view.update.attendance');
    // Route::put('/attendance/update/{id}', 'apiUpdateAttendance')->name('api.update.attendance');
  });

  Route::controller(PermissionController::class)->group(function () {
    Route::get('/permission', 'index')->name('view.list.permission');
    // Route::get('/permission/create', 'viewCreatepermission')->name('view.create.permission');
    // Route::post('/permission/create', 'apiCreatepermission')->name('api.create.permission');
    // Route::get('/permission/update/{id}', 'viewUpdatepermission')->name('view.update.permission');
    // Route::put('/permission/update/{id}', 'apiUpdatepermission')->name('api.update.permission');
  });
});
