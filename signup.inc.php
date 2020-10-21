<?php

if(isset($_POST["submit"])){
    
    $fname = htmlspecialchars($_POST['fname']);
     $lname = htmlspecialchars($_POST['lname']);
     $email = htmlspecialchars($_POST['email']);
     $uid = htmlspecialchars($_POST['uid']);
     $pword = htmlspecialchars($_POST['pwd']);
     $_pword = htmlspecialchars($_POST['pwdrepeat']);
     $tstamp = date('Y-m-d H:i:s');

     require_once('inc/functions.php');

     //taking the POST values from the form and running values through error functions

     if(emptyInputSignup($fname, $lname, $email, $uid, $pword, $_pword) !== false){
        header("location: ../SKATEHUBBA/signup.php?error=emptyInput");
        exit();
     }
     if(invalidUid($uid) !== false){
        header("location: ../SKATEHUBBA/signup.php?error=invalidUid");
        exit();
     }
     if(invalidEmail($email) !== false){
        header("location: ../SKATEHUBBA/signup.php?error=invalidEmail");
        exit();
     }
     if(pwdMatch($pword, $_pword) !== false){
        header("location: ../SKATEHUBBA/signup.php?error=passwordsDontMatch");
        exit();
     }
     if(uidExists($connection, $uid, $email) !== false){
        header("location: ../SKATEHUBBA/signup.php?error=usernameTaken");
        exit();
     }
     /*if(pwdLength($pword, $_pword) !== false){
        header("location: ../signup.php?error=passwordsTooShort");
        exit(); //password length function for future implementation
     } */

     createUser($connection, $fname, $lname, $email, $pword, $tstamp, $uid);

}
else{
    header("location: ../SKATEHUBBA/signup.php");
    exit();
}