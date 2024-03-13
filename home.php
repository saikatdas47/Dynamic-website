<?php
include('admin/db_config.php');

$contactQuery = "SELECT `sr_no`, `address`, `email`, `phone` FROM `contact` WHERE 1";
$contactResult = mysqli_query($con, $contactQuery);

if ($contactResult !== false) {
    $contactInfo = mysqli_fetch_assoc($contactResult);
} else {
    // Handle the case where the query fails
    // $contactInfo = array(
    //     'address' => 'Not available',
    //     'email' => 'Not available',
    //     'phone' => 'Not available'
    // );
}

// Close the database connection
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


    <title>The Mark Hotel</title>
</head>
<style>

</style>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>



            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">



                <!-- cerrosel -->
                <div class="container-fluid px-lg-4">
                    <!-- Swiper -->
                    <div class="swiper swiper-container rounded shadow">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="images/carousel/1.jpg" class="w-100 d-block" />
                            </div>
                            <div class="swiper-slide">
                                <img src="images/carousel/2.jpg" class="w-100 d-block" />
                            </div>
                            <div class="swiper-slide">
                                <img src="images/carousel/3.jpg" class="w-100 d-block" />
                            </div>
                            <div class="swiper-slide">
                                <img src="images/carousel/4.jpg" class="w-100 d-block" />
                            </div>
                            <div class="swiper-slide">
                                <img src="images/carousel/5.jpg" class="w-100 d-block" />
                            </div>
                            <div class="swiper-slide">
                                <img src="images/carousel/6.jpg" class="w-100 d-block" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- themark -->
                <h1 class="fw-bold text-center text-light mt-5 p-2 bg-danger mb-5">Welcome to The Mark</h1>
                <p class="fw-bold text-center text-dark">Description </p>

                <!-- Room Card Section -->
                <h2 class="fw-bold text-center text-dark p-2 mt-5">Our Rooms</h2>

                <div class="container">
                    <div class="row">

                        <?php
                        // Fetch only the last 3 rooms from the database
                        $roomQuery = "SELECT `name`, `price`, `feature1`, `feature2`, `area`, `quantity`, `img_path` FROM `rooms` ORDER BY `sr_no` DESC LIMIT 3";
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
                            echo '<p>Price: $' . $room['price'] . ' per night</p>';
                            echo '<p>Features: ' . $room['feature1'] . ', ' . $room['feature2'] . '</p>';
                            echo '<p>Area: ' . $room['area'] . '</p>';
                            echo '<p>Quantity: ' . $room['quantity'] . '</p>';
                            echo '<button class="btn btn-info">More Details</button>';

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>

                    </div>

                    <!-- Room card end -->





                    <!-- Facilities Card Section -->
                    <div class="container">
                        <h2 class="fw-bold text-center text-dark mt-5 mb-3 p-2">Facilities</h2>
                        <div class="row">

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="facility-card  text-center rounded shadow p-2">
                                    <img src="images/features/ac.svg" alt="Facility Image" width="80px">
                                    <h5 class="mt-3">AC</h5>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="facility-card  text-center rounded shadow p-2">
                                    <img src="images/features/cleaner.svg" alt="Facility Image" width="80px">
                                    <h5 class="mt-3  ">Cleaner</h5>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="facility-card  text-center rounded shadow p-2">
                                    <img src="images/features/heater.svg" alt="Facility Image" width="80px">
                                    <h5 class="mt-3 ">Heater</h5>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4 ">
                                <div class="facility-card text-center rounded shadow p-2">
                                    <img src="images/features/wifi.svg" alt="Facility Image" width="80px">
                                    <h5 class="mt-3  ">Wifi</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Facilities end -->
                    <!-- Reach Us Section -->
                    <div class="container mt-4">
                        <h2 class="fw-bold text-center text-dark mt-5 mb-3 p-2">Reach Us</h2>
                        <div class="row shadow p-2 border">

                            <!-- Map Div -->
                            <div class="col-lg-6 mb-4 p-3 ">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7303.079311275259!2d90.406786!3d23.76379!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c790e6cf50a9%3A0xcae56c17297f85f8!2sAhsanullah%20University%20of%20Science%20and%20Technology!5e0!3m2!1sen!2sbd!4v1706383532152!5m2!1sen!2sbd" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>


                            <!-- Social Links and Phone Number Div -->
                            <!-- Display Contact Information -->
                            <div class="col-lg-6 mb-4">
                                <div class="contact-info p-4">
                                    <h4 class="mb-2">Contact Information</h4>

                                    <p><?php echo $contactInfo['address']; ?></p>
                                    <p>Email: <?php echo $contactInfo['email']; ?></p>
                                    <p>Phone: <?php echo $contactInfo['phone']; ?></p>

                                    <!-- Social Links -->
                                    <div class="social-links mt-3">
                                        <a href="#" target="_blank" class="btn btn-outline-primary"><i class="fab fa-facebook-f"></i> Facebook</a>
                                        <a href="#" target="_blank" class="btn btn-outline-info"><i class="fab fa-twitter"></i> Twitter</a>
                                        <a href="#" target="_blank" class="btn btn-outline-danger"><i class="fab fa-instagram"></i> Instagram</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Reach Us end -->

            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 900,
                disableOnInteraction: false
            }
        });
    </script>


</body>

</html>