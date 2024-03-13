<?php
include('admin/db_config.php');
session_start(); 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

$userID = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

// the user details
$userQuery = "SELECT * FROM `user` WHERE `id` = ?";
$stmt = mysqli_prepare($con, $userQuery);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$userResult = mysqli_stmt_get_result($stmt);

// Check if user details are found
if ($userResult && $user = mysqli_fetch_assoc($userResult)) {
   
}
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

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">

                <!-- The Mark -->
                <h1 class="fw-bold text-center text-light mt-0 p-2 bg-danger mb-5">Check Our Room</h1>
                <p class="fw-bold text-center text-dark">Description</p>

                <!-- Room Card Section -->
                <h2 class="fw-bold text-center text-dark p-2 mt-5">Our Rooms</h2>

                <div class="container">
                    <div class="row">

                        <?php
                        // Fetch room data from the database (replace this with your actual query)
                        $roomQuery = "SELECT `sr_no`, `name`, `price`, `feature1`, `feature2`, `area`, `quantity`, `img_path` FROM `rooms`";
                        $roomResult = mysqli_query($con, $roomQuery);

                        if ($roomResult === false) {
                            die('Error in query: ' . mysqli_error($con));
                        }

                        while ($room = mysqli_fetch_assoc($roomResult)) {
                            echo '<div class="col-lg-4 col-md-6 col-sm-12">';
                            echo '<div class="room-card rounded shadow p-2">';
                            echo '<div class="room-details p-2">';
                            echo '<img src="images/' . $room['img_path'] . '" alt="Room Image" class="img-fluid">';
                            echo '<div class="room-info mt-2 p-2">';
                            echo '<h4>' . $room['name'] . '</h4>';
                            echo '<p>Price: ' . $room['price'] . ' TK per night</p>';
                            echo '<p>Features: ' . $room['feature1'] . ', ' . $room['feature2'] . '</p>';
                            echo '<p>Area: ' . $room['area'] . '</p>';
                            echo '<p>Quantity: ' . $room['quantity'] . '</p>';
                            echo '<button class="btn btn-info" onclick="openBookingModal(' . $room['sr_no'] . ', \'' . $room['name'] . '\', ' . $user['id'] . ', \'' . $user['user_name'] . '\')">Book Now</button>';
                            echo '</div></div></div></div>';
                        }
                        ?>

                    </div>
                </div>

                <!-- modal -->
                <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookingModalLabel">Book Room</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="bookingForm" method="post" action="book_room.php">
                                    <!--  hidden input fields for room ID -->
                                    <input type="hidden" name="room_id" id="roomId" value="">
                                    <input type="hidden" name="room_name" id="roomName" value="">
                                    <input type="hidden" name="user_id" id="userId" value="">
                                    <input type="hidden" name="user_name" id="userName" value="">
                                    <div class="form-group">
                                        <label for="checkInDate">Check-In Date:</label>
                                        <input type="date" class="form-control" id="checkInDate" name="check_in_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="checkOutDate">Check-Out Date:</label>
                                        <input type="date" class="form-control" id="checkOutDate" name="check_out_date" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Book Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        function openBookingModal(roomId, roomName, userId, userName) {
            document.getElementById('roomId').value = roomId;
            document.getElementById('roomName').value = roomName; 

            document.getElementById('userId').value = userId;
            document.getElementById('userName').value = userName; 

            // Open the booking modal
            $('#bookingModal').modal('show');
        }
    </script>
</body>

</html>