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

Route::prefix('guru')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/getdata', [GuruKelasController::class, 'GetDataGuru'])
        ->middleware('role:admin|guru');
    Route::post('/tambah', [GuruKelasController::class, 'SetDataGuru'])
        ->middleware('role:admin');
    Route::post('/update', [GuruKelasController::class, 'UpdateDataGuru'])
        ->middleware('role:admin');
    Route::delete('/hapus', [GuruKelasController::class, 'HapusDataGuru'])
        ->middleware('role:admin');
});

Route::prefix('/matapelajaran')->middleware('auth:sanctum')->group(function () {
    Route::get('/getdata', [MataPelajaranController::class, 'GetMataPelajaran'])
        ->middleware('role:admin|guru|siswa');
    Route::post('/tambah', [MataPelajaranController::class, 'SetMataPelajaran'])
        ->middleware('role:admin');
    Route::put('/update', [MataPelajaranController::class, 'updateMataPelajaran'])
        ->middleware('role:admin');
    Route::delete('/hapus', [MataPelajaranController::class, 'deleteMataPelajaran'])
        ->middleware('role:admin');
});

Route::prefix('siswa')->middleware('auth:sanctum')->group(function () {
    Route::get('/getdata', [SiswaController::class, 'GetSiswa'])
        ->middleware('role:admin|guru');
    Route::post('/tambah', [SiswaController::class, 'SetSiswa'])
        ->middleware('role:admin');
    Route::put('/update', [SiswaController::class, 'updateSiswa'])
        ->middleware('role:admin');
    Route::delete('/hapus', [SiswaController::class, 'deleteSiswa'])
        ->middleware('role:admin');
});







