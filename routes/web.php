<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $location = request()->location ? request()->location : 'Toronto, Canada';
    $apiKey = config('services.openweather.key');

    $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$apiKey}&units=metric");
    $responseFuture = Http::get("https://api.openweathermap.org/data/2.5/forecast/daily?q={$location}&cnt=5&appid={$apiKey}&units=metric");

    return view('welcome', [
        'currentWeather' => $response->json(),
        'futureWeather' => $responseFuture->json(),
        'location' => $location,
    ]);
});
