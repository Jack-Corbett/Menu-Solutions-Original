<?php
include '../_assets/header.php';
include '../_assets/standardstyle.php';
?>

<div class="page-wrap">

    <!-- Navigation Bar -->
    <?php
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        include '../_assets/navbar.loggedin.php';
    } else {
        include '../_assets/navbar.loggedout.php';
    }
    ?>

    <br/><br/>

    <!-- Login Form -->
    <div class="w3-container w3-center">
        <h1>Login</h1>
        <div class="w3-card-4">
            <br/>
            <form action="../_includes/user/login.inc.php" method="post">
                <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input class="form-control" type="text" name="email" placeholder="Email" required>
                </div>
                <br/>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="w3-text-red">
                    <?php
                    $url = $_SERVER['REQUEST_URI'];
                    if (strpos($url, 'error=email') !== false) {
                        echo "This email has not been registered for an account";
                    } elseif (strpos($url, 'error=password') !== false) {
                        echo "The password you entered was incorrect";
                    } else {
                        echo "<br />";
                    }
                    ?>
                </div>
                <button type="submit" class="w3-btn w3-hover-dark-grey w3-animate-opacity w3-theme-d1">Login</button>
            </form>
            <br/>

            <?php
            if (isset($_SESSION['user_id']) AND $id !== NULL) {
                ?>
                <form action="../_includes/user/logout.inc.php">
                    <button type="submit" class="w3-btn w3-hover-red w3-animate-opacity w3-theme-d1">Log Out</button>
                </form>
                <?php
            }
            ?>

            <p>If you don&#39;t already have an account you can register for one below</p>
            <a href="register.php" class="w3-center w3-btn w3-hover-blue w3-animate-opacity w3-theme-d1">Register</a>
            <br/><br/>

        </div>
    </div>
    <br/>
</div>

<?php
include '../_assets/footer.php'
?>
