<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$settingsQuery = "SELECT  `name`, `description` FROM `setting` WHERE `sr_no`=1";
$settingsResult = mysqli_query($con, $settingsQuery);

if (!$settingsResult) {
    die('Error in query: ' . mysqli_error($conn));
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


    <title>Admin setting</title>
</head>
<style>



</style>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php require('inc/header.php'); ?>



            <main role="main" class="col-md-10 ml-sm-auto px-4 content bg-light">



                <!-- themark -->
                <h1 class="fw-bold text-center text-dark mt-0 p-2 bg-warning mb-5">Setting Board</h1>

                <h3 class="fw-bold text-center text-dark mt-0 p-2 mb-2">General Settings</h3>

                <!-- Displaying settings from the database -->
                <div class="settings-container">

                    <?php
                    while ($setting = mysqli_fetch_assoc($settingsResult)) {
                        echo '<div class="setting-item">';
                        echo '<h5 class="fs-bold">Hotel Name :</h5>';
                        echo '<p class="setting-name">' . $setting['name'] . '</p>';
                        echo '<h5 class="fs-bold">Description :</h5>';
                        echo '<p class="setting-description">' . $setting['description'] . '</p>';

                        // Add an Edit button to open the modal with the form
                        echo '<button class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button>';

                        // Form inside modal for editing
                        echo '<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="editModalLabel">Edit Setting</h5>';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';

                        // Edit form with input fields
                        echo '<form method="post" action="update_setting.php">';
                        echo '<input type="hidden" name="sr_no" value="1">'; 
                        echo '<div class="form-group">';
                        echo '<label for="editName">Name:</label>';
                        echo '<input type="text" class="form-control" id="editName" name="editName" value="' . $setting['name'] . '">';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="editDescription">Description:</label>';
                        echo '<textarea class="form-control" id="editDescription" name="editDescription">' . $setting['description'] . '</textarea>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Submit</button>';
                        echo '</form>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';;
                    }
                    ?>
                </div>


                <!-- Displaying contacts from the database -->
                <div class="contacts-container">
                    <h3 class="fw-bold text-center text-dark mt-0 p-2 mb-2">Contact Settings</h3>

                    <?php
                    $contactsQuery = "SELECT `sr_no`, `address`, `email`, `phone` FROM `contact` WHERE `sr_no`=1";

                    $contactsResult = mysqli_query($con, $contactsQuery);

                    if ($contactsResult === false) {
                        die('Error in query: ' . mysqli_error($con));
                    }

                    // Display contacts
                    while ($contact = mysqli_fetch_assoc($contactsResult)) {
                        echo '<div class="contact-item">';
                        echo '<h5 class="fs-bold">Address:</h5>';
                        echo '<p class="contact-address">' . $contact['address'] . '</p>';
                        echo '<h5 class="fs-bold">Email:</h5>';
                        echo '<p class="contact-email">' . $contact['email'] . '</p>';
                        echo '<h5 class="fs-bold">Phone:</h5>';
                        echo '<p class="contact-phone">' . $contact['phone'] . '</p>';

                        // Add an Edit button to open the modal with the form
                        echo '<button class="btn btn-primary" data-toggle="modal" data-target="#editContactModal">Edit</button>';

                        // Form inside modal for editing contacts
                        echo '<div class="modal" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                        echo '<div class="modal-content">';
                        echo '<div class="modal-header">';
                        echo '<h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>';
                        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        echo '<div class="modal-body">';

                        // Edit form with input fields for contacts
                        echo '<form method="post" action="update_contact.php">';
                        echo '<input type="hidden" name="contact_id" value="' . $contact['sr_no'] . '">'; 
                        echo '<div class="form-group">';
                        echo '<label for="editAddress">Address:</label>';
                        echo '<input type="text" class="form-control" id="editAddress" name="editAddress" value="' . $contact['address'] . '">';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="editEmail">Email:</label>';
                        echo '<input type="text" class="form-control" id="editEmail" name="editEmail" value="' . $contact['email'] . '">';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="editPhone">Phone:</label>';
                        echo '<input type="text" class="form-control" id="editPhone" name="editPhone" value="' . $contact['phone'] . '">';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">Submit</button>';
                        echo '</form>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '</div>';
                    }

                    ?>

                </div>




            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="script/setting.js"></script>
</body>

</html>