
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="main-nav">
  <a class="navbar-brand" href="spots-main.php">SKATE HUBBA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="skate-spot-2.php">Add a Skate Spot <span class="sr-only">(current)</span></a>
      </li> 
      <li class="nav-item active">
        <a class="nav-link" href="ad-creation.php">Place an Ad <span class="sr-only">(current)</span></a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="marketplace.php">Marketplace</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gallery.php">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="spot-list.php">Skate Spot List</a>
      </li>
      <?php 
        if(isset($_SESSION["user_id"])){ //showing different content whether logged in or not (user_id may not be the variable)
            echo "<li class='nav-item'><a class='nav-link' href='profile.php'>Profile</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='logout.inc.php'>Logout</a></li>";
        }else{
            echo "<li class='nav-item'><a class='nav-link' href='signup.php'>Sign up</a></li>";
            echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
        }
      ?>
    </ul>
  </div>
</nav>
