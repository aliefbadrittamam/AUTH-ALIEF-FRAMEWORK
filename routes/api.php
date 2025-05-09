<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\GuruKelasController;
use App\Http\Controllers\api\MataPelajaranController;
use App\Http\Controllers\api\AuthenticationController;
use App\Http\Controllers\api\SiswaController;

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/saya', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');

Route::get('/user', action: function (Request $request) {})->middleware('auth:sanctum', 'role:super-admin');

// Route::post('/super-admin', action: [RoleController::class, 'store'])->middleware('auth:sanctum', 'role:super-admin');
Route::post('/super-admin/permission', action: [RoleController::class, 'store_permission'])->middleware('auth:sanctum', 'role:super-admin');
Route::get('/super-admin', action: [RoleController::class, 'store'])->middleware('auth:sanctum', 'role:super-admin');

Route::prefix('guru')->group(function () {
    Route::get('/getdata', action: [GuruKelasController::class, 'GetDataGuru'])->middleware('auth:sanctum', 'role:customer');
    Route::post('/tambah', action: [GuruKelasController::class, 'SetDataGuru'])->middleware('auth:sanctum');
    Route::post('/update', action: [GuruKelasController::class, 'UpdateDataGuru'])->middleware('auth:sanctum');
    Route::delete('/hapus', action: [GuruKelasController::class, 'HapusDataGuru'])->middleware('auth:sanctum');
    Route::get('/user', action: function (Request $request) {})->middleware('auth:sanctum', 'role');
});



Route::prefix('/matapelajaran')->group(function () {
    Route::get('/getdata', [MataPelajaranController::class, 'GetMataPelajaran']);
    Route::post('/tambah', [MataPelajaranController::class, 'SetMataPelajaran']);
    Route::put('/update', [MataPelajaranController::class, 'updateMataPelajaran']);
    Route::delete('/hapus', [MataPelajaranController::class, 'deleteMataPelajaran']);
})->middleware('auth:sanctum');


Route::prefix('siswa')->group(function () {
    Route::get('/getdata', [SiswaController::class, 'GetSiswa']);
    Route::post('/tambah', [SiswaController::class, 'SetSiswa']);
    Route::put('/update', [SiswaController::class, 'updateSiswa']);
    Route::delete('/hapus', [SiswaController::class, 'deleteSiswa']);
})->middleware('auth:sanctum');







