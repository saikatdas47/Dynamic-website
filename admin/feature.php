<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch data from the database
$usersQuery = "SELECT `id`, `name`, `user_name`, `email`, `password` FROM `user`";
$usersResult = mysqli_query($con, $usersQuery);

if ($usersResult === false) {
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
    <title>Feature setting</title>
</head>
<style>
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">
                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">Feature Board</h1>

                <!-- Add button to trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#addFeatureModal">Add Feature</button>
                <!-- Modal for adding a new feature -->
                <div class="modal" id="addFeatureModal" tabindex="-1" role="dialog" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFeatureModalLabel">Add Feature</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" action="add_feature.php">
                                    <div class="form-group">
                                        <label for="featureName">Feature Name:</label>
                                        <input type="text" class="form-control" id="featureName" name="featureName" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Feature</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Table features -->
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Feature Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // Fetch data from the database
                        $featuresQuery = "SELECT `sr_no`, `name` FROM `feature`";
                        $featuresResult = mysqli_query($con, $featuresQuery);

                        if ($featuresResult === false) {
                            die('Error in query: ' . mysqli_error($con));
                        }

                        $serial = 1;

                        while ($feature = mysqli_fetch_assoc($featuresResult)) {
                            echo '<tr>';
                            echo '<th scope="row">' . $serial . '</th>';
                            echo '<td>' . $feature['name'] . '</td>';
                            echo '<td><button class="btn btn-danger" onclick="deleteFeature(' . $feature['sr_no'] . ')">Delete</button></td>';
                            echo '</tr>';

                            $serial++;
                        }

                        mysqli_free_result($featuresResult);
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
        function deleteFeature(featureId) {
            if (confirm("Are you sure you want to delete this feature?")) {
                window.location.href = 'add_feature.php?id=' + featureId;
            }
        }
    </script>
</body>

</html>