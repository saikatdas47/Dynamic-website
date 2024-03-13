<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];

    // Check if the user  booked a room
    $checkBookingQuery = "SELECT COUNT(*) as booking_count FROM `room_booking` WHERE `usersr_no` = '$userId'";
    $checkBookingResult = mysqli_query($con, $checkBookingQuery);

    if ($checkBookingResult === false) { // ensures that not only the value is false, but also that the type is the same. 
        echo 'Error in query: ' . mysqli_error($con);
    } else {
        $bookingCount = mysqli_fetch_assoc($checkBookingResult)['booking_count'];

        // If the user has no bookings, proceed with deletion
        if ($bookingCount == 0) {
            // Delete user
            $deleteUserQuery = "DELETE FROM `user` WHERE `id` = '$userId'";
            $deleteUserResult = mysqli_query($con, $deleteUserQuery);

            if ($deleteUserResult === false) {
                echo 'Error in query: ' . mysqli_error($con);
            } else {
                header("Location: user.php");
                exit();
            }
        } else {
            // Show alert if user has booked a room
            echo '<script>alert("Cannot delete user. User has booked a room."); window.location.href = "user.php";</script>';
        }

        // Free the result set
        mysqli_free_result($checkBookingResult);
    }
} else {
    echo 'Invalid request.';
}
?>
