<?php
  include '../_assets/header.php';
  include '../_assets/standardstyle.php';
 ?>

<div class="page-wrap">

  <!-- Navigation Bar -->
  <?php
    if (isset($_SESSION['user_id'])) {
      include '../_assets/navbar.loggedin.php';
    } else {
      include '../_assets/navbar.loggedout.php';
    }
   ?>
  <br /><br />

  <!-- Login Form -->
  <div class="w3-container w3-center">
    <h1>Register</h1>
    <div class="w3-card-4">

      <br />

      <p>Here you can register for your Menu Solutions account, simply fill in the form below and press sign up</p>
        <form action="../_includes/user/register.inc.php" method="post">
          <input type="text" name="firstname" placeholder="Firstname" required><br /><br />
          <input type="text" name="lastname" placeholder="Surname" required><br /><br />
          <input type="text" name="email" placeholder="Email" required><br /><br />
          <input type="password" name="password" placeholder="Password" required><br /><br />
          <button type="submit" class="w3-btn w3-hover-blue w3-animate-opacity w3-theme-d1">Sign Up</button>
        </form>

        <div class="w3-text-red">
          <?php
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, 'error=empty') !== false) {
              echo "Please fill in every field";
            }
            elseif (strpos($url, 'error=characterfirst') !== false) {
            	echo "Only letters and spaces allowed in first name";
            }
            elseif (strpos($url, 'error=characterlast') !== false) {
            	echo "Only letters and spaces allowed in surname";
            }
            elseif (strpos($url, 'error=invalidemail') !== false) {
            	echo "Invalid email address";
            }
            elseif (strpos($url, 'error=emailinuse') !== false) {
            	echo "Email address is already registered to another account, please recover your password or use another email";
            }
           ?>
         </div>
       <br />
   </div>
  </div>
</div>

<?php
  include '../_assets/footer.php'
 ?>
