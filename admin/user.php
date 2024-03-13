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
    <title>User setting</title>
</head>
<style>
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">
                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">User Board</h1>

                <!-- Displaying users in a table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serial Num</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $serialNum = 1;
                            while ($user = mysqli_fetch_assoc($usersResult)) {
                                echo '<tr>';
                                echo '<td>' . $serialNum++ . '</td>';
                                echo '<td>' . $user['name'] . '</td>';
                                echo '<td>' . $user['user_name'] . '</td>';
                                echo '<td>' . $user['email'] . '</td>';
                                echo '<td>' . $user['password'] . '</td>';
                                echo '<td><button class="btn btn-danger" onclick="deleteUser(' . $user['id'] . ')">Delete</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'delete_user.php?id=' + userId;
            }
        }
    </script>
</body>

</html>
