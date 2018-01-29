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

        <div class="w3-container w3-center">
            <h1>Delete Plan</h1>

            <div class="w3-card-4 w3-center">
                <br/>
                <p>
                    <?php
                    $url = $_SERVER['REQUEST_URI'];
                    if (strpos($url, 'delete') !== false) {
                        echo "Do you want to delete your latest plan?";
                    } else {
                        echo "You already have a plan for the coming week. Do you wish to delete it?";
                    }
                    ?>
                </p>
                <a href="../_includes/plan/remove-plan.inc.php"
                   class="w3-btn w3-hover-dark-grey w3-theme-d1 w3-round-xlarge"><i class="fa fa-check"
                                                                                    aria-hidden="true"></i></a>
                <a href="plan.php" class="w3-btn w3-hover-dark-grey w3-red w3-round-xlarge"><i class="fa fa-times"
                                                                                               aria-hidden="true"></i></a>
                <br/><br/>
            </div>
        </div>

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
