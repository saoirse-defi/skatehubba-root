<?php 
    require('inc/config.php');
    include_once('inc/header.php');
?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <form action="signup.inc.php" method="post">
            <input type="text" name="fname" placeholder="First Name..."><br>
            <input type="text" name="lname" placeholder="Last Name..."><br>
            <input type="text" name="email" placeholder="Email..."><br>
            <input type="text" name="uid" placeholder="Username..."><br>
            <input type="password" name="pwd" placeholder="Password..."><br>
            <input type="password" name="pwdrepeat" placeholder="Repeat Password..."><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    
    <?php

    if(isset($_GET["error"])){    //outputing error messages to the user
        if($_GET["error"] == "emptyInput"){
            echo "<p>One of the fields was empty, please try again.</p>";
        }
        else if($_GET["error"] == "invalidUid"){
            echo "<p>Please choose a proper username.</p>";
        }
        else if($_GET["error"] == "invalidEmail"){
            echo "<p>Please use a proper email</p>";
        }
        else if($_GET["error"] == "passwordsDontMatch"){
            echo "<p>Unfortunately your passwords didn't match, please try again.</p>";
        }
        else if($_GET["error"] == "usernameTaken"){
            echo "<p>Unfortunately your username OR email address was already used, please try again.</p>";
        }
        else if($_GET["error"] == "stmtFailed"){
            echo "<p>Unfortunately something went wrong, please try again.</p>";
        }
        else if($_GET["error"] == "none"){
            echo "<p>You have signed up successfully.</p>";
        }
    }

    //previous iteration's code
    
    /* if(filter_has_var(INPUT_POST, 'submit')){

     $fname = htmlspecialchars($_POST['fname']);
     $lname = htmlspecialchars($_POST['lname']);
     $email = htmlspecialchars($_POST['email']);
     $uid = htmlspecialchars($_POST['uid']);
     $pword = htmlspecialchars($_POST['pwd']);
     $_pword = htmlspecialchars($_POST['pwdrepeat']);

     $qry = "INSERT INTO 
     users (first_name, last_name, email, _password, username)
     VALUES ('$fname', '$lname', '$email', '$pword', '$uid')";
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
    } */
?>
    </section>


<?php 
    include_once('inc/footer.php');
?>