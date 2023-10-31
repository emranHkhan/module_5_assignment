<?php
session_start();

$page_title = "Ghost";
include("header.php");

$username = $_SESSION["username"];
if (!empty($_SESSION["role"])) {
    header("Location: index.php");
    die();
}
?>
<section class="container-fluid w-50 text-center">
    <div class="shadow-sm p-3 mt-5 bg-body-tertiary rounded text-secondary fw-semibold">
        <p>Hello, <b class="text-body"><?= $username ?></b>. Thanks for visiting our website!</p>
        <p>Currently you do not have any role.</p>
        <p>Please be patient until the admin assigns you with a role.</p>
        <p>Peace!!!</p>
    </div>
</section>
<?php include("footer.php"); ?>