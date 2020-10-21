<?php 

session_start();
session_unset();
session_destroy();

header("location: ../SKATEHUBBA/spots-main.php"); //Login currently stuck here
exit();