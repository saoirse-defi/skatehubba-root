<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
?>

<?php
    include_once('inc/header.php');
    //checks for session variable (user_id) in order to pull date from the users table
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
                        echo "<img src='images/profile_img/".$row['img']."' >"; //if no profile photo, it requests one. Else pulls profile photo from db
                    else{
                        echo "<form action='add-photo.inc.php' method='POST' enctype='multipart/form-data'>
                                <input type='file' name='file'><br>
                                <button type='submit' name='photoSubmit' class='btn btn-primary'>Submit a Profile Photo here!</button>
                            </form>";
                    }?>
        </div>

        <div id='profile-details'>
            <h4>Name: <?php echo $row['first_name']?> <?php echo $row['last_name']?></h4> 
            <h4>Skate style: <?php if($row['style']){echo $row['style'];}else{echo 'No style selected';} ?></h4>
            <h4>Skill level: <?php if($row['lvl']){echo $row['lvl'];}else{echo 'No skill level selected';} ?></h4>
            <h4>Member since: <?php echo $row['date_created'] ?></h4>
            <h4>Bio: <?php if($row['bio']){echo $row['bio'];}else{echo 'No Bio written';} ?></h4><br> 
        </div>

        <div id='profile-spots'>
            <h4>Spots created: </h4> 
            <?php //pulls a list of spots created by the user
                $_sql = "SELECT * FROM spots WHERE user_id='$ID'";
                $_result = mysqli_query($connection, $_sql) or die("Bad query: $_sql");
                
                if(mysqli_num_rows($_result) > 0){
                    while($_row = mysqli_fetch_assoc($_result)){
                        echo "<a href='spot-details.php?ID={$_row['spot_id']}'>{$_row['date_created']} - {$_row['nickname']}</a> <br>\n";
                    }
                }else{
                    echo "<h3>No spots to display</h3>";
                }
        ?></div>

        <div id='profile-ads'>
            <h4>Ads placed: </h4> 
            <?php //pulls a list of spots created by the user
                $_sql = "SELECT * FROM ads WHERE user_id='$ID'";
                $_result = mysqli_query($connection, $_sql) or die("Bad query: $_sql");
                
                if(mysqli_num_rows($_result) > 0){
                    while($_row = mysqli_fetch_assoc($_result)){
                        echo "<a href='ad_listing.php?ID={$_row['ad_id']}'>{$_row['time_created']} - {$_row['title']}</a> <br>\n";
                    }
                }else{
                    echo "<h3>No ads have been placed yet.</h3>";
                }
        ?></div>
    </div>
</div>

<?php include('inc/footer.php'); ?>