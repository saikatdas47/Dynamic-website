<?php
// include('admin/db_config.php');


// // Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// include('admin/db_config.php');

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $name = $_POST["name"];
//     $username = $_POST["username"];
//     $email = $_POST["email"];
//     $password = $_POST["password"];

//     // Check if the email or username is already registered
//     $checkUserQuery = "SELECT * FROM `user` WHERE `email` = '$email' OR `user_name` = '$username'";
//     $result = mysqli_query($con, $checkUserQuery);

//     if (mysqli_num_rows($result) > 0) {
//         // Email or username is already registered, display an error message or redirect to registration page
//         echo "Email or username is already registered. Please use different credentials.";
//     } else {
//         // Email and username are not registered, proceed with the registration

//         // Hash the password
//         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//         $insertQuery = "INSERT INTO `user` (`name`, `user_name`, `email`, `password`) VALUES ('$name', '$username', '$email', '$hashedPassword')";

//         if (mysqli_query($con, $insertQuery)) {
//             // Registration successful, redirect to index.php
//             header("Location: index.php");
//             exit(); // Make sure to exit to prevent further execution
//         } else {
//             // Registration failed
//             echo "Error: " . mysqli_error($con);
//         }
//     }
// }

// // Close the database connection
// mysqli_close($con);


include('admin/db_config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //  already registered using prepared statements
    $checkUserQuery = "SELECT * FROM `user` WHERE `email` = ? OR `user_name` = ?";
    $stmt = mysqli_prepare($con, $checkUserQuery);
    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Email or username is already registered. Please use different credentials.";
    } else {
      
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO `user` (`name`, `user_name`, `email`, `password`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            
            header("Location: index.php");// \
            exit();
        } else {
            
            echo "Error: " . mysqli_error($con);// Registration failed
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($con);
?>
