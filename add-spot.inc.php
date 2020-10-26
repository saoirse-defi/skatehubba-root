<?php 
     require('inc/config.php');
     require_once('inc/functions.php');
     session_start();
?>

<?php 
      $lat = $_COOKIE["lat"]; //using cookies to track google map marker co-ordinates
      $lng = $_COOKIE["lng"];
    
     if(filter_has_var(INPUT_POST, 'submitSpot')){ //checking for form submission

        $nickname = htmlspecialchars($_POST['nickname']);
        $sstyle = htmlspecialchars($_POST['sstyle']);
        $stype = htmlspecialchars($_POST['stype']);
        $difficulty = htmlspecialchars($_POST['difficulty']);
        $comments = htmlspecialchars($_POST['comments']);
        $date = date("Y-m-d H:i:s"); //creating a timestamp for db record

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
          }else{
            $user_id = 0 ;
          }


        if(isset($_FILES['file'])){ // checking if file was submitted during form post
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileType = $_FILES['file']['type'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileError = $_FILES['file']['error'];
            $fileSize = $_FILES['file']['size'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){ //check if the upload's file type is allowed
                if($fileError === 0){ //checking for upload error
                    if($fileSize < 10000000){ //limiting upload size to 10mb
                        $fileNameNew = time().'.'.$fileActualExt; //creating unique file name(needs work)
                        $fileDestination = 'images/spot_img/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination); //moves file from temp storage to new location
                        //SOME IMG ARE NOT BEING TRANSEFERRED TO IMG FOLDER/DB : FIXED
                    }else{
                        echo "Your file is too big!";
                    }
                }else{
                    echo "There was an upload error!";
                }
            }else{
                echo "This file type is not allowed";
            }
        }

        addSpot($connection, $nickname, $sstyle, $stype, $difficulty, $comments, $date, $lat, $lng, $fileNameNew, $user_id);

        }else{
            header("location: ../SKATEHUBBA/skate-spot-2.php?error=spotCreationFailed");
            exit();
        }

        

       /* //Block 6
        $alert = 'You have added a skate spot successfully';

        echo "<script type='text/javascript'>alert($alert);</script>";
        //want to create an alert once spot is created

        //Block 7
        mysqli_close($connection);

        header('Location: spots-main.php?creation=success'); //page redirect to home */
?>