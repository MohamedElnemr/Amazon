<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        .tabbable-custom > .nav-tabs > li{
            margin-right: 0!important;
            width: 25%;
        }
        .buildingEventimg{
            width: 18%!important;
        }
        .buildingEventimgTd{
            width: 30%;
        }
    </style>
</head>
<body>
    <div class="row" style="width: 600px; height:200px">
        <div class="col-xs-12" style="padding: 0 30px" >
            <div id="MapDiv1"></div>
        </div>
    </div>
</body>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6yohSe89WiHJXhZCUA6wSNQnCEzySQVc"></script>
<script>
    var map;
    var marker;
    var infowindow;
    var position;
    function initialize() {
            var mapOptions = {
                zoom: 16,
                center: {lat: 30.1107644, lng:31.2968381 }
            };

    position={lat: 30.1107644, lng: 31.2968381};
    map = new google.maps.Map(document.getElementById('MapDiv1'), mapOptions);

    marker = new google.maps.Marker({
        draggable: true,
        map: map
    });
    infowindow = new google.maps.InfoWindow({
    });


    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });

    function placeMarker(location)
    {
        marker.setPosition(location);
    }
    google.maps.event.addListener(marker, 'dragend', function() {

    });
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
    var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };

    infowindow.setPosition(pos);
    marker.setPosition(pos);
    map.setCenter(pos);
    }, function() {
    handleLocationError(true, infowindow, map.getCenter());
    });
    } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infowindow, map.getCenter());
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infowindow.setPosition(position);
    marker.setPosition(position);
    map.setCenter(position);
    infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
    }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('bc8db81f9d03c8447cd1', {
cluster: 'mt1'
});
$auth = '{{ auth()->user()->id ?? "" }}'
var channel1 = pusher.subscribe('driver_1');

channel1.bind('newOrder', function(data) {

});

</script>
</html>



