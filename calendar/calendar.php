<?php
  include '../_assets/header.php';
  include '../_assets/standardstyle.php';
 ?>

<div class="page-wrap">

  <!-- Navigation Bar -->
  <?php
    if (isset($_SESSION['user_id'])) {
      include '../_assets/navbar.loggedin.php';
  ?>
  <br /><br />

	<div class="w3-container">
	  <h1>Calendar</h1>
	  <p>Here you can view your meal plan for the week with the number of people eating each day on the side. Simply click the recipe for today and get cooking.</p>
	</div>

  <?php
    include '../_includes/dbh.inc.php';

    $day = array(0 => 'Monday', 1 => 'Tuesday', 2 => 'Wednesday',  3 => 'Thursday', 4 => 'Friday', 5 => 'Saturday', 6 => 'Sunday');

    $id = $_SESSION['user_id'];

    $sql = "SELECT MAX(plan_id) plan_id FROM users_plan WHERE user_id = '$id'";
    $result = @mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $plan_id = $row['plan_id'];

    if ($plan_id === NULL) {
  ?>
  <p class="w3-text-red w3-center">To view your meal plan you must first visit the plan page and generate one.</p>

  <?php
    } else {
  ?>

  <!-- Meal Plan table -->
  <ul class="w3-ul w3-card-4 w3-animate-opacity">

    <?php
      $sql = "SELECT recipe_id, no_eating, date_eating FROM plan_recipes WHERE plan_id = '$plan_id' ORDER BY date_eating ASC";
      $result = @mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $recipe_id[] = $row['recipe_id'];
        $no_eating[] = $row['no_eating'];
        $date_eating[] = date_create($row['date_eating']);
      }

      for ($i=0; $i<7; $i++) {
  	?>
  	<li class="w3-padding-16">

      <img src="../_img/recipe_placeholder.png" class="w3-left w3-margin-right" style="width:30px">
      <span class="w3-large"><?php echo $day[$i] . " - " . date_format($date_eating[$i],"d/m"); ?></span>

      <br />

      <?php
  	    $sql = "SELECT name FROM recipes WHERE recipe_id = '$recipe_id[$i]'";
              $result = @mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              $recipe_name = $row['name'];
      ?>

	    <a href="<?php echo 'dayrecipe.php?' . $recipe_id[$i]; ?>" class="w3-medium" style="text-decoration: none"><?php echo $recipe_name; ?></a>

	    <?php
        for ($x=1; $x<$no_eating[$i]+1; $x++) {

  	    if (fmod($x,6) == 0) {
  	       echo "<br />";
  	    }
  	  ?>

  	  <img src="../_img/meal.png" class="w3-right w3-circle w3-margin-right" style="width:26px">

 	    <?php
 	      }
 	    ?>
 	    <br />
  	</li>
  	<?php
	    }
	  ?>
	</ul>

	<br />
  <?php
    }
    } else {
      include '../_assets/navbar.loggedout.php';
      include '../_assets/loginerror.php';
    }
  ?>

</div>

<?php
  include '../_assets/footer.php'
 ?>
