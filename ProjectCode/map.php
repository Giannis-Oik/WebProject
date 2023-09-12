<?php
session_start();
include "db_conn.php";
$sql = "SELECT * FROM shops";
$result = mysqli_query($conn,$sql);
            
$geojson = array(
    "type" => "FeatureCollection",
    "features" => array()
);

while($row = mysqli_fetch_array($result))
{
    $properties = $row;
    
    unset($properties["latitude"]);
    unset($properties["longitude"]);

    $feature = array(
        "type" => "Feature",
        "properties" => $properties,
        "geometry" => array(
            "type" => "Point",
            "coordinates" => array(
                $row["latitude"],
                $row["longitude"]
            )
        )
    );

    array_push($geojson["features"], $feature);
}

$sql = "SELECT * FROM sales";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_array($result))
    {
        $sales[] = $row;
        $price[] = $row['price'];
        $date[] = $row['date'];
        $shop_id[] = $row['shop_id'];
    }
}


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

    <script> 
        const sales = <?php echo json_encode($sales); ?>;
        console.log(sales);
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

        var data = <?php echo json_encode($geojson, JSON_NUMERIC_CHECK); ?>;

        var featuresLayer = new L.GeoJSON(data, { //Dhmiourgia markers vasei toy arxeioy data.js
            onEachFeature: function (feature, marker) {
            marker.bindPopup('<h2>'+ feature.properties.shop_name +'</h2>');
            }
        });

        featuresLayer.addTo(map);

        let controlSearch = new L.Control.Search({ //Dhmioyrgia toy search bar analoga me to onoma gia kathe stoixeio toy layer poy periexei ta markers katasthmatwn
            position: "topright",
            layer: featuresLayer,
            propertyName: "shop_name",
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