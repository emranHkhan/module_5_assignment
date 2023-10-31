<?php
session_start();

$page_title = "Log In";
include("header.php");


if (isset($_SESSION["email"])) {
    header("Location: index.php");
    die();
}

$errors = [];
$filename = "./data/data.json";
$role = "";
$username = "";

if (isset($_POST["submit"])) {
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        array_push($errors, "All fields are required.");
    }

    if (!empty($email) && !empty($password)) {
        if (empty(file_get_contents($filename))) {
            array_push($errors, "Invalid email or password.");
        } else {
            $data = file_get_contents($filename);
            $decodedData = json_decode($data, true);
            $emails = array_column($decodedData, "email");
            // $passwords = array_column($decodedData, "password");
            $index = array_search($email, $emails);

            // echo "<pre>";
            // echo ($decodedData[$index]["password"]) . "<br/>";
            // echo sha1($password);
            // echo "</pre>";
            // die();

            $role = empty($decodedData[$index]["role"]) ? "" : $decodedData[$index]["role"];
            $username = $decodedData[$index]["username"];

            if (!in_array($email, $emails) || ($decodedData[$index]["password"] != sha1($password))) {
                array_push($errors, "Invalid email or password.");
            }

            // if (!in_array(sha1($password), $passwords)) {
            //     array_push($errors, "Invalid password.");
            // }
        }
    }

    if (count($errors) == 0) {
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $role;

        if (empty($_SESSION["role"])) {
            header("Location: ghost.php");
            die();
        } else if ($role == "user") {
            header("Location: user.php");
            die();
        } else if ($role == "manager") {
            header("Location: manager.php");
            die();
        } else {
            header("Location: admin.php");
            die();
        }
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
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="abc@mail.com" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        </div>
        <div class="mb-3 password-container-div">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="At least 6 characters" name="password">
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>
        <p>Don't have an account? Please <a href="signup.php">sign up</a></p>
        <button type="submit" class="btn btn-secondary" name="submit">Log In</button>
        <div class="mt-3 text-secondary">
            <p>Admin Email: imranhkhan@gmail.com</p>
            <p>Admin Password: 123456</p>
        </div>
    </form>
</section>


<script>
    const togglePassword = document
        .querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute using
        // getAttribure() method
        const type = password
            .getAttribute('type') === 'password' ?
            'text' : 'password';
        password.setAttribute('type', type);
        // Toggle the eye and bi-eye icon
        this.classList.toggle('bi-eye');
    });
</script>

<?php include("footer.php"); ?>