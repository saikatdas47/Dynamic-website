<?php
include('admin/db_config.php');
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check-user - logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // login page if not logged in
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST["user_id"];
    $userName = $_POST["user_name"];
    $roomId = $_POST["room_id"];
    $roomName = $_POST["room_name"];
    $checkInDate = $_POST["check_in_date"];
    $checkOutDate = $_POST["check_out_date"];

    $insertQuery = "INSERT INTO `room_booking` (`username`, `usersr_no`, `roomsr_no`, `roomname`, `checkin`, `checkout`) 
                    VALUES ('$userName', '$userId', '$roomId', '$roomName', '$checkInDate', '$checkOutDate')";

    if (mysqli_query($con, $insertQuery)) {
        header("Location: frontendUser.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
