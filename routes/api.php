<?php

use App\Http\Controllers\CiudadesController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\CurrencyExchangeController;
use Illuminate\Support\Facades\Route;

Route::get('/weather/{id}', [WeatherController::class, 'consultarApiWeather']);
Route::get('/currency', [CurrencyExchangeController::class, 'consultarApiCurrency']);
Route::get('/ciudades', [CiudadesController::class, 'index']);


