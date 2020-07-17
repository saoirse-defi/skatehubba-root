<?php 
    require('inc/config.php');
?>

<?php
    if(filter_has_var(INPUT_POST, 'submit')){

     $fname = htmlspecialchars($_POST['fname']);
     $lname = htmlspecialchars($_POST['lname']);
     $email = htmlspecialchars($_POST['email']);
     $pword = htmlspecialchars($_POST['pword']);
     $_pword = htmlspecialchars($_POST['_pword']);
     $age = $_POST['age'];
     $style = htmlspecialchars($_POST['style']);
     $trick = htmlspecialchars($_POST['trick']);
     $eth = $_POST['eth'];

     $qry = "INSERT INTO 
     users (first_name, last_name, email, _password, age, style, trick, eth_address)
     VALUES ('$fname', '$lname', '$email', '$pword', '$age', '$style', '$trick', '$eth')";
    }
    
    mysqli_connect($connection, $qry);

    $query = "SELECT * FROM users WHERE first_name='$fname' AND last_name='$lname' AND email='$email'";
    
    $result = mysqli_connect($connection, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $userId = $row['id'];
            $query = "INSERT INTO profile_image (user_id, status) VALUES ('$userId', 1)";
            header("Location: index.php?signup=success");
        }
    } else{
        echo "You have an error!";
    }
?>