<?php 
    require('inc/config.php');
    include_once('inc/header.php');
?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <form action="signup.inc.php" method="post">
            <input type="text" name="fname" placeholder="First Name..." required><br>
            <input type="text" name="lname" placeholder="Last Name..." required><br>
            <input type="text" name="email" placeholder="Email..." required><br>
            <input type="text" name="uid" placeholder="Username..." required><br>
            <input type="password" name="pwd" placeholder="Password..."><br>
            <input type="password" name="pwdrepeat" placeholder="Repeat Password..."><br>
            What's your skating style?
            <select name='style' id='style'>
                        <option></option>
                        <option value='street'>Street</option>
                        <option value='vert'>Vert</option>
                        <option value='downhill'>Downhill</option>
                        <option value='freeride'>Freeride</option>
                        <option value='dancing'>Dancing</option>
            </select><br>
            How would you describe your skating level?
            <select name='lvl' id='lvl'>
                        <option></option>
                        <option value='beginner'>Beginner</option>
                        <option value='intermediate'>Intermediate</option>
                        <option value='advanced'>Advanced</option>
                        <option value='sensei'>Sensei</option>
                        <option value='god'>God</option>
            </select><br>
            <input type='text' name='bio' id='bio' placeholder="Write something about yourself.."><br><br>
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
?>
    </section>


<?php 
    include_once('inc/footer.php');
?>