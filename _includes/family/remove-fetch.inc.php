<?php
include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Get the member ID from the URL
$member_id = mysqli_real_escape_string($conn, $_GET['member']);

//Select the members name from the family table
$sql = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM family WHERE member_id = '$member_id'";
$result = @mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
