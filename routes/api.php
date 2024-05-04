<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum']);

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'apiLogin');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'apiLogout');
        Route::post('/profile', 'apiUpdateProfile');
    });
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/company', 'getOneCompany');
    });
    Route::controller(AttendanceController::class)->group(function () {
        Route::get('/attendance/status', 'statusAttendance');
        // Route::get('/attendance', 'getAllAttendances');
        // Route::get('/attendance/{id}', 'getOneAttendance');
        Route::post('/attendance/checkin', 'checkIn');
        Route::post('/attendance/checkout', 'checkOut');
        // Route::put('/attendance/{id}', 'updateAttendance');
        // Route::delete('/attendance/{id}', 'deleteAttendance');
    });
    Route::controller(PermissionController::class)->group(function () {
        // Route::get('/permission', 'getAllPermissions');
        //     Route::get('/permission/{id}', 'getOnePermission');
        Route::post('/permission', 'createPermission');
        //     Route::put('/permission/{id}', 'updatePermission');
        //     Route::delete('/permission/{id}', 'deletePermission');
    });
    Route::controller(NoteController::class)->group(function () {
        Route::get('/note', 'getAllNote');
        Route::get('/note/{id}', 'getOneNote');
        Route::post('/note', 'createNote');
        Route::put('/note/{id}', 'updateNote');
        Route::delete('/note/{id}', 'deleteNote');
    });
});
