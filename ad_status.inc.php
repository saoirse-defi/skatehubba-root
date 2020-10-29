<?php

    require('inc/config.php'); 
    require('inc/functions.php');
    session_start();

    $ad_status_id = $_COOKIE['ad_status_id'];

    if(filter_has_var(INPUT_POST, 'status')){
        $status = 'sold';

        $qry = "UPDATE ads SET ad_status='$status' WHERE ad_id=$ad_status_id";
    }

    $_result = mysqli_query($connection, $qry) or die("Bad query: $qry");

    mysqli_close($connection);

    header('Location: marketplace.php?ad_status=sold');

    //need to pull ad_id from ad-listing

    //if session user_id matches, present button to mark as sold.