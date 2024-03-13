<?php
include('db_config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = $_POST["booking_id"];

    $deleteQuery = "DELETE FROM `room_booking` WHERE `sr_no` = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $bookingId);

        if (mysqli_stmt_execute($stmt)) {
            
            header("Location: booking.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


mysqli_close($con);
?>
<!-- this feature is not added in admin pannel -->