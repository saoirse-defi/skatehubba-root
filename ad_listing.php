<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
?>

<?php include('inc/header.php'); ?>

<?php 
    if(isset($_GET['ID'])){
        $ID = mysqli_real_escape_string($connection, $_GET['ID']);

        $sql = "SELECT * FROM ads WHERE ad_id='$ID'";
        $_result = mysqli_query($connection, $sql) or die("Bad query: $sql");
        $row = mysqli_fetch_array($_result);

        
    }else{
        header("Location: marketplace.php?connect=failed");
    }
?>

<div id='content'>
    <content> 
        <h2><u>Ad Title:</u><br/>  <?php echo $row['title']?></h2> 
        <h2><u>Price:</u><br/>  <?php echo $row['price']?></h2>
        <h4><u>Item Desription:</u><br/>  <?php echo $row['descript']?></h4>
        <h4><u> Created on:</u><br/> <?php echo $row['time_created']?></h4>
        <h4><u>Contact:</u><br/> <?php echo $row['contact']?></h4>
        <h4><u>Location:</u><br/> <?php echo $row['county']?></h4>
    </content>
</div>

<div id='sidebar'>
        <img src='<?php echo 'images/ad_img/'.$row['img']?>' id='main-ad-img' > 
</div>

<?php include('inc/footer.php'); ?>