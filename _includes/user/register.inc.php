<?php
include '../dbh.inc.php';

//Escape the submitted values to protect against SQL injection
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

//FORM VALIDATION
//Each check returns a specific error message
//Double check that none of the required fields are empty despite being html required fields
if (empty($firstname)) {
  header("Location: ../../user/register.php?error=empty");
  exit();
} elseif (empty($lastname)) {
  header("Location: ../../user/register.php?error=empty");
  exit();
} elseif (empty($email)) {
  header("Location: ../../user/register.php?error=empty");
  exit();
} elseif (empty($password)) {
  header("Location: ../../user/register.php?error=empty");
  exit();
} else {
  //Check using RegEx that the strings submitted for the users name only contain alphabetic characters
  if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
    header("Location: ../../user/register.php?error=characterfirst");
    exit();
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
    header("Location: ../../user/register.php?error=characterlast");
    exit();
  } else {
    //Check using a php function the email submitted is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../../user/register.php?error=invalidemail");
    } else {
      //Check the email has not already been used to create an account
      $sql = "SELECT email FROM users WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      $emailcheck = mysqli_num_rows($result);
      if ($emailcheck > 0) {
        header("Location: ../../user/register.php?error=emailinuse");
        exit();
      } else {
          //Generate the hash using the default key stretching encryption method (currently bcrypt)
      	  $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
          //Add the new user to the database
          $sql = "INSERT INTO users (first_name, last_name, email, hash, registration_date)
                VALUES ('$firstname', '$lastname', '$email', '$hash', NOW())";
          $result = mysqli_query($conn, $sql);

          //Send an email from noreply@menu-solutions.com confirming account creation
      	  $subject = "Welcome to Menu Solutions";
      	  $txt = "Dear $firstname $lastname, \r\n\r\nThank you for setting up a Menu Solutions account.
          You can now get started by adding your family members on the family page.
          Then all that's left to do is jump onto the plan page to say who is eating each day,
          how much time you have to cook and then press generate meal plan. You can then use your list to collect
          all the ingredients you need to get cooking! For a more detailed tutorial to show you how to get the most out
          of the site please read the about page or use the tutorial button on the home page. \r\n\r\n
          I really appreciate your feedback to improve the site so please contact me through the Menu Solutions page on Facebook if you have any suggestions.
          \r\n\r\nThank you again, \r\n\r\nKind regards \r\nJack Corbett \r\nCreator of Menu Solutions";
      	  $headers = "From: noreply@menu-solutions.com";

      	  mail($email,$subject,$txt,$headers);

          //Return to the login page
          header("Location: ../../user/login.php");
      }
    }
  }
}
