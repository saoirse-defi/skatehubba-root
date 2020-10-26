<?php 
    require('inc/config.php'); 
    include_once('inc/functions.php');
    session_start();
?>

<?php 
    if(filter_has_var(INPUT_POST, 'comment-submit')){
        $name = htmlspecialchars($_POST['uname']);
        $spot_id = htmlspecialchars($_POST['spot_id']);
        $email = htmlspecialchars($_POST['email']);
        $time = date('Y-m-d H:i:s');
        $comment = htmlspecialchars($_POST['comment']);
        
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
          }else{
            $user_id = 0 ;
          }

        /* if(isset($_FILES['comment-img'])){ // checking if file was submitted during form post
            $file = $_FILES['comment-img'];
            $fileName = $_FILES['comment-img']['name'];
            $fileType = $_FILES['comment-img']['type'];
            $fileTmpName = $_FILES['comment-img']['tmp_name'];
            $fileError = $_FILES['comment-img']['error'];
            $fileSize = $_FILES['comment-img']['size'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){ //check if the upload's file type is allowed
                if($fileError === 0){ //checking for upload error
                    if($fileSize < 10000000){ //limiting upload size to 10mb
                        $fileNameNew = time().'.'.$fileActualExt; //creating unique file name(needs work)
                        $fileDestination = 'images/comment_img/'.$fileNameNew;
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
        } */

        addComment($connection, $name, $spot_id, $email, $time, $comment, $user_id);
    }

    else{
        header("location: ../SKATEHUBBA/spot-list.php");
        exit();
    }
?>