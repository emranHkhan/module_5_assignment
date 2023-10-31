<?php
$page_title = "Sign Up";
include("header.php");

session_start();
if (isset($_SESSION["email"])) {
    header("Location: index.php");
    die();
}

$errors = [];
$filename = "./data/data.json";
$allEmpty = false;
if (isset($_POST["submit"])) {
    $username = trim($_POST["username"]);
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($username) || empty($email) || empty($password)) {
        array_push($errors, "All fields are required.");
        $allEmpty = true;
    }
    if (!$allEmpty && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }
    if (!$allEmpty && strlen($password) < 6) {
        array_push($errors, "Password must be at least 6 characters long.");
    }

    if (!empty($email) && !empty(file_get_contents($filename))) {
        $data = file_get_contents($filename);
        $decodedData = json_decode($data, true);
        $emails = array_column($decodedData, "email");
        in_array($email, $emails) && array_push($errors, "Email already exists!");
    }

    if (count($errors) == 0) {
        $inputData = ["username" => $username, "email" => $email, "password" => sha1($password)];
        if (empty(file_get_contents($filename))) {
            file_put_contents($filename, json_encode([$inputData]));
        } else {
            $data = file_get_contents($filename);
            $decodedData = json_decode($data, true);
            array_push($decodedData, $inputData);
            file_put_contents($filename, json_encode($decodedData));
        }
        header("Location: login.php");
        die();
    }
}

?>

<section class="container-fluid w-25 mt-5">
    <form method="POST" class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <?php
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger p-2'>{$error}</div>";
        }
        ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username..." value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="abc@mail.com" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="At least 6 characters">
        </div>
        <p>Already have an account? <a href="login.php">log in</a></p>
        <button type="submit" class="btn btn-secondary" name="submit">Sign Up</button>
    </form>
</section>

<?php include("footer.php"); ?>