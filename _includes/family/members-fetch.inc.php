<?php
$id = $_SESSION['user_id'];

//Select the members name, id and gender from the family table
$sql = "SELECT CONCAT(first_name, ' ', last_name) AS name, member_id, gender FROM family WHERE user_id = '$id'";

$result = @mysqli_query($conn, $sql);
