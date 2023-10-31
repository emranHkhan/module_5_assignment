<?php
session_start();

if ($_SESSION["role"] != "manager") {
    header("Location:index.php");
    die();
}


$page_title = "manager";
include("header.php");

?>

<div class="container-fluid w-50 mt-5">
    <table class="table table-bordered table-hover shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filename = "./data/data.json";
            $data = file_get_contents($filename);
            $decodedData = json_decode($data, true);
            foreach ($decodedData as $row) {
                $role = empty($row['role']) ? 'none' : $row['role'];
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $role . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>