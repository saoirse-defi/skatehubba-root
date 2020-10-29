<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    $result = "SELECT * FROM ads ORDER BY time_created DESC";
    $_result = mysqli_query($connection, $result) or die("Bad query: $result");
    include('inc/header.php');
?>

<div class='container-fluid'>
       <div class=row>
           <div class='column'>
               <?php 
                    if(mysqli_num_rows($_result) > 0){
                        while($row = mysqli_fetch_assoc($_result)){
                            echo "
                            <div class='container' id='ad-listing'>
                            <a href='ad_listing.php?ID={$row['ad_id']}'>
                            <img src='images/ad_img/{$row['img']}' alt='market-img' style='width:80%;'/>
                            </a>
                            <div id='sidebar'>
                            <h4>Asking Price: {$row['price']}</h4></br>
                            <h4>Status: {$row['ad_status']}</h4></br>
                            <h4>Location: {$row['county']}</h4>
                            </div></div>"; //trying to write the asking price within the photo link
                        }
                    }
               ?>
           </div>
        </div>
    </div>

<?php 
    include('inc/footer.php');
?>