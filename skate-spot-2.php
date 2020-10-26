<?php 
    require('inc/config.php');
    include('inc/header.php');
    //session_start();
    /*if(isset($_SESSION['user_id'])){
      $creator_id = $_SESSION['user_id'];
    }else{
      $creator_id = null;
    }*/
?>

<div class="container">
    <h1>Add A Skate Spot To The Map Below</h1> <br>
    <h3>Click on the spot location to add details</h3><br>
    <div id="map" style="width:100%;height:600px;"></div>
</div>

<script>
        
//creates google map object and allows the user to create a marker
        function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 53.211098, lng: -7.704839},
          zoom: 6.5,
          styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ]
        });

        let markers = {};

        let getMarkerUniqueId = function(lat, lng){
            return lat + "_" + lng;
        };

        let getLatLng = function(lat, lng){
            return new google.maps.LatLng(lat, lng);
        };

        let addMarker = google.maps.event.addListener(map, 'click', function(e){
                let lat = e.latLng.lat();
                let lng = e.latLng.lng();
                document.cookie = "lat="+lat;
                document.cookie = "lng="+lng;
        //currently lat and lng is for the last marker created, not the one submitted.
        //Solution: only allow one marker to be placed at a time
            
            let markerId = getMarkerUniqueId(lat, lng);
            let marker = new google.maps.Marker({
                position : getLatLng(lat, lng),
                map : map,
                icon:'https://img.icons8.com/fluent/48/000000/marker-storm.png',
                animation: google.maps.Animation.DROP,
                id: 'marker '+ markerId,
                html: "<div class='container'>" + 
                    "<form action='add-spot.inc.php' method='POST' enctype='multipart/form-data'>" +
                    "<div class='spot-group'>" +
                        "<label>Spot's name/nickname:</label><br>"+
                        "<input type='text' name='nickname' class='spot-control' required></div>"+
                    "<div class='spot-group'>"+
                    "<label for='sstyle'>Choose skate style for this spot: </label>"+
                    "<select name='sstyle' id='sstyle'>"+
                        "<option value='street'>Street</option>"+
                        "<option value='vert'>Vert</option>"+
                        "<option value='downhill'>Downhill</option>"+
                        "<option value='dancing'>Dancing</option>"+
                        "<option value='freeride'>Freeride</option></select></div>"+
                    "<div class='spot-group'>"+
                    "<label for='stype'>Choose a skate spot category: </label>"+
                    "<select name='stype' id='stype'>"+
                        "<option value='street'>Street Spot</option>"+
                        "<option value='spark'>Skate Park</option>"+
                        "<option value='ipark'>Indoor Skate Park</option>"+
                        "<option value='hill'>Downhill Spot</option>"+
                        "<option value='stairs'>Stair Set</option>"+
                        "<option value='manny'>Manny Pad</option></select></div>"+
                    "<div class='spot-group'>"+
                    "<label for='difficulty'>Choose this skate spot's difficulty: </label>"+
                    "<select name='difficulty' id='difficulty'>"+
                        "<option value='novice'>Novice</option>"+
                        "<option value='beginner'>Beginner</option>"+
                        "<option value='intermediate'>Intermediate</option>"+
                        "<option value='advanced'>Advanced</option>"+
                        "<option value='pro'>Pro</option></select></div>"+
                    "<div class='spot-group'>"+
                    "<label>Comments:</label><br>"+
                    "<input type='text' name='comments' class='spot-control'><br><br>"+
                    "<label>You can add a photo of the spot here: </label>"+
                    "<input type='file' name='file' required>"+
                    "<button type='submit' name='submitSpot' class='btn btn-primary'>Add your skate spot!</button></form><br></div></div>"
                    
            });
            
            
            markers[markerId] = marker;
            bindMarkerEvents(marker);
            bindMarkerInfo(marker);
        });

        let bindMarkerEvents = function(marker){
            google.maps.event.addListener(marker, 'rightclick', function(point){
                let markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng());
                let marker = markers[markerId];
                removeMarker(marker, markerId);
            });
        };

        let removeMarker = function(marker, markerId){
            marker.setMap(null);
            delete markers[markerId];
        }

        let bindMarkerInfo = function(marker){
            google.maps.event.addListener(marker, 'click', function(point){
                let markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng.lng());
                let marker = markers[markerId];
                infowindow = new google.maps.InfoWindow();
                infowindow.setContent(marker.html);
                infowindow.open(map, marker);
            });
        };
        
      };

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSsXvK34L12o6lfUehdRfATPzZhmzVidw&libraries=places&callback=initMap" async defer></script>

        

<?php include('inc/footer.php'); ?>