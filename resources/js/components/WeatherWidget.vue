<template>
    <div>
        <div class="w-128 mx-auto">
        <input type="search" id="address" class="form-control" placeholder="Where are we going?" />

            <p>Selected: <strong id="address-value">none</strong></p>
        </div>
        <div class="w-128 mx-auto bg-gray-900 text-white text-sm rounded-lg overflow-hidden mt-8">
            <div class="current-weather relative">
                <div class="flex items-center justify-between px-4 py-1">
                    <div class="flex items-center">
                        <div>
                            <div class="text-5xl font-semibold">{{ currentWeather.actual }}&#176;C</div>
                            <div class="text-gray-400">Feels like {{ currentWeather.feels }}&#176;C</div>
                        </div>
                        <div class="ml-5">
                            <div class="font-semibold">{{ currentWeather.description }}</div>
                            <div class="text-gray-400">{{ location }}</div>
                        </div>
                    </div>
                    <div>
                        <img :src="currentWeather.icon" alt="icon">
                    </div>
                </div>
                <button @click="isFutureWeatherVisible = !isFutureWeatherVisible" class="absolute right-0 bottom-0 mb-2 mr-2 text-xs">Toggle</button>

            </div> <!-- current-weather -->
            <ul v-show="isFutureWeatherVisible" class="future-weather bg-gray-800 px-4 py-6 space-y-8">

                <li v-for="weather in futureWeather" :key="weather.dt" class="grid grid-cols-weather items-center">
                    <div class="text-gray-400">{{ convertToDay(weather.dt) }}</div>
                    <div class="flex items-center">
                        <div>
                            <img :src="convertToImage(weather.weather[0].icon)" />
                        </div>
                        <div>{{ ucfirst(weather.weather[0].description) }}</div>
                    </div>
                    <div class="text-right text-xs">
                        <div>{{ Math.round(weather.temp.max) }}&#176;C</div>
                        <div>{{ Math.round(weather.temp.min) }}&#176;C</div>
                    </div>
                </li>


            </ul> <!-- future-weather -->
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            var placesAutocomplete = places({
                appId: 'plOB0CPNDK6B',
                apiKey: 'd174a0cc916d9b1544ea36d87a2c93af',
                container: document.querySelector('#address')
            }).configure({
                type: 'city',
                aroundLatLngViaIP: false,
            })

            var $address = document.querySelector('#address-value')

            placesAutocomplete.on('change', e => {
                $address.textContent = e.suggestion.value
                this.location = e.suggestion.value
            })

            placesAutocomplete.on('clear', function() {
                $address.textContent = 'none'
            })

            this.fetchCurrentWeather()
            this.fetchFutureWeather()
        },
        watch: {
            location() {
                this.fetchCurrentWeather()
                this.fetchFutureWeather()
            }
        },
        data() {
            return {
                location: 'Toronto',
                currentWeather: {
                    actual: '',
                    feels: '',
                    description: 'Loading...',
                    icon: '',
                },
                futureWeather: [],
                isFutureWeatherVisible: false,
            }
        },
        methods: {
            convertToDay(timestamp) {
                const newDate = new Date(timestamp*1000)
                const days = ['SUN','MON','TUE','WED','THU','FRI','SAT']

                return days[newDate.getDay()]
            },
            convertToImage(icon) {
                return `http://openweathermap.org/img/wn/${icon}.png`
            },
            fetchCurrentWeather() {
                axios.get(`/weather?location=${this.location}`)
                    .then(response => {
                        this.currentWeather.actual = Math.round(response.data.main.temp)
                        this.currentWeather.feels = Math.round(response.data.main.feels_like)
                        this.currentWeather.description = this.ucfirst(response.data.weather[0].description)
                        this.currentWeather.icon = `https://openweathermap.org/img/wn/${response.data.weather[0].icon}@4x.png`
                    })
            },
            fetchFutureWeather() {
                axios.get(`/future-weather?location=${this.location}`)
                    .then(response => {
                        this.futureWeather = response.data.list
                    })
            },
            ucfirst(stringToConvert) {
                return stringToConvert.charAt(0).toUpperCase() + stringToConvert.slice(1)
            },
        }
    }
</script>
