<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    <title>Booking setting</title>
</head>
<style>
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">
                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">Booking Management</h1>

                <!-- Booking Details Table -->
                <table class="table">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Username</th>
            <th>User ID</th>
            <th>Room ID</th>
            <th>Room Name</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Days</th>
            <th>Price</th>
         
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch booking details 
        $bookingQuery = "SELECT b.`sr_no`, b.`username`, b.`usersr_no`, b.`roomsr_no`, b.`roomname`, b.`checkin`, b.`checkout`, r.`price` 
                        FROM `room_booking` b
                        JOIN `rooms` r ON b.`roomsr_no` = r.`sr_no`";
        $bookingResult = mysqli_query($con, $bookingQuery);

        if ($bookingResult === false) {
            die('Error in query: ' . mysqli_error($con));
        }

        $i = 1;
        while ($booking = mysqli_fetch_assoc($bookingResult)) {
            // Calculattion
            $checkInDate = new DateTime($booking['checkin']);
            $checkOutDate = new DateTime($booking['checkout']);
            $days = $checkInDate->diff($checkOutDate)->days;

            // Calculate price using the fetched room price
            $price = $days * $booking['price'];

            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $booking['username'] . '</td>';
            echo '<td>' . $booking['usersr_no'] . '</td>';
            echo '<td>' . $booking['roomsr_no'] . '</td>';
            echo '<td>' . $booking['roomname'] . '</td>';
            echo '<td>' . $booking['checkin'] . '</td>';
            echo '<td>' . $booking['checkout'] . '</td>';
            echo '<td>' . $days . '</td>';
            echo '<td>' . $price . '</td>';
         
            echo '</tr>';
            $i++;
        }

        // Close the result set
        mysqli_free_result($bookingResult);
        ?>
    </tbody>
</table>


            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
    </script>
</body>

</html>