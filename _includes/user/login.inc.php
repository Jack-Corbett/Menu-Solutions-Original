<?php
session_start();

include '../dbh.inc.php';

//Escape strings to avoid sql injection
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

//Query the database to fetch the users hashed password
$sql = "SELECT hash FROM users WHERE email = '$email'";
$result = @mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$hash = $row['hash'];

//If nothing is returned then the email must not be linked to a user account
if ($hash === NULL) {
  //Direct the user back to the login page and display an incorrect email error
  header("Location: ../../user/login.php?error=email");
} else {
  //If a hash is returned run the password verify function to check if the submitted password generates the same hash
  if (password_verify($password, $hash)) {
    //If the password matches log the user in by fetching the users ID and checking if they have admin permissions
    $sql = "SELECT user_id, admin FROM users WHERE email ='$email' AND hash = '$hash'";
    $result = @mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //Store the user ID and their admin status in their session so it can be accessed across the site
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['admin'] = $row['admin'];
    //Jump back to the login page
    header("Location: ../../");
  } else {
    //If the password submitted did not create a matching hash show a password error on the login page
    header("Location: ../../user/login.php?error=password");
  }
}
