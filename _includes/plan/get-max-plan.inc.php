<?php
include '../_includes/dbh.inc.php';

//Get the users ID from their session
$id = $_SESSION['user_id'];

//Find the latest plan for that user
$sql = "SELECT MAX(plan_id) plan_id FROM users_plan WHERE user_id = '$id'";
$result = @mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$plan_id = $row['plan_id'];
?>
