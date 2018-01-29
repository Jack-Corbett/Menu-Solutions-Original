<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Get the users ID from their session
$id = $_SESSION['user_id'];
//Create an associative array for each day of the week to enable loop iteration
$day = array(0 => 'monday', 1 => 'tuesday', 2 => 'wednesday',  3 => 'thursday', 4 => 'friday', 5 => 'saturday', 6 => 'sunday');
$name = array();
$member_id = array();
$default_ticked = array();
$gender = array();

//Fetch all the details for each member in the users family
$sql = "SELECT first_name, member_id, default_ticked, gender FROM family WHERE user_id = '$id'";
$result = @mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $name[] = $row['first_name'];
  $member_id[] = $row['member_id'];
  $default_ticked[] = $row['default_ticked'];
  $gender[] = $row['gender'];
}