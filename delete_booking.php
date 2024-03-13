<?php
include('admin/db_config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingID = $_POST["booking_id"];

    $deleteQuery = "DELETE FROM `room_booking` WHERE `sr_no` = ?";
    $stmtDelete = mysqli_prepare($con, $deleteQuery);//prepared statement
    mysqli_stmt_bind_param($stmtDelete, "i", $bookingID);

    if (mysqli_stmt_execute($stmtDelete)) {
        header("Location: frontendUser.php");
        exit();
    } else {
        // Deletion failed
        echo "Error: " . mysqli_error($con);
    }
//statement close
    mysqli_stmt_close($stmtDelete);
}
//db connection clos
mysqli_close($con);
?>
