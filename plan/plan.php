<?php
include '../_assets/header.php';
include '../_assets/standardstyle.php';
 ?>

<style>
  .day {display:none;}
</style>

<script>
	function openDay(evt, dayName) {
	  var i, x, tablinks;
	  x = document.getElementsByClassName("day");
	  for (i = 0; i < x.length; i++) {
	      x[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablink");
	  for (i = 0; i < x.length; i++) {
	      tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
	  }
	  document.getElementById(dayName).style.display = "block";
	  evt.currentTarget.className += " w3-dark-grey";
	}
</script>

<div class="page-wrap">\

  <!-- Navigation Bar -->
  <?php
    if (isset($_SESSION['user_id'])) {
      include '../_assets/navbar.loggedin.php';
  ?>
  <br /><br />

	<div class="w3-container">
		<h1>Plan</h1>
		<p>Simply enter which family members are eating and how long you have to cook by selecting each day from the bar below.
		  We will use this to generate your calendar for the coming week.</p>
	</div>

	<div class="w3-card-4">
		<ul class="w3-navbar w3-theme-d1">
		  <li><a href="#" class="tablink" onclick="openDay(event, 'monday');">Monday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'tuesday');">Tuesday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'wednesday');">Wednesday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'thursday');">Thursday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'friday');">Friday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'saturday');">Saturday</a></li>
		  <li><a href="#" class="tablink" onclick="openDay(event, 'sunday');">Sunday</a></li>
		</ul>

    <form action="../_includes/plan/plan-generation.inc.php" method="post">
      <?php
        include '../_includes/plan/set-up-form.inc.php';

        //Loops through the days of the week
        for ($i = 0; $i < 7; $i++) {
      ?>
      <div id="<?php echo $day[$i]; ?>" class="w3-container w3-border day">

      <p>Select who will be eating: </p>

	     <div class="w3-row-padding">
        <?php
          //Find how many members there are in the users family
	        $no_members = count($name);

          //Loop to write out a checkbox for each family member
	        for($x = 0; $x < $no_members; $x++) {
	      ?>
	      <div class="w3-third w3-card-2 w3-padding-8">
	         <img src=
           <?php if ($gender[$x] == 'm') {
             echo '"../_img/male_user.png"';
           } elseif ($gender[$x] == 'f') {
             echo '"../_img/female_user.png"';
           } else {
          echo '"../_img/other_user.png"';
          }?>
          class="w3-left w3-circle w3-margin-right" style="width:30px">
			    <input class="w3-check" name="<?php echo $day[$i] . '[]' ?>" type="checkbox"
          <?php if ($default_ticked[$x] == 1)
          { echo "checked"; }?> value="<?php echo $member_id[$x]; ?>">
			    <label class="w3-validate">&emsp;<?php echo $name[$x]; ?></label>
			  </div>
			  <?php
			   }
			  ?>
		  </div>

		  <br />
		  <p>Select the number of minutes you have available to cook: </p>

		  <div class="w3-half">
  		  <select class="w3-select w3-border" name="<?php echo $day[$i] . '_time' ?>">
    		  <option selected value="90">90</option>
          <option value="60">60</option>
    		  <option value="30">30</option>
  		  </select>
		  </div>

      <br /><br />

      </div>
      <?php
        }
      ?>
  </div>

    <br />

    <div class="w3-text-red w3-center">
      <?php
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, 'removed') !== false) {
          echo "<p>Your plan for the coming week has been deleted. You can now generate a new one.</p>";
        }
      ?>
    </div>

    <div class="w3-center">
      <button class="w3-btn w3-hover-blue w3-dark-grey" type="submit">Generate Meal Plan</button>
    </div>

    </form>

  <br />

  <div class="w3-center">
    <a href="
    <?php
      include '../_includes/plan/get-max-plan.inc.php';
      if ($plan_id === NULL) {
        echo '#';
      } else {
        echo 'removeplan.php?delete';
      }
    ?>
    " class="w3-btn
    <?php
      if ($plan_id === NULL) {
        echo 'w3-disabled';
      }
    ?>
    w3-hover-red w3-dark-grey">Delete Current Plan</a>
  </div>

  <br /><br />

  <?php
   }
    if (isset($_SESSION['user_id']) == false) {
      include '../_assets/navbar.loggedout.php';
      include '../_assets/loginerror.php';
    }
  ?>

</div>

<?php
include '../_assets/footer.php';
 ?>
