<?php
include '../_assets/header.php';
include '../_assets/standardstyle.php';
?>

<div class="page-wrap">

    <!-- Navigation Bar -->
    <?php
    if (isset($_SESSION['user_id'])) {
        include '../_assets/navbar.loggedin.php';
        ?>
        <br/><br/>

        <div class="w3-container w3-animate-opacity">
            <?php
            include "../_includes/dbh.inc.php";

            //Takes the URL
            $url = $_SERVER['REQUEST_URI'];
            //Picks out the numbers from the URL which dictates the recipe id
            $recipe_id = filter_var($url, FILTER_SANITIZE_NUMBER_INT);

            if ($recipe_id === NULL) {
                echo "<p class='w3-text-red w3-center'>Error</p><p class='w3-center'>Please use the calendar page and click the recipe you want to view to access this page</p>";
            } else {

                $sql = "SELECT name, instructions, cook_time FROM recipes WHERE recipe_id = '$recipe_id'";
                $result = @mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $recipe_name = $row['name'];
                $recipe_instructions = nl2br($row['instructions']);
                $cook_time = $row['cook_time'];

                $sql = "SELECT ingredient_id, quantity FROM ingredients_recipes WHERE recipe_id = '$recipe_id'";
                $result = @mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $ingredient_id[] = $row['ingredient_id'];
                    $quantity[] = $row['quantity'];
                }

                $sql = "SELECT no_eating FROM plan_recipes WHERE recipe_id = '$recipe_id'";
                $result = @mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $no_eating = $row['no_eating'];
                }
                ?>

                <div class="w3-container w3-card-4 w3-bottombar">
                    <h2><?php echo $recipe_name; ?></h2>
                </div>

                <h3>Ingredients:</h3>

                <p>
                    <?php
                    $amount = array();
                    if (isset($ingredient_id)) {
                        for ($i = 0; $i < COUNT($ingredient_id); $i++) {
                            $amount[$i] = $quantity[$i] * $no_eating;
                            $sql = "SELECT ingredient_name, measurement FROM ingredients WHERE '$ingredient_id[$i]' = ingredient_id";
                            $result = @mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $measurement = $row['measurement'];
                            $name = $row['ingredient_name'];
                            if ($amount[$i] > 0) {
                                if ($measurement == "g" OR $measurement == "ml") {
                                    echo $amount[$i] . $measurement . " " . $name;
                                } else {
                                    echo $amount[$i] . " " . $measurement . " " . $name;
                                }
                            } else {
                                echo $name;
                            }
                            echo "<br />";
                        }
                    }
                    ?>
                </p>

                <h3>Instructions:</h3>
                <p><?php echo $recipe_instructions; ?></p>
                <h5>Cook Time: <?php echo $cook_time; ?> minutes</h5>
                <?php
            }
            ?>
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
