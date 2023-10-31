<?php
session_start();
include("header.php");
?>

<section class="container-fluid mt-5">
    <div class="text-center">
        <h1>Step Aboard the CrewCraft Experience</h1>
        <h4 class="text-secondary">Empowering Your Creative Crews</h4>
        <p>
            <?php
            if (!isset($_SESSION["email"])) {
                echo "<p class='fw-medium'>Welcome back! <a href='login.php'>Sign in</a> to continue</p>";
            }
            ?>
        </p>
    </div>

</section>
<?php include("footer.php"); ?>