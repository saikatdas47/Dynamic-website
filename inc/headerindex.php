<?php include('admin/db_config.php'); ?>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <form action="process_login.php" method="post">
                    <div class="form-group">
                        <label for="loginUsername">Username</label>
                        <input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Registration Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="process_registration.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        <h2 class="fw-bold bg-white text-center p-2">The Mark</h2>
        <ul class="nav flex-column mt-5">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Rooms</a>
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
            <li>
                <div class="sidebar-footer">
                    <button class="btn btn-light btn-block" data-toggle="modal" data-target="#loginModal">Login</button>
                    <button class="btn btn-info btn-block" data-toggle="modal" data-target="#registrationModal">Registration</button>
                </div>
            </li>
            <li>
                <h7 class="fw-bold text-center text-light">© Developed By Saikat</h7>
            </li>
        </ul>
    </div>
</nav>




<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('loginBtn').addEventListener('click', function() {
    //         $('#loginModal').modal('show');
    //     });
    // });
</script>