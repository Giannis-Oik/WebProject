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

    $shops_array[] = $row;
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

$sql = "SELECT * FROM sales"; //Dhmiourgia json pinaka me tis prosfores
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)) //Dhmniourgia geojson pinaka me ta katasthmata apo th vash.
{
    $sales[] = $row;
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
        const shops = <?php echo json_encode($shops_array); ?>;
        const sales = <?php echo json_encode($sales); ?>;
        
        var marker,lat,long;

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
            marker.bindPopup('<h2>'+ feature.properties.name + " " + feature.properties.id +'</h2>');
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
            marker.bindPopup('<h2>'+ feature.properties.name + " " + feature.properties.shop_id +'</h2>'+'<p id="demo"></p>' + '<button onclick="checkSale();">Rate sales</button>').setIcon(handColorIcon("red"));
            }
        });

        salesLayer.addTo(map);

        map.on("click", function(e){ //Se click sto xarth vriskontai ta magazia poy einai entos 150 metrwn apo to click
            if (marker) map.removeLayer(marker);
            lat = e.latlng.lat;
            lng = e.latlng.lng;
            marker = L.marker([lat, lng]).addTo(map);
            shopswithin();
        });

        salesLayer.on('popupopen', function(e) { //Otan anoigei to popup enos marker tote emfanise ta sales
            var marker = e.popup._source;
            showSales(marker.feature.properties.shop_id);
        });

        function addSale() //Sinartiseis gia ta koympia poy vriskontai entos twn popup
        {
            window.open("new_sales.php");
        }

        function checkSale()
        {
            window.open("sales_admin.php");
        }

        function shopswithin() //Sinartisi poy vriskei ta magazia entos 150 metrwn
        {
            var mark;
            for(var i = 0; i < shops.length; i++)
            {
                distance = getDistanceFromLatLonInKm(shops[i].lat, shops[i].lon, lat, lng);
                if(distance <= 150)
                {
                    mark = L.marker([shops[i].lat, shops[i].lon]);
                    mark.addTo(map).bindPopup('<h2>'+ shops[i].name + " " + shops[i].id +'</h2>'+'<p id="demo"></p>'+'<button onclick="addSale();">New sale</button>' + '<button onclick="checkSale();">Rate sales</button>').setIcon(handColorIcon("green"));
                }
            }
        }
        
        function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) //Sinartisi poy ypologizei apostash dyo shmeiwn sto xarth
        {
            var R = 6371; 
            var dLat = deg2rad(lat2-lat1);  
            var dLon = deg2rad(lon2-lon1); 
            var a = 
                Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
                Math.sin(dLon/2) * Math.sin(dLon/2)
                ; 
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            var d = R * c * 1000; 
            return d.toFixed(2);
        }

        function deg2rad(deg) 
        {
            return deg * (Math.PI/180)
        }

        function showSales(id) //Sinartisi poy vriskei vasei toy shop id ta sales sto katasthma kai ta emfanizei sto popup 
        {
            var values = new Array();
            for(var i = 0; i < sales.length; i++)
            {
                if(sales[i].shop_id == id && sales[i].active == 1)
                {
                    if(sales[i].stock == 1)
                    {
                        values.push("Price: "+ sales[i].price +" Date submitted: "+sales[i].date+" Likes: "+ sales[i].likes+" Dislikes: "+sales[i].dislikes+" Stock: Yes" );
                    }
                    else
                    {
                        values.push("Price: "+ sales[i].price +" Date submitted: "+sales[i].date+" Likes: "+ sales[i].likes+" Dislikes: "+sales[i].dislikes+" Stock: No" );
                    }
                }
            }

            document.getElementById('demo').innerHTML = values.join("<br>");
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