<?php
session_start();
include "db_conn.php";
$sql = "SELECT * FROM shops";
$result = mysqli_query($conn,$sql);
            
$geojson = array(
    "type" => "FeatureCollection",
    "features" => array()
);

while($row = mysqli_fetch_array($result)) //Dhmniourgia geojson pinaka me ta katasthmata apo th vash.
{
    $properties = $row;
    
    unset($properties["lat"]);
    unset($properties["lon"]);

    $feature = array(
        "type" => "Feature",
        "properties" => $properties,
        "geometry" => array(
            "type" => "Point",
            "coordinates" => array(
                $row["lon"],
                $row["lat"]
            )
        )
    );

    array_push($geojson["features"], $feature);
}

$sql = "SELECT * FROM shops INNER JOIN sales WHERE shops.id=sales.shop_id AND active = 1"; //Dhmiourgia geojson pinaka me osa katasthmata ths vashs exoyn prosfores
$result = mysqli_query($conn,$sql);

$salesjson = array(
    "type" => "FeatureCollection",
    "features" => array()
);

if(mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_array($result))
    {
        $properties = $row;
        
        unset($properties["lat"]);
        unset($properties["lon"]);

        $feature = array(
            "type" => "Feature",
            "properties" => $properties,
            "geometry" => array(
                "type" => "Point",
                "coordinates" => array(
                    $row["lon"],
                    $row["lat"]
                )
            )
        );

        array_push($salesjson["features"], $feature);
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
        const data = <?php echo json_encode($geojson, JSON_NUMERIC_CHECK); ?>;
        const array = <?php echo json_encode($salesjson, JSON_NUMERIC_CHECK); ?>;

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

        var featuresLayer = new L.GeoJSON(data, { //Dhmiourgia markers vasei toy json poy prokyptei apo thn antlhsh dedomenwn katasthmatwn apo th vash
            onEachFeature: function (feature, marker) {
            marker.bindPopup('<h2>'+ feature.properties.name + " " + feature.properties.id +'</h2>'+ '<button onclick="addSale();">New sale</button>');
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

        var salesLayer = new L.GeoJSON(array, { //Me vash to geojson twn katasthmatwn me prosfores ftiakse to marker me diaforetiko xrwma kai diaforetikes epiloges sto popup
            onEachFeature: function (feature, marker) {
            marker.bindPopup('<h2>'+ feature.properties.name + " " + feature.properties.shop_id +'</h2>'+'<button onclick="addSale();">New sale</button>' + '<button onclick="checkSale();">Rate sales</button>').setIcon(handColorIcon("red"));
            }
        });

        salesLayer.addTo(map);

        function addSale() //Sinartiseis gia ta koympia poy vriskontai entos twn popup
        {
            window.open("new_sales.php");
        }

        function checkSale()
        {
            window.open("sales_admin.php");
        }

        function handColorIcon(color){ //Sinartisi gia thn allagh toy xrwmatos toy marker
            return new L.Icon({
                iconUrl:
                    `https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${color}.png`,
                shadowUrl:
                    'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41],
            });
        }

    </script>
    <?php
}
else
{
    header("Location: index.php");
    exit();
}