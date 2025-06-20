@extends('Student.layout')

@section('title', 'Student Feed')

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #map {
            height: 700px;
            width: 100%;
            border: 1px solid black;
        }
    </style>
</head>

@section('content')
    <hr style="color:#242582; height:3px;">
    <div id="map"></div>
    <div id="search-container" class="leaflet-bar leaflet-control leaflet-control-custom">
        <input id="search-input" type="text" placeholder="Search location...">
        <button id="search-button">Search</button>
    </div>

@endsection

{{-- @push('scripts') --}}
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const map = L.map("map").setView([3.848, 11.502], 7); // Cameroon coordinates
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
            }).addTo(map);

            // Add search control
            const searchControl = L.Control.extend({
                onAdd: function(map) {
                    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
                    container.innerHTML = `
                        <input id="search-input" type="text" placeholder="Search location...">
                        <button id="search-button">Search</button>
                    `;
                    L.DomEvent.disableClickPropagation(container);

                    // Add event listener for search button
                    L.DomEvent.on(container.querySelector('#search-button'), 'click', function() {
                        const query = container.querySelector('#search-input').value;
                        fetch(`https://nominatim.openstreetmap.org/search?q=${query}&format=json&limit=1`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    const lat = parseFloat(data[0].lat);
                                    const lon = parseFloat(data[0].lon);
                                    map.setView([lat, lon], 13);
                                    L.marker([lat, lon]).addTo(map);
                                } else {
                                    alert("Location not found");
                                }
                            })
                            .catch(error => console.error(error));
                    });

                    return container;
                }
            });
            map.addControl(new searchControl({ position: 'topright' }));
        });
    </script>
{{-- @endpush --}}