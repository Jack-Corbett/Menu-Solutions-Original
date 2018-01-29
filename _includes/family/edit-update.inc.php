<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Pass through all the new values from the edit page
$member_id = $_POST['memberid'];
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$default_ticked = mysqli_real_escape_string($conn, $_POST['default_ticked']);

//Double check that the names are not empty
if (empty($firstname)) {
  header("Location: ../../family/editmember.php?error=empty");
  exit();
} elseif (empty($lastname)) {
  header("Location: ../../family/editmember.php?error=empty");
  exit();
} else {
  //Update the details for that member in the family table
  $sql = "UPDATE family SET first_name = '$firstname', last_name = '$lastname', gender = '$gender', default_ticked = '$default_ticked' WHERE member_id = '$member_id'";
  $result = mysqli_query($conn, $sql);

  header('Location: ../../family/members.php');
}
