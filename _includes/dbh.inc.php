<?php

$username = "root";
$password = "root";

$conn = mysqli_connect("localhost", $username, $password, "menusolutions");

if (!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}
 ?>
