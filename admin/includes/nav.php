<?php
include_once 'core/init.php';
$usernav = new User();
?>
         <div class="navbar-wrapper">
      <div class="container">

      <div class="masthead">
      <?php include_once 'includes/logo.php';?>
        <nav>
          <ul class="nav nav-justified">
            <li class=""><a href="index.php">Home</a></li>
            <li><a href="#">Pharmacy</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
            <?php
            if($u->isLoggedIn()){

?>
            <li><a href="logout.php">Logout</a></li>


<?php
            }
            else{
?>
            <li><a href="login.php">Login/Signup</a></li>

<?php
            }
            ?>
          </ul>
        </nav>
      </div>


      </div>
    </div>
