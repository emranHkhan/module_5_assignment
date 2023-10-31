<?php
session_start();

$page_title = "Edit Role";
include("header.php");

$role = "";
$email = "";
$username = "";
$roles = ["none", "admin", "user", "manager"];

if ($_SESSION["role"] != "admin" || empty($_GET["email"])) {
    header("Location:index.php");
    die();
}


if (isset($_GET["role"]) && isset($_GET["email"]) && isset($_GET["username"])) {
    $role = $_GET["role"];
    $email = $_GET["email"];
    $username = $_GET["username"];

    if ($_SESSION["email"] == $_GET["email"]) {
        header("Location:admin.php");
        die();
    }

    $roles = array_filter($roles, fn ($currentRole) => $currentRole != $role);
}


if (isset($_POST["submit"]) && isset($_POST["role"])) {
    $selectedValue = $_POST["role"];

    $filename = "./data/data.json";
    $data = file_get_contents($filename);
    $decodedData = json_decode($data, true);

    $emails = array_column($decodedData, "email");
    $index = array_search($email, $emails);

    $currentUserInfo = $decodedData[$index];

    if ($selectedValue == 'none' && array_key_exists("role", $currentUserInfo)) {
        unset($currentUserInfo["role"]);
        $decodedData[$index] = $currentUserInfo;
        file_put_contents($filename, json_encode($decodedData));
    } else if ($selectedValue == 'none' && !array_key_exists("role", $currentUserInfo)) {
        file_put_contents($filename, json_encode($decodedData));
    } else if ($selectedValue != 'none' && array_key_exists("role", $currentUserInfo)) {
        $currentUserInfo["role"] = $selectedValue;
        $decodedData[$index] = $currentUserInfo;
        file_put_contents($filename, json_encode($decodedData));
    } else if ($selectedValue != 'none' && !array_key_exists("role", $currentUserInfo)) {
        $currentUserInfo["role"] = $selectedValue;
        $decodedData[$index] = $currentUserInfo;;
        file_put_contents($filename, json_encode($decodedData));
    }

    header("Location:admin.php");
}



?>

<section class="container-fluid w-25 mt-5">
    <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <p class="fw-semibold text-secondary">Username: <?= $username ?></p>
        <p class="fw-semibold text-secondary">Email: <?= $email ?></p>
        <form method="POST">
            <label for="role" class="fw-semibold">Change Role:</label>
            <select class="form-select my-3" name="role" id="role">
                <option selected value=<?= $role ?>><?= $role ?></option>
                <?php
                foreach ($roles as $role) {
                    echo "<option value='{$role}'>{$role}</option>";
                }
                ?>
            </select>
            <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</section>
<?php include("footer.php"); ?>