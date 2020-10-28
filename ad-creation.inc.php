<?php 
    require('inc/config.php'); 
    require('inc/functions.php');
    session_start();
?>

<?php
    if(filter_has_var(INPUT_POST, 'submit-ad')){
        $title = htmlspecialchars($_POST['title']);
        $desc = htmlspecialchars($_POST['description']);
        $contact = htmlspecialchars($_POST['contact']);
        $price = htmlspecialchars($_POST['price']);
        $county = htmlspecialchars($_POST['county']);
        $date = date('Y-m-d H:i:s');

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
          }else{
            $user_id = 0 ;
          }

        if(isset($_FILES['ad-photo'])){ // checking if file was submitted during form post
            $file = $_FILES['ad-photo'];
            $fileName = $_FILES['ad-photo']['name'];
            $fileType = $_FILES['ad-photo']['type'];
            $fileTmpName = $_FILES['ad-photo']['tmp_name'];
            $fileError = $_FILES['ad-photo']['error'];
            $fileSize = $_FILES['ad-photo']['size'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){ //check if the upload's file type is allowed
                if($fileError === 0){ //checking for upload error
                    if($fileSize < 10000000){ //limiting upload size to 10mb
                        $fileNameNew = time().'.'.$fileActualExt; //creating unique file name(needs work)
                        $fileDestination = 'images/ad_img/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination); //moves file from temp storage to new location
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

        placeAd($connection, $title, $price, $county, $desc, $date, $fileNameNew, $contact, $user_id);
    
        }else{
            header('Location: marketplace.php?adCreation=failure');
            exit();
        }

        
?>

