<?php 
    require('inc/config.php');
    session_start();

    $user_id = $_SESSION['user_id'];

    if(filter_has_var(INPUT_POST, 'photoSubmit')){ //checking for form submission

        $_query = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = mysqli_query($connection, $_query) or die("Bad query: $_query");
        $row = mysqli_fetch_array($result);

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
                        $fileDestination = 'images/profile_img/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination); //moves file from temp storage to new location
                        //SOME IMG ARE NOT BEING TRANSEFERRED TO IMG FOLDER/DB
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

        if(!$row['img']){
            $qry = "UPDATE users SET img='$fileNameNew' WHERE user_id=$_SESSION[user_id]";
        }

        }

        $_result = mysqli_query($connection, $qry) or die("Bad query: $qry");

        //Block 6
        $alert = 'You have added a profile photo successfully';

        echo "<script type='text/javascript'>alert($alert);</script>";
        //want to create an alert once the photo has been added

        //Block 7
        mysqli_close($connection);

        header('Location: profile.php?profilePhoto=success'); 