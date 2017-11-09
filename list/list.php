<?php
  include '../_assets/header.php';
  include '../_assets/standardstyle.php';
 ?>


<div class="page-wrap">

  <!-- Navigation Bar -->
  <?php
    if (isset($_SESSION['user_id'])) {
      include '../_assets/navbar.loggedin.php';
  ?><br /><br />

	<!-- Title -->
	<div class="w3-container">
	  <h1>List</h1>
	  <p>Here you can see all the ingredients for the recipes for your current plan.</p>
	</div>

  <?php
    include '../_includes/dbh.inc.php';
    $id = $_SESSION['user_id'];

    //Finds the latest plan
	  include '../_includes/plan/get-max-plan.inc.php';

	  if ($plan_id === NULL) {
  ?>
  <p class="w3-text-red w3-center">To view your shopping list you must first visit the plan page and generate a meal plan.</p>
  <?php
    } else {
      include '../_includes/list/list.inc.php';
  ?>

  <!-- Table for desktops -->
	<table class="w3-table-all w3-card-4 w3-hide-small w3-hide-medium">
	  <tr>
      <!-- Displays the full grid on desktops -->
      <th>Fruit and Vegetables</th>
      <th>Protein</th>
      <th>Carbohydrates</th>
      <th>Dairy</th>
      <th>Other</th>
    </tr>

    <tr>
      <!--Output all the fruit and vegetables-->
      <td>
        <?php
          OutputArray($fv_amount, $fv_measure, $fv_name);
        ?>
      </td>

      <!--Outputs all the protien-->
      <td>
        <?php
          OutputArray($pr_amount, $pr_measure, $pr_name);
        ?>
      </td>

      <!--Outputs all the carbohydrates-->
      <td>
        <?php
          OutputArray($ca_amount, $ca_measure, $ca_name);
        ?>
      </td>

      <!--Outputs all the dairy-->
    	<td>
        <?php
          OutputArray($da_amount, $da_measure, $da_name);
  	    ?>
      </td>

      <!--Outputs all the other ingredients needed-->
      <td>
        <?php
          OutputArray($un_amount, $un_measure, $un_name);
        ?>
      </td>
    </tr>
	</table>

  <!-- Table for mobile devices -->
  <table class="w3-table-all w3-card-4 w3-hide-large">
    <tr>
      <!-- Displays the full grid on desktops -->
      <th>Fruit and Vegetables</th>
      <th>Protein</th>
    </tr>

    <tr>
      <!--Output all the fruit and vegetables-->
      <td>
        <?php
          OutputArray($fv_amount, $fv_measure, $fv_name);
        ?>
      </td>

      <!--Outputs all the protien-->
      <td>
        <?php
          OutputArray($pr_amount, $pr_measure, $pr_name);
        ?>
      </td>
    </tr>

    <tr>
      <th>Carbohydrates</th>
      <th>Dairy</th>
    </tr>

    <tr>
      <!--Outputs all the carbohydrates-->
      <td>
        <?php
          OutputArray($ca_amount, $ca_measure, $ca_name);
        ?>
     </td>

      <!--Outputs all the dairy-->
      <td>
        <?php
          OutputArray($da_amount, $da_measure, $da_name);
        ?>
      </td>
    </tr>

    <tr>
      <th>Other</th>
      <th></th>
    </tr>

    <tr>
      <!--Outputs all the other ingredients needed-->
      <td>
        <?php
          $half = round(count($un_name) / 2);
          OutputArray($un_amount, $un_measure, $un_name, $half)
        ?>
      </td>
    </tr>
  </table>

  <br />

</div>
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
