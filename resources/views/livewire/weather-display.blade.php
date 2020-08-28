<div class="w-128 mx-auto bg-gray-900 text-white text-sm rounded-lg overflow-hidden mt-8" x-data="{ isFutureWeatherVisible: true }">
    <div class="current-weather relative">
        <div class="flex items-center justify-between px-4 py-1">
            <div class="flex items-center">
                <div>
                    <div class="text-5xl font-semibold">{{ round($currentWeather['main']['temp']) }}&#176;C</div>
                    <div class="text-gray-400">Feels like {{ round($currentWeather['main']['feels_like']) }}&#176;C
                    </div>
                </div>
                <div class="ml-5">
                    <div class="font-semibold">{{ ucfirst($currentWeather['weather'][0]['description']) }}</div>
                    <div class="text-gray-400">{{ $location }}</div>
                </div>
            </div>
            <div>
                <img src="http://openweathermap.org/img/wn/{{ $currentWeather['weather'][0]['icon'] }}@4x.png"
                    alt="icon">
            </div>
        </div>
        <button @click="isFutureWeatherVisible = !isFutureWeatherVisible" class="absolute right-0 bottom-0 mb-2 mr-2 text-xs">Toggle</button>

    </div> <!-- current-weather -->
    <ul x-show="isFutureWeatherVisible" class="future-weather bg-gray-800 px-4 py-6 space-y-8">
        @foreach ($futureWeather['list'] as $weather)
            <li class="grid grid-cols-weather items-center">
                <div class="text-gray-400">
                    {{ strtoupper(\Carbon\Carbon::createFromTimestamp($weather['dt'])->format('D')) }}</div>
                <div class="flex items-center">
                    <div>
                        <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}.png" alt="icon">
                    </div>
                    <div>{{ ucfirst($weather['weather'][0]['description']) }}</div>
                </div>
                <div class="text-right text-xs">
                    <div>{{ round($weather['temp']['max']) }}&#176;C</div>
                    <div>{{ round($weather['temp']['min']) }}&#176;C</div>
                </div>
            </li>
        @endforeach
    </ul> <!-- future-weather -->
</div>
