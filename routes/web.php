<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UkmOrmawaController;
use App\Http\Controllers\AlamatController;


Route::get('/', function () {
    return view('welcome');
});
