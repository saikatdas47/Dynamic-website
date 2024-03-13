<?php
include('admin/db_config.php');
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

$userID = $_SESSION['user_id'];

// Query to get the user details
$userQuery = "SELECT * FROM `user` WHERE `id` = ?";
$stmt = mysqli_prepare($con, $userQuery);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$userResult = mysqli_stmt_get_result($stmt);

// Check if user details are found
if ($userResult && $user = mysqli_fetch_assoc($userResult)) {
    // Display user profile information
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
        <?php require('inc/links.php'); ?>
        <title>The Mark Hotel</title>
    </head>
    <style>

    </style>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php require('inc/header.php'); ?>


                <main role="main" class="col-md-10 ml-sm-auto content bg-light p-2">

                    <div class="container-fluid ">
                        <div class="row">
                            
                            <!-- Display user profile information -->
                            <h1 class="fw-bold text-center text-light mt-5 bg-danger mb-5">User Profile</h1>

                            <p>Name: <?php echo $user['name']; ?></p>
                            <p>Username: <?php echo $user['user_name']; ?></p>
                            <p>Email: <?php echo $user['email']; ?></p>
                           

                            <!-- Display booking details -->
                            <h2 class="fw-bold text-center text-dark mt-5">Booking Details</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Room Name</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>Days</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Query to get booking details for the logged-in user
                                    $bookingQuery = "SELECT b.`sr_no`, b.`roomname`, b.`checkin`, b.`checkout`, r.`price` FROM `room_booking` b
                         JOIN `rooms` r ON b.`roomsr_no` = r.`sr_no`
                         WHERE b.`usersr_no` = ?";
                                    $stmtBooking = mysqli_prepare($con, $bookingQuery);
                                    mysqli_stmt_bind_param($stmtBooking, "i", $userID);
                                    mysqli_stmt_execute($stmtBooking);
                                    $bookingResult = mysqli_stmt_get_result($stmtBooking);
                                    $i = 1;
                                    while ($booking = mysqli_fetch_assoc($bookingResult)) {
                                        // Calculate days and price
                                        $checkInDate = new DateTime($booking['checkin']);
                                        $checkOutDate = new DateTime($booking['checkout']);
                                        $days = $checkInDate->diff($checkOutDate)->days;

                                        // Calculate price using the fetched room price
                                        $price = $days * $booking['price'];

                                        echo '<tr>';
                                        echo '<td>' . $i . '</td>';
                                        echo '<td>' . $booking['roomname'] . '</td>';
                                        echo '<td>' . $booking['checkin'] . '</td>';
                                        echo '<td>' . $booking['checkout'] . '</td>';
                                        echo '<td>' . $days . '</td>';
                                        echo '<td>' . $price . '</td>';
                                        echo '<td>
                                                <form method="post" action="delete_booking.php">
                                                    <input type="hidden" name="booking_id" value="' . $booking['sr_no'] . '">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this booking?\')">Cancel</button>
                                                </form>
                                            </td>';
                                        echo '</tr>';
                                        $i++;
                                    }

                                    
                                    mysqli_stmt_close($stmtBooking);
                                    ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </main>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <!-- Initialize Swiper -->


        <script>
            function deleteBooking(bookingId) {
                // You can implement an AJAX request or form submission here to delete the booking
                // For simplicity, I'm using a confirm dialog to simulate the deletion
                var confirmDelete = confirm("Are you sure you want to delete this booking?");
                if (confirmDelete) {
                    // You can implement the actual deletion logic here
                    alert("Booking deleted successfully. You can implement the actual deletion logic.");
                }
            }
        </script>

    </body>

    </html>

<?php
} else {
    // User details not found
    echo "Error fetching user details.";
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($con);
?>