<?php
session_start();

$page_title = "Admin";
include("header.php");

if ($_SESSION["role"] != "admin") {
    header("Location: index.php");
    die();
}
?>


<div class="container-fluid w-50 mt-5">
    <table class="table table-bordered table-hover shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filename = "./data/data.json";
            $data = file_get_contents($filename);
            $decodedData = json_decode($data, true);
            foreach ($decodedData as $row) {
                $role = empty($row['role']) ? 'none' : $row['role'];
                $url = "edit.php?role=" . urlencode($role) . '&email=' . urlencode($row['email']) . '&username=' . urlencode($row['username']);
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $role . "</td>";
                if ($_SESSION["email"] == $row["email"]) {
                    echo "<td class='text-danger fw-semibold text-uppercase'>access denied</td>";
                } else {
                    echo "<td><a href=$url>Change Role</a></td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>