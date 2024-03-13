<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

include('db_config.php');

//  total  users
$userCountQuery = "SELECT COUNT(`id`) as totalUsers FROM `user`";
$userCountResult = mysqli_query($con, $userCountQuery);
$totalUsers = 0; // Default 

if ($userCountResult !== false && $userCountRow = mysqli_fetch_assoc($userCountResult)) {
    $totalUsers = $userCountRow['totalUsers'];
}

//  total  bookings
$bookingCountQuery = "SELECT COUNT(`sr_no`) as totalBookings FROM `room_booking`";
$bookingCountResult = mysqli_query($con, $bookingCountQuery);
$totalBookings = 0; // Dflt

if ($bookingCountResult !== false && $bookingCountRow = mysqli_fetch_assoc($bookingCountResult)) {
    $totalBookings = $bookingCountRow['totalBookings'];
}

//  Total Income
$totalIncomeQuery = "SELECT SUM(DATEDIFF(`checkout`, `checkin`) * `price`) as totalIncome FROM `room_booking` 
                    INNER JOIN `rooms` ON `room_booking`.`roomsr_no` = `rooms`.`sr_no`";
$totalIncomeResult = mysqli_query($con, $totalIncomeQuery);
$totalIncome = 0; // Deflt

if ($totalIncomeResult !== false && $totalIncomeRow = mysqli_fetch_assoc($totalIncomeResult)) {
    $totalIncome = $totalIncomeRow['totalIncome'];
}

// Close db shonjog
mysqli_close($con);
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

    <title>The Mark Hotel - Admin</title>
</head>
<style>
  /* box-shadow: [horizontal offset] [vertical offset] [blur radius] [spread radius] [color]; */
    .rounded-box {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">

                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">Dashboard</h1>

                <!-- Display Total Users -->
                <div class="rounded-box bg-primary text-light">
                    <h2>Total Users</h2>
                    <h4><?php echo $totalUsers; ?></h4>
                </div>

                <!-- Display Total Bookings -->
                <div class="rounded-box bg-success text-light">
                    <h2>Total Bookings</h2>
                    <h4><?php echo $totalBookings; ?></h4>
                </div>

                <!-- Display Total Income -->
                <div class="rounded-box bg-info text-light">
                    <h2>Total Income</h2>
                    <h4><?php echo $totalIncome; ?> TK</h4>
                </div>

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


</body>

</html>
