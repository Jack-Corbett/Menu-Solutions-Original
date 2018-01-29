<div class="w3-top">
  <ul class="w3-navbar w3-card-2 w3-dark-grey w3-left-align">
    <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
      <a class="w3-padding-large" href="javascript:void(0)" onclick="showMenu()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    </li>
    <li>
      <a href="../" class="w3-padding-large w3-hover-none w3-hover-text-light-grey">HOME</a>
    </li>
    <li class="w3-hide-small">
      <a href="../about.php" class="w3-padding-large">ABOUT</a>
    </li>
    <li class="w3-right w3-hide-small">
      <a href="../user/login.php" class="w3-padding-large w3-hover-theme">LOGIN</a>
    </li>
  </ul>
</div>

<!-- Navigation Bar for small devices -->
<div id="smallNav" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:50px">
  <ul class="w3-navbar w3-left-align w3-dark-grey">
    <li>
      <a href="../about.php" class="w3-padding-large">ABOUT</a>
    </li>
    <li class="w3-right">
      <a href="../user/login.php" class="w3-padding-large w3-hover-theme">LOGIN</a>
    </li>
  </ul>
</div>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function showMenu() {
    var x = document.getElementById("smallNav");
    if (x.className.indexOf("w3-show") === -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
