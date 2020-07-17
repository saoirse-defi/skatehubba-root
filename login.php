<?php 
    session_start();

    if(isset($_POST['loginbtn'])){
        $_SESSION['id'] = 1;
        header("Location: index.php");
    }
?>