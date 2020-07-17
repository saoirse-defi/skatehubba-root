<?php
define('ROOT_URL', "http://localhost/php_sandbox/index.php");
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "4204206969");
define('DB_NAME', "skatehubba");

//Block 3
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();

  }else{
    mysqli_select_db($connection, DB_NAME);
  }
?>