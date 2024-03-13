<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch data from the rooms table
$roomsQuery = "SELECT `sr_no`, `name`, `feature1`, `feature2`, `area`, `price`, `quantity`, `img_path` FROM `rooms`";
$roomsResult = mysqli_query($con, $roomsQuery);

if ($roomsResult === false) {
    die('Error in query: ' . mysqli_error($con));
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
    <title>Rooms Board</title>
</head>
<style>
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">
                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">Rooms Board</h1>

                <!-- Button to open modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoomModal">Add Room</button>

                <!-- Display table with fetched data -->
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Feature 1</th>
                            <th>Feature 2</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image Path</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($room = mysqli_fetch_assoc($roomsResult)) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $room['name'] . '</td>';
                            echo '<td>' . $room['feature1'] . '</td>';
                            echo '<td>' . $room['feature2'] . '</td>';
                            echo '<td>' . $room['area'] . '</td>';
                            echo '<td>' . $room['price'] . '</td>';
                            echo '<td>' . $room['quantity'] . '</td>';
                            echo '<td>' . $room['img_path'] . '</td>';
                            echo '<td><button class="btn btn-danger" onclick="deleteRoom('.$room['sr_no'].')">Delete</button></td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal for adding a new room -->
    <div class="modal" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoomModalLabel">Add New Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a new room -->
                    <form method="post" action="edit_room.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="roomName">Room Name:</label>
                            <input type="text" class="form-control" id="roomName" name="roomName" required>
                        </div>
                        <div class="form-group">
                            <label for="feature1">Feature 1:</label>
                            <input type="text" class="form-control" id="feature1" name="feature1" required>
                        </div>
                        <div class="form-group">
                            <label for="feature2">Feature 2:</label>
                            <input type="text" class="form-control" id="feature2" name="feature2" required>
                        </div>
                        <div class="form-group">
                            <label for="area">Area:</label>
                            <input type="text" class="form-control" id="area" name="area" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="imgPath">Image Path:</label>
                            <input type="text" class="form-control" id="imgPath" name="imgPath" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Room</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        function deleteRoom(sr_no) {
            if (confirm("Are you sure you want to delete this room?")) {
                window.location.href = 'edit_room.php?sr_no=' + sr_no;
            }
        }

        function validateForm() {
            var priceInput = document.getElementById('price').value;
            if (isNaN(priceInput)) {//Is Not a Number.
                alert('Please enter a valid price.');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>