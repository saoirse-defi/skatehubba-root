<?php 
    if(isset($_POST['upload'])){
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
                if($fileSize < 10000000){ //limiting upload size to 10Mb
                    $fileNameNew = "profile.".$user_id.'.'.$fileActualExt; //creating unique file name(needs work)
                    $fileDestination = 'images/uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination); //moves file from temp storage to new location
                    header("Location: index.php?upload=success");
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
?> 