<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.2/dist/leaflet-search.min.css"/>
        <style>
            #map {
                height: 100vh; 
                width: 100%;
            } 
            img.huechange { filter: hue-rotate(120deg); }
        </style>
    </head>
    <body>
        <div id="map"></div>
    </body>

    </html>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.min.js"></script>
    <script src="./data.js"></script>

    <script>
        var map = L.map('map').setView([38.2464573, 21.7352765], 17);

        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        osm.addTo(map);

        var featuresLayer = new L.GeoJSON(data, {
            onEachFeature: function (feature, marker) {
            marker.bindPopup("<h4>" + feature.properties.name + "</h4>");
            }
        });

        featuresLayer.addTo(map);

        let controlSearch = new L.Control.Search({
            position: "topright",
            layer: featuresLayer,
            propertyName: "name",
            initial: false,
            zoom: 20
        });

        map.addControl(controlSearch);
    </script>
    <?php
}
else
{
    header("Location: index.php");
    exit();
}