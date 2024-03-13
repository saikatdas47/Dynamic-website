<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../inc/links.php'); ?>
    <title>Admin Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }

        .login-container input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="fw-bold text-center text-dark p-2 mt-2 mb-4">Admin Login</h2>
    <form action="process_admin_login.php" method="post">
        <input type="text" name="admin_name"  class="mb-4" placeholder="Admin Name" required>
        <br>
        <input type="password" name="admin_password" class="mb-4" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
