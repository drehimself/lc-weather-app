<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class WeatherDisplay extends Component
{
    public $currentWeather;
    public $futureWeather;
    public $location;

    protected $listeners = ['locationChanged' => 'updateLocation'];

    public function updateLocation($location)
    {
        $this->location = $location;
        $this->fetchWeather();
    }

    public function mount()
    {
        $this->location = 'Toronto, Canada';
        $this->fetchWeather();
    }

    public function fetchWeather()
    {
        $apiKey = config('services.openweather.key');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$this->location}&appid={$apiKey}&units=metric");
        $responseFuture = Http::get("https://api.openweathermap.org/data/2.5/forecast/daily?q={$this->location}&cnt=5&appid={$apiKey}&units=metric");

        $this->currentWeather = $response->json();
        $this->futureWeather = $responseFuture->json();
    }

    public function render()
    {
        return view('livewire.weather-display');
    }
}
