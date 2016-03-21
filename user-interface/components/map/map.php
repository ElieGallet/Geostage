<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/init.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/PIFE/business-logic/includes/auth-student.php');?>

<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Map</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.4/mapbox.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />

<style>
  body {margin: 0; padding: 0;}
  #map {width: 100%;}
</style>
</head>
<body>

<style>
    #sections {
        position: absolute;
        top: 0;
        right: 0;
        background: #fff;
        border-style: solid;
        border-width: 1px;
        padding: 5px;
    }
</style>
<div id="map-wrapper"></div>

<form id='sections'>
    <input id='search' class='search-ui' placeholder=' rechercher...' style='margin-bottom: 10px;'/>
  <div><input type="checkbox" id="checkAll" checked/> Toutes les thématiques </div>
  
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='DS' checked> Déficience Sensorielle</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='O' checked> Oncologie</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='DP' checked> Déficience Physiologique</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='DM' checked> Déficience Motrice</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='V' checked> Vieillisement</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='DC' checked> Déficience Comportementale</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='AIS' checked> AIS</div>
  <div><input class="theme" type='checkbox' name='filters' onclick='showStations();' value='OTHER' checked> Autre</div>
  <br>
  <div><input type="checkbox" id="checkAll2" checked/> Tous les niveaux </div>
  <script>
   $("#checkAll2").change(function () {
        $(".level").prop('checked', $(this).prop("checked"));
        showStations();
    });
  </script>
  <div><input class="level" type='checkbox' name='filters2' onclick='showStations();' value='L2' checked> L2</div>
  <div><input class="level" type='checkbox' name='filters2' onclick='showStations();' value='L3' checked> L3</div>
  <div><input class="level" type='checkbox' name='filters2' onclick='showStations();' value='M1' checked> M1</div>
  <div><input class="level" type='checkbox' name='filters2' onclick='showStations();' value='M2' checked> M2</div>
  <div><input class="level" type='checkbox' name='filters2' onclick='showStations();' value='OTHER' checked> Autre</div>
  <br>
  <span id="filt_NumberMarkers"></span>
</form>
<script type="text/javascript">
  $('#map-wrapper').append('<div style="height:' + window.screen.availHeight*0.7 + 'px;" id="map"></div>'); //trick to size the map dynamically before tiles load
</script>
<script>
   $("#checkAll").change(function () {
        $(".theme").prop('checked', $(this).prop("checked"));
        showStations();
    });
</script> 
<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiZWxpZWdhbGxldCIsImEiOiJjaWp3djNpcTUwMDFjdmNtMDJzZDN4OXB2In0.GqoTIMU3db9tZJMifXr9-g';
// Here we don't use the second argument to map, since that would automatically
// load in non-clustered markers from the layer. Instead we add just the
// backing tileLayer, and then use the featureLayer only for its data.


var map = L.mapbox.map('map')
    .setView([43.6109200, 3.8772300], 5)
    .addLayer(L.mapbox.tileLayer('mapbox.streets'));
    

var overlays = L.layerGroup().addTo(map);

// we create the 'layers' variable outside of the on('ready' callback
// so that it can be accessible in the showStations function. Otherwise,
// JavaScript scope would prevent you from accessing it.
var layers;

// Since featureLayer is an asynchronous method, we use the `.on('ready'`
// call to only use its marker data once we know it is actually loaded.
L.mapbox.featureLayer()
    .loadURL('/PIFE/data-access/json/map.geojson')
    .on('ready', function(e) {
        layers = e.target;
        showStations();
    });

$('#search').keyup(showStations);

var filters = document.getElementById('sections').filters;
var filters2 = document.getElementById('sections').filters2;

// There are many ways to filter data. Mapbox.js has the .setFilter method,
// but it only applies to L.mapbox.featureLayer layers, and that isn't what
// we're creating - we're making marker groups in a MarkerClusterGroup layer.
// Thus we distill filtering down to its essential part: an 'if' statement
// in a loop.
function showStations() {

    numberMarkers = 0;
    // first collect all of the checked boxes and create an array of strings
    // like ['green', 'blue']
    var searchString = $('#search').val().toLowerCase();

    var list = [];
    for (var i = 0; i < filters.length; i++) {
        if(filters[i].checked) list.push(filters[i].value);
    }

    var list2 = [];
    for (var i = 0; i < filters2.length; i++) {
        if(filters2[i].checked) list2.push(filters2[i].value);
    }
    // then remove any previously-displayed marker groups
    overlays.clearLayers();
    // create a new marker group
    var clusterGroup = new L.MarkerClusterGroup().addTo(overlays);
    // and add any markers that fit the filtered criteria to that group.
    layers.eachLayer(function(layer) {
        if(list.indexOf(layer.feature.properties.sector) !== -1 
        && list2.indexOf(layer.feature.properties.level) !== -1 
        && layer.feature.properties.name.toLowerCase().indexOf(searchString) !== -1) {
            clusterGroup.addLayer(layer);
          var popup = '<div>'
              + '<h5><b>'
              + layer.feature.properties.name
              + '</b></h5>'
              + layer.feature.properties.street + ' ' + layer.feature.properties.postal_code + ' ' + layer.feature.properties.city
              + '<br/></br><b>theme: </b>' + layer.feature.properties.sector
              + '<br/><b>niveau: </b>' + layer.feature.properties.level
              + '<br/><b>offres:</b>'
          ;

          for (var j = 0; j < layer.feature.properties.offers.length; j++) {
            popup = popup
              + '<br/><a href="/PIFE/data-access/offers/'
              + layer.feature.properties.id
              + '/'
              + layer.feature.properties.offers[j]
              + '" target="_blank">'+ layer.feature.properties.offers[j] + '</a>'
            ;
          }
          popup = popup + '</div>';

            layer.bindPopup(
              popup
            );
            numberMarkers++;
        }
    });

    // Affichage du nombre de markers
    if(numberMarkers == 0) {
        document.getElementById('filt_NumberMarkers').innerHTML = "Aucun lieu de stage trouvé";
    }
    else if(numberMarkers == 1) {
        document.getElementById('filt_NumberMarkers').innerHTML = "<span class=\"highlightNumber\">1</span> lieu de stage trouvé";
    } 
    else{
        document.getElementById('filt_NumberMarkers').innerHTML = "<span class=\"highlightNumber\">" + numberMarkers + "</span> lieux de stage trouvés";
    }
}
</script>
</body>
</html>