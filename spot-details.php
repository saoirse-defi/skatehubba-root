<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
?>

<?php include('inc/header.php'); ?>

<?php 
    if(isset($_GET['ID'])){
        $ID = mysqli_real_escape_string($connection, $_GET['ID']);

        $sql = "SELECT * FROM spots WHERE spot_id='$ID'";
        $_result = mysqli_query($connection, $sql) or die("Bad query: $sql");
        $row = mysqli_fetch_array($_result);

        
    }else{
        header("Location: spots-main.php?connect=failed");
    }
?>

<div id='container'>
    <content> 
        <h2>Spot Name: <?php echo $row['nickname']?></h2> 
        <h4>Difficulty: <?php echo $row['difficulty']?></h4>
        <h4>Notes: <?php echo $row['comments']?></h4>
        <img src='<?php echo 'images/spot_img/'.$row['img']?>' id='main-img' > 
    </content>
</div>

<?php include('inc/footer.php'); ?>