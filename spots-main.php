<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    $result = "SELECT * FROM spots";
    $_result = mysqli_query($connection, $result) or die("Bad query: $result");
?>

<?php include('inc/header.php'); ?>

<div id='map' style="width:100%;height:600px;"></div>

<script>
let map;
let markers = [];
let contentString ;
let spots = <?php getSpots() ?>;  //creates an nested array of spots, pulled from db



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

        setMarkers(map, spots);
    }

    

    function setMarkers(map, spots){

      for(let i = 0; i < spots.length; i++){

            let spot = spots[i];
            let latLng = new google.maps.LatLng(spot[7], spot[8]);
            //let contentString = `<a href="spot-details.php?ID=${spot[0]}">Click here for the details</a>`
            let contentString = '<div id="info-content"><b><u>' + spot[5] + '</u></b><br>' + 
                                'Type: ' + spot[3] + '<br>' + 
                                `<a href="spot-details.php?ID=${spot[0]}">Click here for more details</a>` + '<br>' +'</div>';

            let marker = new google.maps.Marker({
                position: latLng, //positions for lat lng in spots table sql
                map: map,
                title: spot[5],
                description: spot[4],
                icon:'https://img.icons8.com/fluent/48/000000/marker-storm.png'
            });

            let infowindow = new google.maps.InfoWindow(
                {content: contentString}
            );

            
            google.maps.event.addListener(marker, 'click', (function(marker, contentString){
              return function(){
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
              }
            })(marker, contentString));
            
            
       }
    } 

    google.maps.event.addDomListener(window, 'load', initMap);

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSsXvK34L12o6lfUehdRfATPzZhmzVidw&libraries=places&callback=initMap" async defer></script>     

<?php include('inc/footer.php'); ?>