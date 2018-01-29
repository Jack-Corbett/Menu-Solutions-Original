<?php
session_start();

include '../dbh.inc.php';

//Get the users ID from their session
$id = $_SESSION['user_id'];
//Create an associative array for each day of the week to enable loop iteration
$day = array(0 => 'monday', 1 => 'tuesday', 2 => 'wednesday', 3 => 'thursday', 4 => 'friday', 5 => 'saturday', 6 => 'sunday');
$time = array();
$no_eating = array();
$plan_exists = false;

for ($x = 0; $x < 7; $x++) {
    //Store the members eating each day (this could be used in future to provide personalised recomendations rather than just using the number of people eating)
    ${$day[$x]} = $_POST[$day[$x]];
    // Place the time values submitted in an array
    $time[$x] = $_POST[$day[$x] . '_time'];
    //Store how many members are eating each day
    $no_eating[$x] = count(${$day[$x]});
}

//Declare the array to store the plan dates
$date_eating = array();
//OOP to calculate the dates of next week
//Create DateTime object containing the current time
$date = new DateTime();
//Set the date object to Monday of next week
$date->setISODate($date->format('o'), $date->format('W') . 1);
//Calculate every days date of that week from Monday to Sunday by using the 6 following days
$periods = new DatePeriod($date, new DateInterval('P1D'), 6);
//Convert the DatePeriod object to the week_dates array
$week_dates = iterator_to_array($periods);

//Format the dates inside the week_dates array ready to be stored in the database as strings
for ($i = 0; $i < 7; $i++) {
    $date_eating[$i] = $week_dates[$i]->format('Y-m-d');
}

//A script to find the largest plan ID for that user so we can check last weeks recipes
include 'get-max-plan.inc.php';

//If they have a plan in the database
if ($plan_id > 0) {
    $plan_exists = true;

    $sql = "SELECT start_date FROM plan WHERE plan_id = '$plan_id'";
    $result = @mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $current_start_date = $row['start_date'];

    //Check if the start date of their latest plan is for the current week. If so ask the user if they want to delete their current plan
    if ($current_start_date == $date_eating[0]) {
        header("Location: ../../plan/removeplan.php");
        exit();
    }

    //Stores the recipes eaten the week before
    $recipe_history = array();

    //Fetch all the recipes linked to their latest plan
    $sql = "SELECT recipe_id FROM plan_recipes WHERE plan_id = '$plan_id'";
    $result = @mysqli_query($conn, $sql);

    //Add all the recipes from last weeks plan to the recipe_history array
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($recipe_history, $row['recipe_id']);
    }
}

//Checks how many recipes there are in the table to set the searching upper bound
$sql = "SELECT COUNT(1) FROM recipes";
$result = @mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$no_recipes = $row[0];

//Declare the plan array which will store the recipes chosen for each day
$plan = array();

//PLAN GENERATION LOOP
for ($i = 0; $i < 7; $i++) {

    //Initially set the accept boolean switch to false to ensure the while loop runs at least once
    $accept = false;

    //Loop to pick a new recipe each time provided accept is still false
    while ($accept == false) {
        //Set the accept switch to true so we can then check for errors
        $accept = true;

        //Select a random recipe
        $recipe = rand(1, $no_recipes);

        //If the recipe matches a recipe used in the previous weeks plan set accept to false
        if ($plan_exists) {
            for ($a = 0; $a < 7; $a++) {
                if ($recipe == $recipe_history[$a]) {
                    $accept = false;
                }
            }
        }

        //Get the time to cook of the recipe from the database to check if the user has enough time available
        $sql = "SELECT cook_time FROM recipes WHERE recipe_id = '$recipe'";
        $result = @mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $cook_time = $row['cook_time'];

        if ($time[$i] < $cook_time) {
            $accept = false;
        }

        //Insert the recipe number into the plan array
        $plan[$i] = $recipe;

        //Check the recipe has not already been selected for that week
        for ($q = 0; $q < $i; $q++) {
                if ($recipe == $plan[$q]) {
                    $accept = false;
                }
        }

        //Unset the recipe variable ready for the next loop
        unset($recipe);
    }
}

//ADD THE PLAN TO DATABASE
//First add the start and end dates to the plan table as this will give us out AI value foir the plan ID
$sql = "INSERT INTO plan (start_date, end_date) VALUES('$date_eating[0]', '$date_eating[6]')";
$result = @mysqli_query($conn, $sql);
//Get the plan ID so we can use this in our linking tables
$new_plan = mysqli_insert_id($conn);

//Link the plan to the users account
$sql = "INSERT INTO users_plan (user_id, plan_id) VALUES ('$id', '$new_plan')";
$result = @mysqli_query($conn, $sql);

//Insert each day into the plan recipes table
for ($x = 0; $x < 7; $x++) {
    $sql = "INSERT INTO plan_recipes (plan_id, recipe_id, no_eating, date_eating) VALUES ('$new_plan', '$plan[$x]', '$no_eating[$x]', '$date_eating[$x]')";
    $result = @mysqli_query($conn, $sql);
}

//Jump to the calendar page to see the newly generated plan
header("Location: ../../calendar/calendar.php");
?>
