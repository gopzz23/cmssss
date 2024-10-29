<?php include('includes/config.php') ?>
<?php include('header.php') ?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark default-color">
    <a class="navbar-brand" href="#"><b>SMS</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
        aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item dropdown">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user mr-2"></i>Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default"
                        aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="/sms-project/admin/dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                <?php } else { ?>
                    <a href="login.php" class="nav-link"><i class="fa fa-user mr-2"></i>User login</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>
<!--/.Navbar -->

<div class="py-5 shadow" style="background:linear-gradient(-45deg, #ffcccc 50%, transparent 50%)">
    <div class="container my-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 font-weight-bold">ClassSphere: A Classroom Management Suite</h1>
                <p class="lead">Welcome to ClassSphere, where we provide innovative solutions for effective classroom management.</p>
                <a href="login.php" class="btn btn-lg btn-primary mt-4">Get Started</a>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<section class="py-5" style="background-color: #e6f7ff;">
    <div class="container">
        <h2 class="text-center">About Us</h2>
        <p class="text-center">We are committed to providing the best educational experience for our students and staff.</p>
        <div class="text-center">
            <a href="aboutus.php" class="btn btn-primary mt-3">Learn More</a>
        </div>
    </div>
</section>

<!-- Footer -->
<section class="py-3" style="background-color: #ffe6e6;">
    <div class="container-fluid text-center">
        <small>Copyright 2020-2024 All Rights Reserved. <a href="#" class="text-dark">School Management System</a></small>
    </div>
</section>

<?php include('footer.php') ?>