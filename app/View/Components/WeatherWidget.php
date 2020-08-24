<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WeatherWidget extends Component
{
    public $currentWeather;
    public $futureWeather;
    public $location;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($currentWeather, $futureWeather, $location)
    {
        $this->currentWeather = $currentWeather;
        $this->futureWeather = $futureWeather;
        $this->location = $location;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.weather-widget');
    }
}
