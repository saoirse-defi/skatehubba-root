<?php 

require_once('inc/config.php');

    function addSpot($connection, $nickname, $sstyle, $stype, $difficulty, $comments, $date, $lat, $lng, $fileNameNew, $user_id){
        
        $query = "INSERT INTO spots (nickname, spot_style, spot_type, difficulty, comments, date_created, lat, lng, img, user_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($connection); //creating a prepared statement

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("location: ../SKATEHUBBA/add-spot.php?error=statmentFailed");
            exit();
           }

        mysqli_stmt_bind_param($stmt, 'ssssssssss', $nickname, $sstyle, $stype, $difficulty, $comments, $date, $lat, $lng, $fileNameNew, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
   
        header("location: ../SKATEHUBBA/spots-main.php?error=none");
        exit();
    }

    function placeAd($connection, $title, $price, $county, $desc, $date, $fileNameNew, $contact, $user_id, $status){
        
        $query = "INSERT INTO ads (title, price, county, descript, time_created, img, contact, user_id, ad_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($connection); //creating a prepared statement

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("location: ../SKATEHUBBA/ad-creation.php?error=statmentFailed");
            exit();
           }

        mysqli_stmt_bind_param($stmt, 'sssssssss', $title, $price, $county, $desc, $date, $fileNameNew, $contact, $user_id, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
   
        header("location: ../SKATEHUBBA/marketplace.php?adCreation=success");
        exit();
    }

    function addComment($connection, $spot_id, $time, $comment, $user_id){
        
        $query = "INSERT INTO spot_comments (spot_id, time_added, comment, user_id) 
        VALUES (?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($connection); //creating a prepared statement

        if(!mysqli_stmt_prepare($stmt, $query)){
            header("location: ../SKATEHUBBA/add-spot.php?error=statmentFailed");
            exit();
           }

        mysqli_stmt_bind_param($stmt, 'ssss', $spot_id, $time, $comment, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
   
        header("location: ../SKATEHUBBA/spots-main.php?error=none");
        exit();
    }



    function getSpots(){ //returns an array of the skate spots from the db 
      
      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

      $sql_spots = "SELECT * FROM spots";

      $query = mysqli_query($conn, $sql_spots);

      $result_check = mysqli_num_rows($query);

      $spots = array();

          while($r = mysqli_fetch_assoc($query)){
                $spots[] = $r;
          }
      
      $indexed = array_map('array_values', $spots);

      echo json_encode($indexed);

        if (!$spots) {
            return null;
        }
    }

    function emptyInputSignup($fname, $lname, $email, $uid, $pword, $_pword){
        //Error function: Checking for empty fields at signup
        $result;
        if(empty($fname) || empty($lname) || empty($email) || empty($uid) || empty($pword) || empty($_pword)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function invalidUid($uid){
        //Error function: Username is outside of parameters
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email){
        //Error function: Email is not valid
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pword, $_pword){
        //Error function: Passwords don't match
        $result;
        if($pword !== $_pword){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    function uidExists($connection, $uid, $email){
        //Checking if user exists and returning data set from the db
       $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
       $stmt = mysqli_stmt_init($connection); //creating a statement connection
       
       if(!mysqli_stmt_prepare($stmt, $sql)){ //creating a prepared statement
        header("location: ../SKATEHUBBA/signup.php?error=stmtFailed");
        exit();
       }

       mysqli_stmt_bind_param($stmt, 'ss', $uid, $email);
       mysqli_stmt_execute($stmt);

       $resultData = mysqli_stmt_get_result($stmt);

       if($row = mysqli_fetch_assoc($resultData)){
            return $row;
       }
       else{
           $result = false;
           return $result;
       }
       mysqli_stmt_close($stmt);
    }

    function createUser($connection, $fname, $lname, $email, $pword, $tstamp, $uid, $style, $lvl, $bio){
        //Creates user and inserts them into the db
        $sql = "INSERT INTO users (first_name, last_name, email, _password, date_created, username, style, lvl, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($connection); //creating a prepared statement
        
        if(!mysqli_stmt_prepare($stmt, $sql)){
         header("location: ../SKATEHUBBA/signup.php?error=statmentFailed");
         exit();
        }
 
        $hashedPwd = password_hash($pword, PASSWORD_DEFAULT); //securing passwords in the db

        mysqli_stmt_bind_param($stmt, 'sssssssss', $fname, $lname, $email, $hashedPwd, $tstamp, $uid, $style, $lvl, $bio);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../SKATEHUBBA/spots-main.php?error=none");
         exit();
     }

     function emptyInputLogin($username, $pwd){
         //Error function: Missing field at login
         $result;
         if(empty($username) || empty($pwd)){
             $result = true;
         }
         else{
             $result = false;
         }
         return $result;
     }

     function loginUser($connection, $uid, $pwd){
         //Checks for user using email/username and password
        $uidExists = uidExists($connection, $uid, $pwd);
        if($uidExists === false){
            header("location: ../SKATEHUBBA/login.php?error=wrongLogin");
            exit();
        }
        
        $pwdHashed = $uidExists["_password"];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if($checkPwd === false){
            header("location: ../SKATEHUBBA/login.php?error=wrongLogin1");
            exit();
        }
        else if($checkPwd === true){
            session_start();
            $_SESSION["user_id"] = $uidExists["user_id"]; //currently using db column name
            $_SESSION["username"] = $uidExists["username"];
            header("location: ../SKATEHUBBA/profile.php");
            exit();
        }
    }

   
