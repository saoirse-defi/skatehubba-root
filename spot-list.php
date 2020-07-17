<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    $result = "SELECT * FROM spots";
    $_result = mysqli_query($connection, $result) or die("Bad query: $result");
?>

<?php include('inc/header.php'); ?>

<div id='container'>
   <br><h1 style='text-decoration:underline'>List of Skate Spots</h1><br>
   <div id='content'>
        <?php //creates a dynamic list of links for each skate spot in the db
            if(mysqli_num_rows($_result) > 0){
                while($_row = mysqli_fetch_assoc($_result)){
                    echo "<a href='spot-details.php?ID={$_row['spot_id']}'>{$_row['nickname']}</a> <br>\n";
                    // ID will the separator for the spot-details page
                }
            }else{
                echo "<h3>No spots to display</h3>";
            }
        ?>
   </div>
</div>

<br>

<?php include('inc/footer.php'); ?>