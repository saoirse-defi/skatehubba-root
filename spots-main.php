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
let marker = [];
let infowindow;
let contentString;
let spots = <?php getSpots() ?>;  //creates an nested array of spots, pulled from db



  function initMap() {
        
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 53.211098, lng: -7.704839},
          zoom: 6.5
        });

      

       for(let i = 0; i < spots.length; i++){
            marker.push(new google.maps.Marker({
                position: new google.maps.LatLng(spots[i][7], spots[i][8]), //positions for lat lng in spots table sql
                map: map
            }))

            
            contentString =
              `<a href="spot-details.php?ID=${spots[i][0]}">Click here for the details</a>`;
              

            infowindow = new google.maps.InfoWindow({
                              content: contentString,
                              position: new google.maps.LatLng(spots[i][7], spots[i][8])  });

                              marker[i].addListener("click", function() {
                                infowindow.open(map, marker[i]); });

          //code above needs work: currently only opening info window for the latest spot added
          //progress report: info windows open on the right location but content is still of the last spot created
       }
    } 

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSsXvK34L12o6lfUehdRfATPzZhmzVidw&libraries=places&callback=initMap" async defer></script>     

<?php include('inc/footer.php'); ?>