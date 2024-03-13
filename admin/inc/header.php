<?php
include('db_config.php');

?>

<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">

        <h4 class="fw-bold bg-white text-center p-2">ADMIN PANNEL</h4>
        <ul class="nav flex-column mt-5">

            <li class="nav-item">
                <a class="nav-link" href="home.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feature.php">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php">User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="booking.php">Booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="setting.php">Setting</a>
            </li>
           
            <li>
                <div class="sidebar-footer">
                    <button class="btn btn-info btn-block mb-5" onclick="logout()">LogOut</button>




                </div>
            </li>
            <li>
                <h7 class="fw-bold text-center text-light">© Developed by Saikat</h7>
            </li>

        </ul>

    </div>


</nav>
<script>
    function logout() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "process_admin_login.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                window.location.href = "index.php";
            }
        };
        xhr.send();
    }
</script>
