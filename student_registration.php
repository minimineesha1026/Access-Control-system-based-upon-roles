<?php 

require 'connection.php';
session_start();
$adminid = $_SESSION['userid'];

$query_admin  = "SELECT * FROM `admin_login` WHERE `sno.` = '$adminid'";
$result_admin = mysqli_query($conn,$query_admin);
$admin_array  = mysqli_fetch_array($result_admin, MYSQLI_NUM);
$name         = $admin_array[1];
$role         = $admin_array[3];

$query_role   = "SELECT * FROM `role_assign` WHERE `sno`='$role'";
$result_role  = mysqli_query($conn,$query_role);
$role_array   = mysqli_fetch_array($result_role,MYSQLI_NUM);
$role_name    = $role_array[1];

$query_access  = "INSERT INTO `user_activity`(`user_id`, `user_role`, `accessed_page`, `access_date`, `access_time`) VALUES ('$adminid','$role','student registration',now(),now())";
$result_access = mysqli_query($conn,$query_access);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Access Control Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><?php echo $role_name ?></h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/userimage.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $name ?></h6>
                        <span><?php echo $role_name ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php if($role == 1 || $role==2) { ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Registration</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="teacher_registration.php" class="dropdown-item">Teacher</a>
                            <a href="student_registration.php" class="dropdown-item active">Student</a>
                           
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($role==1){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Approval</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="teacher_approval.php" class="dropdown-item">Teacher</a>
                            <a href="student_approval.php" class="dropdown-item">Student</a>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($role==2||$role==3){ ?>

                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-address-book" aria-hidden="true"></i>E-learning</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="e_learning.php" class="dropdown-item">Upload Books</a>
                            <a href="download_elearning.php" class="dropdown-item">Download Books</a>
                        </div>
                    </div>

                    <?php  }elseif($role==4||$role==5){ ?>

                    <a href="download_elearning.php" class="nav-item nav-link"><i class="fa fa-address-book me-2"></i>Download Books</a>



                    <?php } ?>
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                   
                   
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/userimage.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $name ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            
                            <a href="login.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
               
                <?php if($role == 1 || $role==2) { ?>    
                <div class="col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Student Registration Form</h6>
                            <form action="student_reg.php" method="POST">
                                <div class="row mb-3">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="student_name" required class="form-control" id="inputName">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="inputDepartment" class="col-sm-2 col-form-label">Department</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="student_department" required class="form-control" id="inputDepartment">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone_number" required class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="student_email" required class="form-control" id="inputEmail3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="student_password" required class="form-control" id="inputPassword3">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Type</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="student_type"
                                                id="gridCr" value="4" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Class Representative
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="student_type"
                                                id="gridstu" value="5">
                                            <label class="form-check-label" for="gridRadios2">
                                                Student
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                    </div>
                    <?php }else{ ?> 
                   
                   <!-- 404 Start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                                <div class="col-md-6 text-center p-4">
                                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                                    <h1 class="display-1 fw-bold">404</h1>
                                    <h1 class="mb-4">Page Not Found</h1>
                                    <p class="mb-4">We’re sorry, you are not allowed to access the page!
                                        Maybe go to our home page or try to access something you are allowed to access!</p>
                                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">Go Back To Home</a>
                                </div>
                            </div>
                        </div>
                        <!-- 404 End -->
                   
               <?php } ?> 
               
            </div>
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="index.php">Access Control</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>