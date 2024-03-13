<!-- add -->
<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $featureName = $_POST["featureName"];

    // Insert new feature  to db
    $insertFeatureQuery = "INSERT INTO `feature` (`name`) VALUES ('$featureName')";
    $insertFeatureResult = mysqli_query($con, $insertFeatureQuery);

    if (!$insertFeatureResult) {
        die('Error in query: ' . mysqli_error($con));
    }

    
    header("Location: feature.php");
    exit();
}
?>
<!-- delete -->
<?php
session_start();

require('db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // Get feature ID from the query paramtr
    $featureId = $_GET["id"];

    $deleteFeatureQuery = "DELETE FROM `feature` WHERE `sr_no`='$featureId'";
    $deleteFeatureResult = mysqli_query($con, $deleteFeatureQuery);

    if (!$deleteFeatureResult) {
        die('Error in query: ' . mysqli_error($con));
    }

    header("Location: feature.php");
    exit();
}
?>
