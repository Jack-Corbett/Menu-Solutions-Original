<?php
include '../_assets/header.php';
include '../_assets/standardstyle.php';
?>

<div class="page-wrap">

    <?php
    if (isset($_SESSION['user_id'])) {
        include '../_assets/navbar.loggedin.php';
        ?>
        <br/><br/>

        <div class="w3-container">
            <h1>Family</h1>
            <p>Here you can see the family members that have been added and their individual profiles. You can edit your
                submitted information for each person or add a new family member by pressing the button below. This
                information will be used on the plan page to tell us who will be eating each day.</p>
        </div>

        <!-- Members table -->
        <ul class="w3-ul w3-card-4 w3-animate-opacity">
            <?php
            include '../_includes/dbh.inc.php';
            include '../_includes/family/members-fetch.inc.php';

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $name = $row['name'];
                $member_id = $row['member_id'];
                $gender = $row['gender'];
                ?>
                <li class="w3-padding-16">
                    <a href="removemember.php?member=<?php echo $member_id; ?>"
                       class="w3-closebtn w3-margin-right w3-large w3-hover-text-red">×</a>
                    <a href="editmember.php?member=<?php echo $member_id; ?>" class="w3-margin-right w3-right"> <i
                                class="fa fa-pencil w3-hover-text-blue" aria-hidden="true"></i></a>
                    <img src="
                         <?php
                         if ($gender == 'm') {
                             echo '../_img/male_user.png';
                         } elseif ($gender == 'f') {
                             echo '../_img/female_user.png';
                         } else {
                             echo '../_img/other_user.png';
                         }
                         ?>"
                         class="w3-left w3-circle w3-margin-right" style="width:30px">
                    <span class="w3-large"><?php echo $name; ?></span>
                    <br/>
                </li>

                <?php
            }
            ?>
        </ul>

        <br/>

        <!-- Add family member button -->
        <div class="w3-container w3-padding">
            <a class="w3-btn-floating w3-theme-d1 w3-hover-dark-grey" style="text-decoration: none"
               href="addmember.php">+</a>
        </div>

        <br/>

        <?php
    } else {
        include '../_assets/navbar.loggedout.php';
        include '../_assets/loginerror.php';
    }
    ?>
</div>

<?php
include '../_assets/footer.php';
?>
