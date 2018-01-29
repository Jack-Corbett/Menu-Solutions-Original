<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Get the users ID from their session
$id = $_SESSION['user_id'];

//Get the users latest plan to delete
$sql = "SELECT MAX(plan_id) plan_id FROM users_plan WHERE user_id = '$id'";
$result = @mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$plan_id = $row['plan_id'];

//Delete that plan from the plan table which will cascade to delete it from the others
$sql = "DELETE FROM plan WHERE plan_id = '$plan_id'";
$result = @mysqli_query($conn, $sql);

//Link back to the plan page and display a message confirming deletion
header ("Location: ../../plan/plan.php?removed");