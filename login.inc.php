<?php

if(isset($_POST["submit"])){
    $username = $_POST["name"];
    $pwd = $_POST["pwd"];

    require_once('inc/functions.php');
    require_once('inc/config.php');

    if(emptyInputLogin($username, $pwd) !== false){
            header("location: ../SKATEHUBBA/login.php?error=emptyInput");
            exit();
    }

    loginUser($connection, $username, $pwd);
}
else{
    header("location: ../SKATEHUBBA/login.php");
        exit();
}