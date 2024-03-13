<?php
include('admin/db_config.php');

?>

<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">

        <h2 class="fw-bold bg-white text-center p-2">The Mark</h2>
        <ul class="nav flex-column mt-5">

            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="frontendRooms.php">Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Facilities</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="frontendUser.php">Your Profile</a>
            </li>
            <li>
                <div class="sidebar-footer">
                    
                    <!-- Add this button -->
                    <button class="btn btn-info btn-block mb-2" onclick="logout()">LogOut</button>
                   

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
        xhr.open("GET", "process_login.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {  //Checks if the request is complete,4. HTTP status code is 200 is ok
                window.location.href = "index.php";
            }
        };
        xhr.send();
    }

</script>
