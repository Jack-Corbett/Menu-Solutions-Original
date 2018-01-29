<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/header.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/standardstyle.php');
?>

<div class="page-wrap">

    <?php
    if (isset($_SESSION['user_id'])) {
        include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/navbar.loggedin.php');
        ?>
        <br/><br/>

        <div class="w3-container w3-center">
            <h1>Remove</h1>

            <div class="w3-card-4">
                <br/>

                <?php
                include ($_SERVER['DOCUMENT_ROOT'] . '/_includes/family/remove-fetch.inc.php');
                echo "<p>Do you want to remove " . $row['name'] . "?</p>";
                ?>

                <a href="../../_includes/family/remove-delete.inc.php?member=<?php echo $member_id; ?>"
                   class="w3-btn w3-hover-dark-grey w3-theme-d1 w3-round-xlarge"><i class="fa fa-check"
                                                                                    aria-hidden="true"></i></a>
                <a href="members.php" class="w3-btn w3-hover-dark-grey w3-red w3-round-xlarge"><i class="fa fa-times"
                                                                                                  aria-hidden="true"></i></a>

                <br/><br/>
            </div>
        </div>

        <?php
    } else {
        include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/navbar.loggedout.php');
        include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/loginerror.php');
    }
    ?>

</div>

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/_assets/footer.php');
?>
