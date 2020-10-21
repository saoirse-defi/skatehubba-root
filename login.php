<?php 
   include_once('inc/header.php');
?>

<section class="signup-form">
        <h2>Login</h2>
    <div class="signup-form-form">
        <form action="login.inc.php" method="POST">
            <input type="text" name="name" placeholder="Username/Email..."><br>
            <input type="password" name="pwd" placeholder="Password..."><br>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

<?php 
    if(isset($_GET["error"])){    //outputing error messages to the user
        if($_GET["error"] == "emptyInput"){
            echo "<p>One of the fields was empty, please try again.</p>";
        }
        else if($_GET["error"] == "wrongLogin"){
            echo "<p>Incorrect login information</p>";
        }
        else if($_GET["error"] == "wrongLogin1"){
            echo "<p>Password check failed.</p>";
        }}
?>
</section>

