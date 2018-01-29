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
            <h1>Edit</h1>

            <div class="w3-card-4 w3-animate-opacity">

                <br/>

                <?php
                include '../_includes/family/edit-fetch.inc.php';
                ?>

                <form action="../_includes/family/edit-update.inc.php" method="post">
                    <input autocomplete="off" value="<?php if (isset($first_name)) {
                        echo $first_name;
                    } ?>" type="text" name="firstname" placeholder="First Name" required><br/><br/>

                    <input autocomplete="off" value="<?php if (isset($last_name)) {
                        echo $last_name;
                    } ?>" type="text" name="lastname" placeholder="Surname" required><br/><br/>

                    <label>
                        <input type="radio" name="gender" value="m" <?php if ($gender == "m") {
                            echo "checked";
                        } ?>>
                        &emsp; Male &emsp;
                    </label>

                    <label>
                        <input type="radio" name="gender" value="f" <?php if ($gender == "f") {
                            echo "checked";
                        } ?>>
                        &emsp; Female &emsp;
                    </label>

                    <label>
                        <input type="radio" name="gender" value="o" <?php if ($gender == "o") {
                            echo "checked";
                        } ?>>
                        &emsp; Other &emsp;
                    </label>
                    <br/><br/>

                    Selected by default:<br/>
                    <label>
                        <input type="radio" name="default_ticked" value="1" <?php if ($default_ticked == 1) {
                            echo "checked";
                        } ?>>
                        &emsp; Yes &emsp;
                    </label>
                    <label>
                        <input type="radio" name="default_ticked" value="0" <?php if ($default_ticked == 0) {
                            echo "checked";
                        } ?>>
                        &emsp; No &emsp;
                    </label>
                    <br/><br/>

                    <input type="hidden" name="memberid" value="<?php echo $member_id; ?>">

                    <button type="submit" class="w3-btn w3-hover-dark-grey w3-theme-d1 w3-round-xlarge"><i
                                class="fa fa-check" aria-hidden="true"></i></button>
                    <a href="members.php" class="w3-btn w3-hover-dark-grey w3-red w3-round-xlarge"><i
                                class="fa fa-times" aria-hidden="true"></i></a>
                </form>

                <br/>

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
include '../_assets/footer.php'
?>
