<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    $result = "SELECT * FROM spots ORDER BY date_created DESC";
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
                            <a href='spot-details.php?ID={$row['spot_id']}'>
                            <img src='images/spot_img/{$row['img']}' alt='gallery-img'/>
                            </a>
                            ";
                        }
                    }
               ?>
           </div>
        </div>
    </div>

<?php 
    include('inc/footer.php');
?>