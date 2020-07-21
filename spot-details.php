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
    <div class="spot-group" id="spot-details">
        <content> 
        <h2>Spot Name: <?php echo $row['nickname']?></h2> 
        <h4>Difficulty: <?php echo $row['difficulty']?></h4>
        <h4>Notes: <?php echo $row['comments']?></h4>
        <img src='<?php echo 'images/spot_img/'.$row['img']?>' id='main-img' > 
    </content></div>
    	<br>
    <div class="spot-group" id="spot-comments">
        <form action='spot-comments.php' method='POST'>
            <label>Name: </label>
            <input type='text' name='name' class="spot-control" required><br>
            <label>Email: </label>
            <input type="text" name="email" class="spot-control" required><br>
            <label>Add a photo here: </label><br>
            <input type="file" name="comment-img"><br>
            <input type="text" name="comment" class="spot-control" placeholder="Leave a comment here" required><br>
            <input type="hidden" name="spot_id" id="spot_id" value="<?php echo $ID ?>">
            <button type="submit" class="btn btn-primary" name="comment-submit">Add comment to thread</button>
        </form>
    </div>
</div>

<?php include('inc/footer.php'); ?>