<?php
include '../dbh.inc.php';

//Store the values passed through
$name = $_POST['name'];
$cook_time = $_POST['cooktime'];
$instructions = $_POST['instructions'];

//Store the arrays passed through
$ingredient_name = $_POST['ingredient_name'];
$measurement = $_POST['ingredient_measurement'];
$quantity = $_POST['ingredient_quantity'];
$category = $_POST['ingredient_category'];

//Check all the information has been completed
if (empty($name) or empty($cook_time) or empty($instructions) or empty($ingredient_name[0])) {
  header ('Location: ../../user/admin.php?failed');
  exit();
}

//Add the name, the instructions and cook time to the recipe table
$sql = "INSERT INTO recipes (name,  instructions, cook_time) VALUES('$name', '$instructions', '$cook_time')";
$result = @mysqli_query($conn, $sql);
$recipe_id = mysqli_insert_id($conn);

//For each ingredient check if it already exists in the ingredient table
for ($i=0; $i<count($ingredient_name); $i++) {
  $sql = "SELECT ingredient_id FROM ingredients WHERE ingredient_name LIKE '$ingredient_name[$i]'";
  $result = @mysqli_query($conn, $sql);
//If it exists then get the ingredient ID and add it to the ID array
  if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $ingredient_id[$i] = $row['ingredient_id'];
  } else {
    //Add the ingrdient to the ingredient table as it doesn't already exist
    $sql = "INSERT INTO ingredients (ingredient_name, measurement, category) VALUES ('$ingredient_name[$i]', '$measurement[$i]', '$category[$i]')";
    $result = @mysqli_query($conn, $sql);
    //Add the newly generated ingredient ID to the array
    $ingredient_id[$i] = mysqli_insert_id($conn);
  }
  //Add the information to the ingredients recipes link table
  $sql = "INSERT INTO ingredients_recipes VALUES ('$ingredient_id[$i]', '$recipe_id', '$quantity[$i]')";
  $result = @mysqli_query($conn, $sql);
}

//Return to the admin page with a confirmation that the recipe has been added to the database
header ('Location: ../../user/admin.php?added');
 ?>
