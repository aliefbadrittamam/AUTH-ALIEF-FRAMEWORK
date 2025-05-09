<?php

use App\Http\Controllers\api\GuruKelasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\RoleController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/saya', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');

Route::get('/user', action: function (Request $request) {
    
})->middleware('auth:sanctum', 'role:super-admin');


// Route::post('/super-admin', action: [RoleController::class, 'store'])->middleware('auth:sanctum', 'role:super-admin');
Route::post('/super-admin/permission', action: [RoleController::class, 'store_permission'])->middleware('auth:sanctum', 'role:super-admin');
Route::get('/super-admin', action: [RoleController::class, 'store'])->middleware('auth:sanctum', 'role:super-admin');


Route::prefix('guru')->group(function () {

    Route::get('/getdata', action: [GuruKelasController::class, 'GetDataGuru'])->middleware('auth:sanctum','role:customer');
    Route::post('/tambah', action: [GuruKelasController::class, 'SetDataGuru'])->middleware('auth:sanctum');
    Route::post('/update', action: [GuruKelasController::class, 'UpdateDataGuru'])->middleware('auth:sanctum');
    Route::post('/hapus', action: [GuruKelasController::class, 'HapusDataGuru'])->middleware('auth:sanctum');
    Route::get('/user', action: function (Request $request) {
    
    })->middleware('auth:sanctum', 'role');


    });

