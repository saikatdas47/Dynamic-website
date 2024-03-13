<?php
require('db_config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sr_no = $_POST["contact_id"];
    $address = $_POST["editAddress"];
    $email = $_POST["editEmail"];
    $phone = $_POST["editPhone"];

    $updateContactQuery = "UPDATE `contact` SET `address`='$address', `email`='$email', `phone`='$phone' WHERE `sr_no`='$sr_no'";
    $updateContactResult = mysqli_query($con, $updateContactQuery);

    if (!$updateContactResult) {
        echo 'Error in query: ' . mysqli_error($con);
    } else {
        header("Location: setting.php"); // Redirect back to the contact page after the update
        exit();
    }
} else {
    echo 'Invalid request';
}
?>
