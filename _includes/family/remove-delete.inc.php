<?php

include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';

//Get the members ID from the URL
$member_id = mysqli_real_escape_string($conn, $_GET['member']);

//Delete the member from the family page
$sql = "DELETE FROM family WHERE member_id = '$member_id'";
$result = mysqli_query($conn, $sql);

header('Location: ../../family/members.php');
