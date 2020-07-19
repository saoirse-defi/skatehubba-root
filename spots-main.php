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
          zoom: 6.5
        });

        setMarkers(map, spots);
    }

    

    function setMarkers(map, spots){

      for(let i = 0; i < spots.length; i++){

            let spot = spots[i];
            let latLng = new google.maps.LatLng(spot[7], spot[8]);
            //let contentString = `<a href="spot-details.php?ID=${spot[0]}">Click here for the details</a>`
            let contentString = '<div id="info-content">' + spot[5] + '<br>' + 
                                'Notes: ' + spot[4] + '<br>' + 
                                `<a href="spot-details.php?ID=${spot[0]}">Click here for the details</a>` + '<br>' +'</div>';

            let marker = new google.maps.Marker({
                position: latLng, //positions for lat lng in spots table sql
                map: map,
                title: spot[5],
                description: spot[4]
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