<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roomName = $_POST["roomName"];
    $feature1 = $_POST["feature1"];
    $feature2 = $_POST["feature2"];
    $area = $_POST["area"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $imgPath = $_POST["imgPath"];

    $insertRoomQuery = "INSERT INTO `rooms` (`name`, `feature1`, `feature2`, `area`, `price`, `quantity`, `img_path`) VALUES ('$roomName', '$feature1', '$feature2', '$area', '$price', '$quantity', '$imgPath')";

    $insertRoomResult = mysqli_query($con, $insertRoomQuery);

    if (!$insertRoomResult) {
        echo 'Error in query: ' . mysqli_error($con);
    } else {
        header("Location: rooms.php"); 
        exit();
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
//delete
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["sr_no"])) {
    $delete_sr_no = $_GET["sr_no"];

    $deleteRoomQuery = "DELETE FROM `rooms` WHERE `sr_no` = '$delete_sr_no'";
    $deleteRoomResult = mysqli_query($con, $deleteRoomQuery);

    if (!$deleteRoomResult) {
        echo 'Error in query: ' . mysqli_error($con);
    } else {
        header("Location: rooms.php");
        exit();
    }
}
?>
