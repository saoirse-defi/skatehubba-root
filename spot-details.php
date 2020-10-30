<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
    session_start();
    $user_id = $_SESSION['user_id'];
?>

<?php include('inc/header.php'); ?>

<?php 
    if(isset($_GET['ID'])){
        $ID = mysqli_real_escape_string($connection, $_GET['ID']);
        $_SESSION['spot_id'] = $ID;
        $sql = "SELECT * FROM spots WHERE spot_id='$ID'";
        $_result = mysqli_query($connection, $sql) or die("Bad query: $sql");
        $row = mysqli_fetch_array($_result);

        
    }else{
        header("Location: spots-main.php?connect=failed");
    }
?>

<div id='container'>
    <div class="spot-group" id="spot-details">
        <content> 
        <h2>Spot Name: <?php echo $row['nickname']?></h2> 
        <h4>Difficulty: <?php echo $row['difficulty']?></h4>
        <h4>Notes: <?php echo $row['comments']?></h4>
        <img src='<?php echo 'images/spot_img/'.$row['img']?>' alt='spot-img' id='main-img' > 
    </content></div>
        <br>

    <h3>Comment section:</h3><br>
    <?php 
        if(isset($_SESSION['user_id'])){
            echo "<div class='spot-group' id='spot-comments'>
                    <form action='spot-comments.inc.php' method='POST'>
                        <label>Add a photo here: </label><br>
                        <input type='text' name='comment' class='spot-control' placeholder='Leave a comment here' required><br><br>
                        <input type='hidden' name='spot_id' id='spot_id' value='<?php echo $ID ?>'>
                        <button type='submit' class='btn btn-primary' name='comment-submit'>Add comment to thread</button>
                    </form>
                </div><br>";}
        else{
            echo "<h2>Please sign up in order to be able to commment.</h2";
        }
    ?>
 
    <div class="spot-group" id="comment-thread">
        <?php 
            $result = "SELECT spot_comments.time_added, spot_comments.comment, users.username from users JOIN spot_comments ON users.user_id = spot_comments.user_id";
            $result_ = mysqli_query($connection, $result) or die("Bad query: $result");

            if(mysqli_num_rows($result_) > 0){
                while($_row = mysqli_fetch_assoc($result_)){
                    echo "<div id='comment'>{$_row['username']}</br>{$_row['time_added']}<br>{$_row['comment']}</div>";
                    // ID will the separator for the spot-details page
                }
            }else{
                echo "<h4>No comments to display</h4>";
            }
        ?>
    </div>
</div>

<?php include('inc/footer.php'); ?>