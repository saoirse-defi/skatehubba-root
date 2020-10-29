<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    session_start();

    if(isset($_GET['ID'])){
        $ID = mysqli_real_escape_string($connection, $_GET['ID']);

        $sql = "SELECT * FROM ads WHERE ad_id='$ID'";
        $_result = mysqli_query($connection, $sql) or die("Bad query: $sql");
        $row = mysqli_fetch_array($_result);

        $cookie_name = "ad_status_id";
        $cookie_value = $ID;

        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        
    }else{
        header("Location: marketplace.php?connect=failed");
    }
?>

<?php include('inc/header.php'); ?>

<div id='content'>
    <content> 
        <h2><u>Ad Title:</u><br/>  <?php echo $row['title']?></h2> 
        <h2><u>Price:</u><br/>  <?php echo $row['price']?></h2>
        <h4><u>Item Desription:</u><br/>  <?php echo $row['descript']?></h4>
        <h4><u> Created on:</u><br/> <?php echo $row['time_created']?></h4>
        <h4><u>Contact:</u><br/> <?php echo $row['contact']?></h4>
        <h4><u>Location:</u><br/> <?php echo $row['county']?></h4>
        <h4><u>Status:</u><br/> <?php echo $row['ad_status']?></h4>

        <?php if($_SESSION['user_id'] == $row['user_id']){
                        echo "<form method='POST' action='ad_status.inc.php'><button type='submit' name='status'>Mark as sold!</button></form>";} //if no profile photo, it requests one. Else pulls profile photo from db?>
    </content>
</div>

<div id='sidebar'>
        <img src='<?php echo 'images/ad_img/'.$row['img']?>' alt='ad-img' id='main-ad-img' > 
</div>

<?php include('inc/footer.php'); ?>