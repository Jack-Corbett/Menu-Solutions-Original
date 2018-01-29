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
            <h1>Add</h1>

            <div class="w3-animate-opacity w3-card-4">
                <br/>
                <form action="../../_includes/family/add-member.inc.php" method="post">
                    <input type="text" name="firstname" placeholder="First Name" required><br/><br/>

                    <input type="text" name="lastname" placeholder="Surname" required><br/><br/>

                    <label>
                        <input type="radio" name="gender" value="m">
                        &emsp; Male &emsp;
                    </label>
                    <label>
                        <input type="radio" name="gender" value="f">
                        &emsp; Female &emsp;
                    </label>
                    <label>
                        <input type="radio" name="gender" value="o" checked>
                        &emsp; Other &emsp;
                    </label>
                    <br/><br/>

                    Selected by default:<br/>
                    <label>
                        <input type="radio" name="default_ticked" value="1" checked>
                        &emsp; Yes &emsp;
                    </label>
                    <label>
                        <input type="radio" name="default_ticked" value="0">
                        &emsp; No &emsp;
                    </label>
                    <br/><br/>

                    <button type="submit" class="w3-btn w3-hover-dark-grey w3-theme-d1 w3-round-xlarge"><i
                                class="fa fa-user-plus" aria-hidden="true"></i></button>
                    <a href="members.php" class="w3-btn w3-hover-dark-grey w3-red w3-round-xlarge"><i
                                class="fa fa-times" aria-hidden="true"></i></a>
                </form>
                <br/>
            </div>
            <br/>
        </div>

        <div class="w3-text-red w3-center">
            <?php
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, 'error=empty') !== false) {
                echo "Please complete both first name and surname";
            }
            ?>
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
