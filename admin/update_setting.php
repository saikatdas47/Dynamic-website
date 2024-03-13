<?php
require('db_config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sr_no = $_POST["sr_no"];
    $name = $_POST["editName"];
    $description = $_POST["editDescription"];

    $updateQuery = "UPDATE `setting` SET `name`='$name', `description`='$description' WHERE `sr_no`='$sr_no'";
    $updateResult = mysqli_query($con, $updateQuery);

    if (!$updateResult) {
        echo 'Error in query: ' . mysqli_error($con);
    } else {
        header("Location: setting.php"); // Redirect back to the setting page after the update
        exit();
    }
}
?>
