<?php
  include '_assets/header.php';
 ?>

<style>
/* Sets the font for the page */
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}

body, html, h3 {
    height: 100%;
    color: #FFFFFF;
    line-height: 1.8;
}

h1,h2,h4,h5,h6 {
    height: 100%;
    color: #777;
    line-height: 1.8;
}

/* Create a Parallax Effect */
.bgimg-1 {
    opacity: 0.9;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

  /* First image (Logo. Full height) */
  .bgimg-1 {
      background-image: url(_img/choppingboard.jpg);
      min-height: 100%;
  }

  /* Turn off parallax scrolling for tablets and mobiles */
  @media only screen and (max-width: 768px) {
      .bgimg-1, .bgimg-2, .bgimg-3 {
          background-attachment: scroll;
      }
  }
  .display {display:none}
</style>

<!-- Navigation Bar -->
<?php
if (isset($_SESSION['user_id'])) {
  include '_assets/navbar.loggedin.php';
} else {
  include '_assets/navbar.loggedout.php';
}
 ?>

<!-- First Parallax Image with logo and title -->
<div class="bgimg-1 w3-opacity w3-display-container" style="white-space:nowrap;">
  <img src="_img/logo.png" height="90" width="60" class="w3-display-middle-above w3-animate-opacity">
  <span class="w3-display-middle w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">MENU SOLUTIONS</span>
    <a <?php
      if (isset($_SESSION['user_id'])) {
        echo 'href="family/members.php"';
      } else {
        echo 'href="user/login.php"';
      }
       ?> class="w3-display-middle-below w3-center w3-btn w3-animate-opacity w3-hover-light-grey w3-theme-d1">START EATING SMARTER</a>
  <div class="w3-display-bottommiddle-above">
    <a onclick="document.getElementById('tutorial').style.display='block'" class="w3-centre w3-btn w3-animate-opacity w3-dark-grey w3-round-large w3-small">TUTORIAL</a>
  </div>
</div>

<!-- Instructions Title -->
<div class="w3-container w3-center">
  <h2>Simple Steps to a Healthy Diet</h2>
</div>

<!-- Instructions -->
<div class= "w3-row-padding w3-container w3-center w3-dark-grey">
  <div class="w3-quarter"><h3>Add Your Family</h3>
    <img src="_img/family.png">
    <p>Add each family members details</p>
    <?php
	   if (isset($_SESSION['user_id'])) {
        echo '<a href="family/members.php" class=" w3-btn w3-hover-white w3-theme-d1">FAMILY</a>';
      }
    ?>
    <br /><br />
  </div>

  <div class="w3-quarter w3-dark-grey w3-center"><h3>Tell Us When</h3>
    <img src="_img/clock.png">
    <p>Tell us how much time you have to cook each night and who will be eating</p>
    <?php
      if (isset($_SESSION['user_id'])) {
        echo '<a href="plan/plan.php" class=" w3-btn w3-hover-white w3-theme-d1">PLAN</a>';
      }
    ?>
    <br /><br />
  </div>

  <div class="w3-quarter w3-dark-grey w3-center"><h3>Generate Calendar</h3>
    <img src="_img/calendar.png">
    <p>Review your calendar of meal plans for the week</p>
    <?php
      if (isset($_SESSION['user_id'])) {
        echo '<a href="calendar/calendar.php" class=" w3-btn w3-hover-white w3-theme-d1">CALENDAR</a>';
      }
    ?>
    <br /><br />
  </div>

  <div class="w3-quarter w3-dark-grey w3-center"><h3>Shopping List</h3>
    <img src="_img/list.png">
    <p>Use your generated shopping list to fetch the ingredients and enjoy a week of stress free cooking</p>
    <?php
      if (isset($_SESSION['user_id'])) {
        echo '<a href="list/list.php" class=" w3-btn w3-hover-white w3-theme-d1">LIST</a>';
      }
    ?>
    <br /><br />
  </div>
</div>

<div class="site-footer">
  <?php
    include '_assets/footer.php'
   ?>
</div>

<!-- Tutorial modal -->
<div id="tutorial" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-dark-grey">
      <span onclick="document.getElementById('tutorial').style.display='none'"
      class="w3-closebtn w3-padding-top w3-hover-text-red">&times;</span>
      <h3>Tutorial</h3>
    </header>

    <ul class="w3-pagination w3-white w3-border-bottom" style="width:100%;">
      <li><a href="#" class="tablink" onclick="openTab(event, 'Intro')">Intro</a></li>
      <li><a href="#" class="tablink" onclick="openTab(event, 'Add Family')">Add Family</a></li>
      <li><a href="#" class="tablink" onclick="openTab(event, 'Members')">View Members</a></li>
      <li><a href="#" class="tablink" onclick="openTab(event, 'Plan')">Create Plan</a></li>
      <li><a href="#" class="tablink" onclick="openTab(event, 'Calendar')">View Calendar</a></li>
      <li><a href="#" class="tablink" onclick="openTab(event, 'List')">Shopping List</a></li>
    </ul>

    <div id="Intro" class="w3-container w3-text-grey display">
      <div class="w3-center">
        <h4>Intro</h4>
        <img src="../_img/icon.png" class="w3-circle w3-center" style="width:150px">
        <p>Welcome to Menu Solutions. In this tutorial I will talk you through how to set up your family,
          generate meal plans and check your shopping list. Navigate by clicking the tabs relating to each
          page of the site to learn more.</p>
      </div>
    </div>

    <div id="Add Family" class="w3-container w3-text-grey display">
      <p>First you need to add your family members and fill in
        some basic information for each person. We will use this when generating the meal plan.
        To add a member simply select add members from the drop down in the top bar or press the round green plus button.
        This will take you to a page where you can fill in their first name, surname and gender. Once that is filled in press the green add person
        button.</p>
       <div class="w3-center">
      	 <img class="w3-card-2" src="_img/addmember-tut.png" style="width:100%">
       </div>
      <br />
    </div>

    <div id="Members" class="w3-container w3-text-grey display">
      <p>You can manage your family from the members page. To delete a family member just press the x on the far right and the tick to confirm.
        To edit their information just press the pencil and when your finished press the green tick to save your changes. </p>
      <div class="w3-center">
        <img class="w3-card-2" src="_img/family-tut.png"  style="width:100%">
      </div>
      <br />
    </div>

    <div id="Plan" class="w3-container w3-text-grey display">
      <p>The plan page is where you input who will be eating each day
        and tell us how long you will have to cook. Click on the tab for each day and use the checkboxes to select
        the available family members and the drop down for how many minutes you have.
        Once you have pressed the generate button the calendar will be populated with your meal plan.
        To overwrite a plan plan do simply press the delete current
        plan button or if you press generate meal plan again you will be asked if you would like to delete your current plan.
        Always delete your current plan before entering the new values as they will not be saved.</p>
      <div class="w3-center">
        <img class="w3-card-2" src="../_img/plan-tut.png"  style="width:100%">
      </div>
      <br />
    </div>

    <div id="Calendar" class="w3-container w3-text-grey display">
      <p>The calendar page is where you can see your meal plan for the current week. It is also how
        you will access your recipes each day when cooking. Each item in the list shows the day and date
        to be cooked on the left along with the name of the recipe. On the right you can see how many people
        are eating each day, respresented by the number of heads. To see the instructions for a recipe just click
        the recipe name and it will take you to a page with everything you need to get cooking. It even works out the
        quantities based on how many are eating for you. Bon appetit!</p>
      <div class="w3-center">
      	<img class="w3-card-2" src="_img/calendar-tut.png"  style="width:100%">
      </div>
      <br />
    </div>

    <div id="List" class="w3-container w3-text-grey display">
      <p>The list page contains the shopping list for your latest meal plan. You can see the ingredients split into categories
      to make them easy to find in the supermarket. It also shows you exactly how much of each you need to feed the amount of people
      who are eating that day! It even combines ingredients used on different days.</p>
      <div class="w3-center">
        <img class="w3-card-2" src="_img/list-tut.png" style="width:100%">
      </div>
      <br />
    </div>
  </div>
</div>
<!-- End of modal tutorial -->

<script>
document.getElementsByClassName("tablink")[0].click();

function openTab(evt, pageName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("display");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("w3-light-grey");
  }
  document.getElementById(pageName).style.display = "block";
  evt.currentTarget.classList.add("w3-light-grey");
}
</script>
