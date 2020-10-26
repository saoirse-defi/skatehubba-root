<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
?>

<?php
    include_once('inc/header.php');

    if(isset($_SESSION['user_id'])){
        $ID = mysqli_real_escape_string($connection, $_SESSION['user_id']);
        $sql = "SELECT * FROM users WHERE user_id='$ID'";
        $result = mysqli_query($connection, $sql) or die("Bad query: $sql");
        $row = mysqli_fetch_array($result);
    }else{
        header("Location: spots-main.php?connect=failed");
    }

?>

<div id='container'>
    <div class='spot-group' id='profile'>
        <h1><?php echo $_SESSION['username']?>'s profile</h1>

        <div id='photo'>
            <?php if($row['img'])
                        echo "<img src='images/profile_img/".$row['img']."' >";
                    else{
                        echo "<form action='add-photo.inc.php' method='POST' enctype='multipart/form-data'>
                                <input type='file' name='file'><br>
                                <button type='submit' name='photoSubmit' class='btn btn-primary'>Submit a Profile Photo here!</button>
                            </form>";
                    }?>
        </div>

        <h4>Name: <?php echo $row['first_name']?> <?php echo $row['last_name']?></h4>
        <h4>Skate style: <?php echo $row['style'] ?></h4>
        <h4>Skill level: <?php echo $row['lvl'] ?></h4>
        <h4>Member since: <?php echo $row['date_created'] ?></h4>
        <h4>Bio: <?php echo $row['bio'] ?></h4>
    </div>
</div>

<?php include('inc/footer.php'); ?>