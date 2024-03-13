<?php
session_start();

require('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminName = $_POST["admin_name"];
    $adminPassword = $_POST["admin_password"];

    $checkAdminQuery = "SELECT * FROM `admin` WHERE `admin_name` = '$adminName' AND `admin_password` = '$adminPassword'";
    $result = mysqli_query($con, $checkAdminQuery);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin['id'];

        header("Location: home.php");
        exit();
    } else {
        echo "Incorrect admin name or password. Please try again.";
    }
}


if (isset($_GET['logout'])) {
    session_unset();

    
    session_destroy();

    header("Location: index.php");
    exit();
}


mysqli_close($con);
