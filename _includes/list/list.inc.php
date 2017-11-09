<?php
//Ingredient Categories:
  //Fruit and Veg = 1
  $fv_name = array();
  $fv_amount = array();
  $fv_measure = array();
  //Protein = 2
  $pr_name = array();
  $pr_amount = array();
  $pr_measure = array();
  //Carbohydrates = 3
  $ca_name = array();
  $ca_amount = array();
  $ca_measure = array();
  //Dairy = 4
  $da_name = array();
  $da_amount = array();
  $da_measure = array();
  //Uncategorised(Other) = 6
  $un_name = array();
  $un_amount = array();
  $un_measure = array();
  //Ignore = 5

//Find each ingredient involved in each recipe of the users latest plan. Add the totals if the ingredient is used in more than one recipe
$sql = "SELECT ingredients.category, ingredients.ingredient_name, SUM(plan_recipes.no_eating * ingredients_recipes.quantity) As amount, ingredients.measurement
 FROM plan_recipes
 JOIN recipes ON recipes.recipe_id = plan_recipes.recipe_id
 JOIN ingredients_recipes ON ingredients_recipes.recipe_id = recipes.recipe_id
 JOIN ingredients ON ingredients.ingredient_id = ingredients_recipes.ingredient_id
 WHERE plan_recipes.plan_id = '$plan_id'
 GROUP BY ingredients.ingredient_name
 ORDER BY ingredients.category";
$result = @mysqli_query($conn, $sql);

//Split the ingredients into categories and add them to each corresponding array
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	  if ($row['category'] == 1) {
      array_push($fv_name, $row['ingredient_name']);
	    array_push($fv_amount, round($row['amount'], 2));
      array_push($fv_measure, $row['measurement']);
	  } elseif ($row['category'] == 2) {
      array_push($pr_name, $row['ingredient_name']);
	    array_push($pr_amount, round($row['amount']));
      array_push($pr_measure, $row['measurement']);
	  } elseif ($row['category'] == 3) {
      array_push($ca_name, $row['ingredient_name']);
	    array_push($ca_amount, round($row['amount']));
      array_push($ca_measure, $row['measurement']);
	  } elseif ($row['category'] == 4) {
      array_push($da_name, $row['ingredient_name']);
	    array_push($da_amount, round($row['amount']));
      array_push($da_measure, $row['measurement']);
	  } elseif ($row['category'] == 6) {
      array_push($un_name, $row['ingredient_name']);
	    array_push($un_amount, round($row['amount']));
      array_push($un_measure, $row['measurement']);
	  }
	}

  //Function to output each array
	function OutputArray($amount, $measure, $name, $half) {
    //Loop through each ingredient
  	  for ($i=0; $i<count($name); $i++) {
        //Half is only used on mobile devices to split the other column into two to make it easier to read
    	  if ($half > 0 AND $i == $half) {
    	  	echo "</td> <td>";
            }
    	  //If the amount is 0 only the name of the ingredient needs to be outputted as it does not specify an amount in the recipe
            if ($amount[$i] > 0) {
            //If the unit is grams or millilitres there is no need to put a space after the amount
              if ($measure[$i] == "g" OR $measure[$i] == "ml") {
                echo $amount[$i] . $measure[$i] . " " . $name[$i] . "<br />";
              } else {
                echo $amount[$i] . " " . $measure[$i] . " " . $name[$i] . "<br />";
              }
            } else {
              echo $name[$i] . "<br />";
            }
      }
  }
?>
