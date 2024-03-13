<?php
// include('admin/db_config.php');

// session_start(); // Start the session

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data
//     $loginUsername = $_POST["loginUsername"];
//     $loginPassword = $_POST["loginPassword"];

//     // Check if the username exists in the database
//     $checkUserQuery = "SELECT * FROM `user` WHERE `user_name` = ?";
//     $stmt = mysqli_prepare($con, $checkUserQuery);
//     mysqli_stmt_bind_param($stmt, "s", $loginUsername);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);

//     if ($result && $user = mysqli_fetch_assoc($result)) {
//         // Verify the hashed password
//         if (password_verify($loginPassword, $user['password'])) {
//             // Password is correct, set session variables and redirect to home.php
//             $_SESSION['user_id'] = $user['id'];
//             $_SESSION['user_name'] = $user['user_name'];

//             header("Location: home.php");
//             exit();
//         } else {
//             // Incorrect password, display an error message or redirect to login page
//             echo "Incorrect password. Please try again.";
//         }
//     } else {
//         // Username not found, display an error message or redirect to login page
//         echo "Username not found. Please try again.";
//     }

//     // Close the prepared statement
//     mysqli_stmt_close($stmt);
// }

// // Check if the logout button is clicked
// if (isset($_GET['logout'])) {
//     // Unset all session variables
//     session_unset();

//     // Destroy the session
//     session_destroy();

//     // Redirect to index.php after logout
//     header("Location: index.php");
    
//     exit();
// }

// // Close the database connection
// mysqli_close($con);

include('admin/db_config.php');

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $loginUsername = $_POST["loginUsername"];
    $loginPassword = $_POST["loginPassword"];

    // Check if the username exists in the database using prepared statements
    $checkUserQuery = "SELECT * FROM `user` WHERE `user_name` = ?";
    $stmt = mysqli_prepare($con, $checkUserQuery);//prepared statement
    mysqli_stmt_bind_param($stmt, "s", $loginUsername);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $user = mysqli_fetch_assoc($result)) {
        // Verify the hashed password
        if (password_verify($loginPassword, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];

            header("Location: home.php");
            exit();
        } else {

            echo "Incorrect password. Please try again.";
        }
    } else {
       
        echo "Username not found. Please try again.";
    }

  
    mysqli_stmt_close($stmt);  // Close the prepared statement
}

if (isset($_GET['logout'])) {  // Check if the logout button is clicked
    // Unset all session variables
    session_unset();

    session_destroy();

    header("Location: index.php");
}

mysqli_close($con);// Close the database connection


?>


