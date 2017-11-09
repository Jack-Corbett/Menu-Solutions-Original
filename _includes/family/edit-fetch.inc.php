<?php
include '../_includes/dbh.inc.php';

//Get the member ID from the URL
$member_id = mysqli_real_escape_string($conn, $_GET['member']);

//Select all the members information
$sql = "SELECT * FROM family WHERE member_id = '$member_id'";
$result = @mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//Store the information in arrays to be used to edit
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$gender = $row['gender'];
$default_ticked = $row['default_ticked'];
?>
