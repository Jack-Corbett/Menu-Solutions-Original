<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Pass through the members details and get the users ID from their session
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$default_ticked = mysqli_real_escape_string($conn, $_POST['default_ticked']);
$id = $_SESSION['user_id'];

//Double check that the name has not been left empty
if (empty($firstname)) {
  header("Location: ../../family/addmember.php?error=empty");
  exit();
} elseif (empty($lastname)) {
  header("Location: ../../family/addmember.php?error=empty");
  exit();
} else {
  //Insert the family members information into the database
  $sql = "INSERT INTO family (user_id, first_name, last_name, gender, default_ticked)
        VALUES ('$id', '$firstname', '$lastname', '$gender', '$default_ticked')";
  $result = mysqli_query($conn, $sql);

  header('Location: ../../account/family/members.php');
}
