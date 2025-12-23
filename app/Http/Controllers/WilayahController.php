<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    private $baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    public function provinces()
    {
        return Cache::remember('provinces', 1440, function () {
            $response = Http::get("{$this->baseUrl}/provinces.json");
            return $response->json();
        });
    }

    public function regencies($provinceId)
    {
        return Cache::remember("regencies_{$provinceId}", 1440, function () use ($provinceId) {
            $response = Http::get("{$this->baseUrl}/regencies/{$provinceId}.json");
            return $response->json();
        });
    }

    public function districts($regencyId)
    {
        return Cache::remember("districts_{$regencyId}", 1440, function () use ($regencyId) {
            $response = Http::get("{$this->baseUrl}/districts/{$regencyId}.json");
            return $response->json();
        });
    }

    public function villages($districtId)
    {
        return Cache::remember("villages_{$districtId}", 1440, function () use ($districtId) {
            $response = Http::get("{$this->baseUrl}/villages/{$districtId}.json");
            return $response->json();
        });
    }
}