<?php
session_start();
if (empty($_SESSION["email"]) || $_SESSION["role"] != "user") {
    header("Location:index.php");
    die();
}

$page_title = "user";
include("header.php");

?>

<div class="container-fluid w-25 mt-5">
    <p class="mb-2 fw-semibold">Users List</p>
    <table class="table table-bordered table-hover shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filename = "./data/data.json";
            $data = file_get_contents($filename);
            $decodedData = json_decode($data, true);
            foreach ($decodedData as $row) {
                if (!empty($row["role"]) && $row["role"] != "admin" && $row["role"] != "manager") {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>