<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))//Selida opoy emfanizetai o xarths 
{
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>HOME</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/> <!-- Leaflet plugins -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.2/dist/leaflet-search.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />
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
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="./data.js"></script>

    <script> 
        var map = L.map('map').locate({setView: true, maxZoom: 17}).on('locationfound', function(e){ //Arxikopoihsh xarth sto location toy xrhsth alliws an den mporei na to vrei tote emfanizei mhnyma lathoys
            var lat = e.latitude;
            var long = e.longitude; 
        }).on('locationerror', function(e){
            console.log(e);
            alert("Location access denied.");
        });

        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { //Arxikopoihsh layers mesw toy osm kai prosthikis toys sto xarth
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        osm.addTo(map);

        var featuresLayer = new L.GeoJSON(data, { //Dhmiourgia markers vasei toy arxeioy data.js
            onEachFeature: function (feature, marker) {
            marker.bindPopup("<h4>" + feature.properties.name + "</h4>");
            }
        });

        featuresLayer.addTo(map);

        let controlSearch = new L.Control.Search({ //Dhmioyrgia toy search bar analoga me to onoma gia kathe stoixeio toy layer poy periexei ta markers katasthmatwn
            position: "topright",
            layer: featuresLayer,
            propertyName: "name",
            initial: false,
            zoom: 20
        });

        map.addControl(controlSearch);

        L.control.locate().addTo(map); //Eisagwgi koympioy poy estiazei sto location toy xrhsth 
    </script>
    <?php
}
else
{
    header("Location: index.php");
    exit();
}