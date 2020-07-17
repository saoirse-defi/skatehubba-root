<?php
    require('inc/config.php');
    session_start();
    
?>


<?php include('inc/header.php'); ?>

<?php 
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){ //check result exists from the database
            $id = $row['user_id'];
            $sqlImg = "SELECT * FROM profile_image WHERE user_id='$id'"; //checking if user_id has a profile photo associated
            $resultImg = mysqli_query($connection, $sqlImg);
            while($rowImg = mysqli_fetch_assoc($resultImg)){
                echo "<div>";
                if($rowImg['status'] == 1){ //if has photo, fetch photo
                    echo "<img src='images/uploads/profile".$id.".png'>";
                }else{
                    echo "<img src='images/uploads/profileDefault.png'>"; //otherwise use default photo
                }
                echo $row['user_id'];
                echo "</div>";
            }
        }
    }else{
        echo "There are no users yet!";
    }

    if(isset($_SESSION['id'])){ //checking if the user is logged in
        if($_SESSION === 1){
            echo "You're logged in as Admin";
        }
        echo "<form action='upload.php' method='POST' enctype='multipart/form-data'> 
                <input type='file' name='file'>
                <button type='submit' name='upload'>UPLOAD</button>
            </form>";//uploads profile photo to uploads folder
    } else{ //if not logged in, introduces sign up form
        echo "You're not logged in!";
        echo "<form action='signup.php' method='POST'>
                                    <div class='form-group'>
                                    <label>*First Name</label>
                                    <input type='text' name='fname' class='form-control'>
                                </div> 
                                <div class='form-group'>
                                    <label>*Last Name</label>
                                    <input type='text' name='lname' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label>*Email</label>
                                    <input type='text' name='email' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label>*Password</label>
                                    <input type='password' name='pword' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label>* Confirm Password</label>
                                    <input type='password' name='_pword' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label>Age</label>
                                    <input type='number' name='age' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label for='style'>Choose favorite skate style:</label>
                                    <select name='style' id='style' default='all'>
                                        <option value='street'>Street</option>
                                        <option value='vert'>Vert</option>
                                        <option value='downhill'>Downhill</option>
                                        <option value='dancing'>Dancing</option>
                                        <option value='freeride'>Freeride</option>
                                        <option value='I love them all!'>You can't expect me to choose just one!</option>
                                    </select>
                                </div>
                                <div class='form-group'>
                                    <label>Favorite Trick</label>
                                    <input type='text' name='trick' class='form-control'>
                                </div>
                                <div class='form-group'>
                                    <label>Ethereum Public Key</label>
                                    <input type='text' name='eth' class='form-control'>
                                </div>
                                <br>
                                <button type='submit' name='submit' class='btn btn-primary'>Create User Account</button>
            </form>";
    }
?>
<br><br>
<div class="container">
<p>Login as user!</p>
<form action="login.php" method="POST">
<button type="submit" name="loginbtn">Login</button>
</form>
<br>
<p>Logout as user!</p>
<form action="logout.php" method="POST">
<button type="submit" name="logoutbtn">Logout</button>
</form>
</div>

<?php include('inc/footer.php'); ?>