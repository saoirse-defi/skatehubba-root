<?php 
    require('inc/config.php');
    include_once('inc/functions.php');
?>

<?php
    include_once('inc/header.php');

    if(isset($))
?>

<div id='container'>
    <div class='spot-group' id='profile'>
        <h1><?php echo $_SESSION['username']?>'s profile</h1>
        <h3>This user's ID is <?php echo $_SESSION['user_id']?></h3>
    </div>
</div>