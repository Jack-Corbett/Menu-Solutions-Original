<?php
include '_assets/header.php';
?>

<style>
    body, h1, h2, h3, h4, h5, h6 {
        font-family: "Lato", sans-serif;
    }

    h1, h2, h4, h5, h6 {
        height: 100%;
        color: #777;
        line-height: 1.8;
    }

    body, html, h3 {
        height: 100%;
        color: #FFFFFF;
        line-height: 1.8;
    }

    /* Create a Parallax Effect */
    .bgimg-1, .bgimg-2, .bgimg-3 {
        opacity: 0.8;
        background: no-repeat fixed center;
        background-size: cover;
    }

    /* First image */
    .bgimg-1 {
        background-image: url(_img/raspberries.jpeg);
        min-height: 400px;
    }

    /* Second image */
    .bgimg-2 {
        background-image: url(_img/blueberries.jpeg);
        min-height: 300px;
    }

    /* Third image */
    .bgimg-3 {
        background-image: url(_img/strawberries.jpeg);
        min-height: 300px;
    }

    /* Turn off parallax scrolling for tablets and mobiles */
    @media only screen and (max-width: 768px) {
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: scroll;
        }
    }
</style>

<!-- Navigation Bar -->
<?php
if (isset($_SESSION['user_id'])) {
    include '_assets/navbar.loggedin.php';
} else {
    include '_assets/navbar.loggedout.php';
}
?>

<!-- First Parallax Image -->
<div class="bgimg-1 w3-display-container" style="white-space:nowrap;">
    <span class="w3-display-middle w3-center w3-padding-xlarge w3-black w3-xlarge w3-wide w3-animate-opacity">MENU SOLUTIONS</span>
</div>

<!-- Container Introduction -->
<div class="w3-container w3-row-padding w3-dark-grey ">
    <h3 class="w3-center">How it Works</h3>
    <p class="w3-center">Menu Solutions provides an advanced meal planner which is accessible
        to all. It uses advanced algorithms based on the dietry reqirements of each person to pick
        recipes that are suitable. It also caters for the modern family by allowing users to input
        who will be eating each day and how much time is availible to cook to ensure everyone always
        gets a tasty, healthy meal. Another focus of Menu Solutions is to decrease the amount of food
        wastage and so it will build you a shopping list with everything you need to cook healthy meals
        every day of the week meaning you only buy what you need. This is better for the planet and for your pocket.
        So what are you waiting for? Lets get started...</p>
    <br/>
</div>

<!-- Second Parallax Image -->
<div class="bgimg-2 w3-display-container">
    <span class="w3-display-middle w3-xlarge w3-wide w3-black w3-padding-large">GETTING STARTED</span>
</div>

<!-- Container Instructions -->
<div class="w3-container w3-row-padding w3-dark-grey">
    <h3 class="w3-center">Creating an Account</h3>
    <p class="w3-center">In order to start using this Menu Solutions please create an account by clicking on
        the login button at the top right of the screen. Once your account has been set up, by clicking register from
        the login page,
        you will notice five more tabs in your naviagtion bar: Family, Plan, Calendar, List and Account. If you
        do not see logout in the top right corner this is because you are not yet logged in and should
        press login and enter your username and password that you used when you registered.
    </p>
    <h3 class="w3-center">Generating your first Meal Plan</h3>
    <p class="w3-center"> Start with the family tab where you can add your family members and fill in
        some basic information for each person about their dietry requirements. We will use this when generating
        the meal plan to ensure everyone in the family gets what they need. The next step is to access
        the plan tab which enables you to input who will be eating each day and tell us how long you
        will have to cook. This means our meal plans can be very flexible and will fit in around your
        normal routine. Once you have pressed the generate button on this page your calendar page will
        be populated. Don't worry if plans change you can easily overwrite your current plan with a new one!
    </p>
    <h3 class="w3-center">Cooking your Food</h3>
    <p class="w3-center">The calendar tab is where you can see your meal plan for the current week. It is also how
        you will access your recipes each day when cooking. To see the instructions for that day just click the recipe
        name
        and it will take you to a page with everything you need to get cooking. It even works out the quantities based
        on
        how many are eating for you. Finally there is the list tab which generates a shopping list for your current meal
        plan,
        categorised to make picking up the required ingredients a breeze.
    </p>
    <br/>
</div>

<!-- Third Parallax Image -->
<div class="bgimg-3 w3-display-container">
    <span class="w3-display-middle w3-xlarge w3-wide w3-black w3-padding-large">ABOUT ME</span>
</div>

<!-- Container About Me -->
<div class="w3-container w3-row-padding w3-dark-grey">
    <div class="w3-twothird">
        <h3>Jack Corbett</h3>
        <p>I am currently studying my A Levels at Barton Peveril College and this is my second year Computer Science
            Project.
            When given the task to code pretty much anything I wanted to I really wanted to solve a problem and create a
            product
            that I was proud of and believed actually warranted the time and effort put into it. I know that trying to
            decide what
            to eat each day is a struggle for many families and that is why often bad habbits are started. It is so
            important to
            eat healthy food as it affects everything you do and so I wanted to make it easy for everyone by providing a
            simple
            solution to a complex problem.</p>
        <p>Another issue I wanted to solve was to decrease food wastage which along with diet is the other biggest issue
            that we
            face. That is why I have built in an inventory system so that you only buy what you need and reuse
            ingredients rather than
            just getting rid of the excess. This site is still in very early development and many of the final features
            are not yet
            present but I would really appreciates anyones support and suggestions on how I could improve it as I am
            working alone on
            this project. I hope you enjoy what I have created.
    </div>
    <div class="w3-third">
        <br/>
        <img src="_img/me.jpg" class="w3-card-4" style="width:100%">
        <p class="w3-text-theme">Presenting for Google at the BETT Show 2016</p>
    </div>
</div>

<!-- Credits to sources -->
<div class="w3-container w3-row-padding w3-dark-grey w3-topbar">
    <h3 class=" w3-center">Credits</h3>
    <ul>
        <li type="square">W3 Schools for allowing open use of their CSS template which is excellent for beginers to
            webdesign and
            their wide range of tutorials
        </li>
        <li type="square">PHP and MySQL for Dynamic Websites by Larry Ulman is a brilliant book that takes you step by
            step
            through building your website and keeping it secure
        </li>
        <li type="square">Unsplash for being an amazing source for high quality images</li>
        <li type="square">Stack Overflow for helping me fix all of the issues I ran into along the way</li>
        <li type="square">Logo Makr for being a great tool for building the logos used on the site</li>
    </ul>
    <br/>
</div>

<?php
include '_assets/footer.php'
?>
