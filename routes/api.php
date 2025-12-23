<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WilayahController;

// Route untuk data wilayah (Public Access)
Route::get('/provinces', [WilayahController::class, 'provinces']);
Route::get('/regencies/{provinceId}', [WilayahController::class, 'regencies']);
Route::get('/districts/{regencyId}', [WilayahController::class, 'districts']);
Route::get('/villages/{districtId}', [WilayahController::class, 'villages']);
