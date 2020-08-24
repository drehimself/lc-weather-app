<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/main.css">


    </head>
    <body class="bg-gradient-to-tr from-blue-200 to-blue-400 min-h-screen">
        <div class="mt-8">
            <div>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae, similique minima! Magnam eum natus dolorum illum fugiat repellendus quia nisi placeat nostrum accusantium soluta aperiam provident corporis eligendi distinctio ad ratione doloremque, itaque commodi voluptatum, consequuntur excepturi dicta? Inventore, dolor quod adipisci non exercitationem nam aperiam officiis voluptatibus reprehenderit odit laborum, deleniti harum minus a numquam in! Perspiciatis reiciendis voluptatem excepturi doloribus cupiditate dolorem voluptatibus rem iure esse, officiis minus tempora incidunt magnam rerum sint architecto, suscipit eum impedit ut dicta itaque, neque delectus praesentium. Iure pariatur quia laudantium eligendi officiis reprehenderit ullam expedita quisquam, error eum architecto dolorum necessitatibus temporibus inventore cumque numquam iste? Enim autem, accusantium fugit nobis beatae ut odit distinctio eaque iure sint amet facilis sit, eveniet voluptatibus at illo aperiam quos, vitae blanditiis. Nam corporis nulla ipsa porro a quam esse quae doloribus neque qui ab voluptatibus eos, necessitatibus numquam. Quisquam omnis deserunt, molestiae maiores quo in culpa doloribus, alias dolorem, eveniet accusantium quia sed libero cumque numquam aut aspernatur neque aliquid quos? Sapiente quidem similique incidunt nemo hic nulla maiores iure dolorem voluptatum, ex qui, eveniet officia beatae consectetur inventore facilis dolor voluptatibus? Laudantium minima unde eius ullam eligendi velit esse consequuntur? Maxime soluta, neque odit reprehenderit ex dolore distinctio omnis culpa eos suscipit explicabo rem facere. Eligendi illum, quam voluptatibus aliquid non laborum tempora ab fugit quidem cupiditate iste, porro beatae iusto! Sint, deserunt maxime delectus consectetur perferendis minima nihil alias, fugiat ad architecto sunt quaerat voluptas doloremque, nisi atque recusandae facilis iure eveniet libero tenetur. Itaque velit repellendus cum, sunt sit ipsa praesentium nam quisquam iure eaque ducimus eius fugit tempore. Praesentium sint, quis voluptas id placeat debitis porro quisquam, repudiandae fugit molestias labore facilis officia eius omnis cum enim similique rerum quo? Consequuntur itaque facilis ullam sint voluptate placeat, dolor minus ad delectus eius nisi quos! Earum enim nemo voluptatum in dolore sed nam est quia hic non praesentium maxime, laudantium dolorum tempora excepturi veritatis ducimus libero possimus sit autem dolorem assumenda provident voluptatibus delectus! Modi laboriosam deserunt perferendis in vel explicabo, ipsam vero minima! At perspiciatis error sit labore cupiditate dolorum tenetur optio, asperiores tempore voluptatum consectetur laborum quaerat itaque eveniet libero delectus nihil harum quis laboriosam vitae expedita. Excepturi quo expedita fugiat quae facilis? Enim non quasi necessitatibus nesciunt aliquid, ducimus totam distinctio? Explicabo neque consequatur hic blanditiis est aspernatur, cupiditate quasi necessitatibus vero nam sed, iste sunt illo enim! Quibusdam reprehenderit iste inventore dolor nisi quia ratione provident, nobis blanditiis eum. Quidem totam quam aliquid nam quos magni fuga, ut id quo. In quidem iure laboriosam officia magni? Cum facere itaque possimus culpa illo numquam enim fugiat laborum laudantium aperiam, molestiae quam officiis animi dicta quia assumenda explicabo praesentium asperiores. Ut minus adipisci quidem est mollitia nostrum natus eius nulla tempore quae, corrupti culpa ratione sapiente eaque nemo voluptates quis placeat itaque veritatis nam aliquam in! Laborum accusantium enim aliquam officia, velit, vero repellat perspiciatis libero, tenetur excepturi eveniet laudantium cupiditate illum error consectetur maiores sequi aspernatur impedit!</div>
            <x-weather-widget :currentWeather="$currentWeather" :futureWeather="$futureWeather" :location="$location" />
        </div>

    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script>
        (function() {
            var placesAutocomplete = places({
                appId: 'plOB0CPNDK6B',
                apiKey: 'd174a0cc916d9b1544ea36d87a2c93af',
                container: document.querySelector('#address')
            }).configure({
                type: 'city',
                aroundLatLngViaIP: false,
            })

            var $address = document.querySelector('#address-value')

            const urlParams = new URLSearchParams(window.location.search)
            const myLocation = urlParams.get('location') ? urlParams.get('location') : 'Toronto, Canada'
            $address.textContent = myLocation

            placesAutocomplete.on('change', function(e) {
                window.location.href=`/?location=${e.suggestion.value}`
                $address.textContent = e.suggestion.value
            });

            placesAutocomplete.on('clear', function() {
                $address.textContent = 'none';
            });

            })();
    </script>
    </body>
</html>
