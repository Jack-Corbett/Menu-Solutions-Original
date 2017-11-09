<?php
  include '../_assets/header.php';
  include '../_assets/standardstyle.php';
 ?>

<div class="page-wrap">

  <?php
    if (isset($_SESSION['user_id'])) {
      include '../_assets/navbar.loggedin.php';
  ?>
  <br /><br />
  <?php
      if ($_SESSION['admin'] == 1) {
  ?>

	<div class="w3-container">
    <h1>Admin</h1>
    <p>Welcome to the admin page. You can only access this if you have been granted permission.
      From here you can help me improve the Menu Solutions experience by adding new recipes which will be used to generate users weekly meal plans.
      Simply follow the instructions below to input the details.</p>
    <p>1. Give your recipe a name and tell me how long it takes to cook in minutes.<br />
      2. Write out numbered instructions making a new line for each new step (the same format as these instructions). Do not press submit until all the recipes have been entered.<br />
      3. Fill in the ingredient name (always use the plural with brackets eg: Potato(es) or Carrot(s)), how it is measured, the quantity needed (this is per person and if there is no set
      portion eg: serve with carrots enter 0) and pick a category. The other category is for ingredients that do not fit in to the other categories and the hide category is used for
      ingredients the user doesn&#39;t need on their shopping list such as water.<br />
      4. To add the rest of the ingredients just click the Add an Ingredient button and another set of boxes will appear. Repeat this for all ingredients
      and finish by pressing submit.</p>
    <?php
      $url = $_SERVER['REQUEST_URI'];
      if (strpos($url, 'added') !== false) {
        echo "<p class='w3-text-green w3-center'>Your recipe has been added to the database and can now be chosen in plan generation.</p>";
      } elseif (strpos($url, 'failed') !== false) {
        echo "<p class='w3-text-red w3-center'>Your recipe could not be added to the database as some of the information had not been completed.</p>";
      }
     ?>
	</div>

  <div class="w3-card-4">
    <br />
    <form action="../_includes/admin/addrecipe.inc.php" method="POST" class="w3-padding w3-center">
      <!--Recipe Name-->
      <input type="text" name="name" placeholder="Recipe Name" class="w3-half" required>
      <!--Cook Time-->
      <input type="text" name="cooktime" placeholder="Cook Time" class="w3-half" required>
      <br /><br />
      <!--Instructions-->
      <textarea ROWS=3 COLS=30 name="instructions" placeholder="Instructions" style="width:100%" required></textarea><br /><br />
      <button value="submit" class="w3-btn w3-hover-blue w3-animate-opacity w3-theme-d1">Submit</button>
      <br /><br />
      <button id="addFields" class="w3-btn w3-dark-grey" type="button">Add an Ingredient</button>
      <br /><br />
      <div class="w3-border w3-padding">
        <!--Ingredient Name-->
        <input class="w3-third" type="text" name="ingredient_name[]" placeholder="Ingredient Name" required>
        <!--Measurement-->
        <input class="w3-third" type="text" name="ingredient_measurement[]" placeholder="Measurement">
        <!--Quantity-->
        <input class="w3-third" type="text" name="ingredient_quantity[]" placeholder="Quantity">
        <br /><br />
        <!--Category-->
        <select class="w3-select w3-border" name="ingredient_category[]" required>
          <option value="" disabled selected>Choose a category</option>
          <option value="1">Fruit and Veg</option>
          <option value="2">Protien</option>
          <option value="3">Carbohydrates</option>
          <option value="4">Dairy</option>
          <option value="6">Other</option>
          <option value="5">Hide</option>
        </select>
      </div>
      <br />
    </form>
  </div>
  <br />

<?php
    } else {
      echo "<p class='w3-text-red w3-center'>You do not have permission to access this page.</p>";
    }
  } else {
  include '../_assets/navbar.loggedout.php';
  include '../_assets/loginerror.php';
  }
?>

</div>

 <?php
  include '../_assets/footer.php';
?>

<script>
  $(function ($) {
      $('body').on("click", '#addFields', function () {
          $('form').append('<div class="w3-border w3-padding">\
                  <input class="w3-third" type="text" name="ingredient_name[]" placeholder="Ingredient Name">\
                  <input class="w3-third" type="text" name="ingredient_measurement[]" placeholder="Measurement">\
                  <input class="w3-third" type="text" name="ingredient_quantity[]" placeholder="Quantity">\
                  <br /><br />\
                  <select class="w3-select w3-border" name="ingredient_category[]">\
                    <option value="" disabled selected>Choose a category</option>\
                    <option value="1">Fruit and Veg</option>\
                    <option value="2">Protien</option>\
                    <option value="3">Carbohydrates</option>\
                    <option value="4">Dairy</option>\
                    <option value="6">Other</option>\
                    <option value="5">Hide</option>\
                  </select>\
                </div>\
                <br />');
      })
  })(jQuery);
</script>
