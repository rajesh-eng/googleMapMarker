<?php
// Google map location array changes second time.
function get_map_locations()
{
	$html = ' ["Title 1", -31.563910, 147.154312],
	["Title 2", -33.718234, 150.363181],
	["Title 3", -33.727111, 150.371124],
	["Title 4", -33.848588, 151.209834],
	["Title 5", -33.851702, 151.216968],
	["Title 6", -34.671264, 150.863657],
	["Title 7", -35.304724, 148.662905]';

	return $html;
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<title>Marker Clustering</title>
	<style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
      	height: 400px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
      	height: 100%;
      	margin: 0;
      	padding: 0;
      }
  </style>
</head>
<body>
	<div id="map-canvas"></div>
	<button type="button" id="load_map">Load Map Using Ajax</button>
	<div class="search-list" id="search_info">
		<h4><span></span> Listings Found</h4>
		<div class="styled-select">
			<select>
				<option>Short: Featured</option>
				<option>Short: Featured 2</option>
				<option>Short: Featured 3</option>
			</select>
			<span class="fa fa-sort-desc"></span>
		</div>
		<div class="scrollbar" id="style-1">

			<ul class="" id="project_list">
				<?php
				for ($i=0; $i <=6 ; $i++) { ?>
					<li class="info-<?php echo  $i+1;?>">

						<div class="condos-info">
							<h3>Title Test <?php echo $i+1;?></h3>
							
						</div>
					</li>
				<?php }?>

			</ul>

			<div class="force-overflow"></div>
		</div>
	</div>
	<!-- <script>

		function initMap() {

			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 3,
				center: {lat: -28.024, lng: 140.887}
			});

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = locations.map(function(location, i) {
        	return new google.maps.Marker({
        		position: location,
        		label: labels[i % labels.length]
        	});
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
        	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
    var locations = [
    [lat: -31.563910, lng: 147.154312],
    {lat: -33.718234, lng: 150.363181},
    {lat: -33.727111, lng: 150.371124},
    {lat: -33.848588, lng: 151.209834},
    {lat: -33.851702, lng: 151.216968},
    {lat: -34.671264, lng: 150.863657},
    {lat: -35.304724, lng: 148.662905},
    {lat: -36.817685, lng: 175.699196},
    {lat: -36.828611, lng: 175.790222},
    {lat: -37.750000, lng: 145.116667},
    {lat: -37.759859, lng: 145.128708},
    {lat: -37.765015, lng: 145.133858},
    {lat: -37.770104, lng: 145.143299},
    {lat: -37.773700, lng: 145.145187},
    {lat: -37.774785, lng: 145.137978},
    {lat: -37.819616, lng: 144.968119},
    {lat: -38.330766, lng: 144.695692},
    {lat: -39.927193, lng: 175.053218},
    {lat: -41.330162, lng: 174.865694},
    {lat: -42.734358, lng: 147.439506},
    {lat: -42.734358, lng: 147.501315},
    {lat: -42.735258, lng: 147.438000},
    {lat: -43.999792, lng: 170.463352}
    ]
</script>
 Replace following script src
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js">
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCERQvjC_ok7_RGk2IlhqI9RFm0jys93nk&callback=initMap">
</script> -->


<style type="text/css">
	#map-canvas {
		width:100%;
		height:600px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js">
</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCERQvjC_ok7_RGk2IlhqI9RFm0jys93nk"></script>


<script>
// Keep references
var map,
markers = [];
// Our markers database (for testing)
var locations = [
<?php echo get_map_locations();?>
];



function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(-28.024, 140.887),
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};    

	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    // Adding our markers from our "big database"
    addMarkers();
    
    // Fired when the map becomes idle after panning or zooming.
    google.maps.event.addListener(map, 'idle', function() {
    	showVisibleMarkers();
    });
    var markerCluster = new MarkerClusterer(map, markers,
    	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}


function initialize2(locations) {
	var mapOptions = {
		center: new google.maps.LatLng(-28.024, 140.887),
		zoom: 5,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};    

	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    // Adding our markers from our "big database"
    addMarkers2(locations);
    
    // Fired when the map becomes idle after panning or zooming.
    google.maps.event.addListener(map, 'idle', function() {
    	showVisibleMarkers();
    });
    var markerCluster = new MarkerClusterer(map, markers,
    	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

function addMarkers() {
	for (var i = 0; i < locations.length; i++) {
		var beach = locations[i],
		myLatLng = new google.maps.LatLng(beach[1], beach[2]),
		marker = new google.maps.Marker({

			position: myLatLng,
			title: beach[0]
		});     
		marker.setMap(map); 

        // Keep marker instances in a global array
        markers.push(marker);
        
    }
}

function addMarkers2(locations) {
	for (var i = 0; i < locations.length; i++) {
		var beach = locations[i],
		myLatLng = new google.maps.LatLng(beach[1], beach[2]),
		marker = new google.maps.Marker({

			position: myLatLng,
			title: beach[0]
		});     
		marker.setMap(map); 

        // Keep marker instances in a global array
        markers.push(marker);
        
    }
}

function showVisibleMarkers() {
	var bounds = map.getBounds(),
	count = 0;

	for (var i = 0; i < markers.length; i++) {
		var marker = markers[i],
            infoPanel = $('.info-' + (i+1) ); // array indexes start at zero, but not our class names :)

            if(bounds.contains(marker.getPosition())===true) {
            	infoPanel.show();
            	count++;
            }
            else {
            	infoPanel.hide();
            }
        }

        $('#search_info h4 span').html(count);
    }

    google.maps.event.addDomListener(window, 'load', initialize);




    $(document).ready(function() {
    	$("#load_map").click(function(){
            //alert('Button Clicked');
            markers = [];
            var countlocation=0;
            var response_location='';
            $.ajax({
            	url: 'get_data.php',
            	type: "POST",
            	async: false,
            	cache: false,
            	data: {"action":"true"},
            	success: function (response) {
            		var response_value=response.trim();
            		console.log(response_value);
            		var valuedata=JSON.parse(response_value);
            		var value_location=valuedata.location;
            		for (var i = 0; i<value_location.length; i++) {
            			initialize2([[value_location[i].title,value_location[i].lattitude,value_location[i].longitude]]);
            		}
            		$('#project_list').html(valuedata.html);
            	}
            });
        });
    });
</script>
</body>
</html>


