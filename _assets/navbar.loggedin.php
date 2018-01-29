<!-- Navigation for desktops -->
<div class="w3-top">
  <ul class="w3-navbar w3-card-2 w3-dark-grey w3-left-align">
    <li class=" w3-hide-large w3-opennav w3-right">
      <a class="w3-padding-large" href="javascript:void(0)" onclick="showMenu()" title="Toggle Navigation Menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </li>
    <li>
      <a href="/" class="w3-padding-large w3-hover-none w3-hover-text-light-grey">HOME</a>
    </li>
    <li class="w3-hide-small w3-hide-medium">
      <a href="../plan/plan.php" class="w3-padding-large">PLAN</a>
    </li>
    <li class="w3-hide-small w3-hide-medium">
      <a href="../calendar/calendar.php" class="w3-padding-large">CALENDAR</a>
    </li>
    <li class="w3-hide-small w3-hide-medium">
      <a href="../list/list.php" class="w3-padding-large">LIST</a>
    </li>
    <li class="w3-hide-small w3-hide-medium">
      <a href="../about.php" class="w3-padding-large">ABOUT</a>
    </li>
    <?php
      if ($_SESSION['admin'] == 1) {
    ?>
    <li class="w3-hide-small w3-hide-medium">
      <a href="../user/admin.php" class="w3-padding-large w3-hover-blue">ADMIN</a>
    </li>
    <?php
      }
    ?>
    <div class="w3-right">
      <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/_includes/dbh.inc.php';
        $id = $_SESSION['user_id'];

        $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM users WHERE user_id = '$id'";
        $result = @mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        echo "<li class='w3-hide-small w3-hide-medium w3-padding-large'>" . $row['name'] . "</li>";
      ?>
        <li class="w3-hide-small w3-hide-medium w3-dropdown-hover">
            <a href="javascript:void(0)" class="w3-padding-large" title="More">ACCOUNT <i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <div class="w3-dropdown-content w3-card-4">
                <a href="../" class="w3-padding-large">PROFILE</a>
                <a href="../account/family/members.php" class="w3-padding-large">FAMILY</a>
                <a href="../" class="w3-padding-large">RECIPES</a>
                <a href="../" class="w3-padding-large w3-hover-theme">UPGRADE</a>
                <a href="../_includes/user/logout.inc.php" class="w3-padding-large w3-hover-red">LOGOUT</a>
            </div>
        </li>
    </div>
  </ul>
</div>

<!-- Navigation Bar for small devices -->
<div id="smallNav" class="w3-hide w3-hide-large w3-top" style="margin-top:50px">
  <ul class="w3-navbar w3-left-align w3-dark-grey">
    <li><a href="../plan/plan.php" class="w3-padding-large">PLAN</a></li>
    <li><a href="../calendar/calendar.php" class="w3-padding-large">CALENDAR</a></li>
    <li><a href="../list/list.php" class="w3-padding-large">LIST</a></li>
    <li><a href="../about.php" class="w3-padding-large">ABOUT</a></li>
    <?php
      if ($_SESSION['admin'] == 1) {
    ?>
    <li><a href="../user/admin.php" class="w3-padding-large w3-hover-blue">ADMIN</a></li>
    <?php
      }
    ?>
      <li class="w3-dropdown-hover w3-right">
          <a href="javascript:void(0)" class="w3-padding-large w3-hover-theme" title="More">ACCOUNT <i class="fa fa-caret-down" aria-hidden="true"></i></a>
          <div class="w3-dropdown-content w3-card-4">
              <a href="../" class="w3-padding-large">PROFILE</a>
              <a href="../account/family/members.php" class="w3-padding-large">FAMILY</a>
              <a href="../" class="w3-padding-large">RECIPES</a>
              <a href="../" class="w3-padding-large">UPGRADE</a>
              <a href="../_includes/user/logout.inc.php" class="w3-padding-large w3-red">LOGOUT</a>
          </div>
      </li>
  </ul>
</div>

<script>
  // Used to toggle the menu on small screens when clicking on the menu button (three bars)
  function showMenu() {
      var x = document.getElementById("smallNav");
      if (x.className.indexOf("w3-show") === -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }
</script>
