<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <script async src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <title><?= isset($page_title) ? $page_title : 'Crew Project' ?></title>

    <style>
        body {
            background-color: #F0F0F4;
        }

        /* form i {
            margin-left: 260px;
            margin-top: -20px;
            cursor: pointer;
        } */

        .password-container-div {
            position: relative;
        }

        .password-container-div i {
            position: absolute;
            right: 10px;
            top: 38px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand fw-bold" href="index.php">CREWCRAFT</a>
                <a class="text-decoration-none text-secondary fw-bold" href="index.php">Home</a>
            </div>

            <div class="navbar-nav">
                <a class="nav-link fw-bold" href='<?= $_SERVER['REQUEST_URI'] ?>'><?= isset($_SESSION["username"]) ? "Welcome, " . $_SESSION["username"] . "!" : "" ?></a>
                <?php
                if (isset($_SESSION["email"]) && $_SESSION["role"] != "" && $_SESSION["role"] != "none") {
                    $url = $_SESSION["role"] . ".php";
                    echo "<a class='nav-link fw-bold' href='{$url}'>Dashboard</a>";
                }

                ?>
                <a class="nav-link" href="logout.php"><?= isset($_SESSION["email"]) ? "Log Out" : "" ?></a>
                <a class="nav-link fw-bold" href="Login.php"><?= empty($_SESSION["email"]) ? "Log In" : "" ?></a>
            </div>
        </div>
    </nav>