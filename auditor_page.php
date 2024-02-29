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

if($role!=6){

$query_access  = "INSERT INTO `user_activity`(`user_id`, `user_role`, `accessed_page`, `access_date`, `access_time`) VALUES ('$adminid','$role','review',now(),now())";
$result_access = mysqli_query($conn,$query_access);

}

$query_review  = "SELECT * FROM `user_activity`";
$result_review = mysqli_query($conn,$query_review);
$review_array  = mysqli_fetch_all($result_review);
$affected_rows = mysqli_affected_rows($conn);

//echo $affected_rows;die;
$temp_array = [];
foreach($review_array as $value =>$values){

    $user_id      = $values['1'];
    $query_user   = "SELECT * FROM `admin_login` WHERE `sno.` = '$user_id'";
    $result_user  = mysqli_query($conn,$query_user);
    $admin_array  = mysqli_fetch_array($result_user, MYSQLI_NUM);
    $username     = $admin_array[1];

    $user_role_id      = $values['2'];
    $query_user_role   = "SELECT * FROM `role_assign` WHERE `sno`='$user_role_id'";
    $result_user_role  = mysqli_query($conn,$query_user_role);
    $role_user_array   = mysqli_fetch_array($result_user_role,MYSQLI_NUM);
    $user_role         = $role_user_array[1];

   $array['userid']        = $username;
   $array['user_role']     = $user_role;
   $array['user_role_id']  = $user_role_id;
   $array['accessed_page'] = $values['3'];
   $array['accessed_date'] = $values['4'];
   $array['accessed_time'] = $values['5'];
   $temp_array[] = $array;


}
//echo '<pre>';print_r($temp_array); die;


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

    <!-- CDN CSS Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

    
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
                <a href="index.php" class="navbar-brand mx-4 mb-3">
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
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                   
                    <div class="nav-item dropdown">
                    <?php if($role == 1 || $role==2) { ?>
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Registration</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="teacher_registration.php" class="dropdown-item">Teacher</a>
                            <a href="student_registration.php" class="dropdown-item">Student</a>
                            </div>
                            <?php } elseif($role==6){ ?>

                                <a href="auditor_page.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Review</a>

                          <?php  } ?>

                       
                    </div>
                    <?php if($role==1){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Approval</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="teacher_approval.php" class="dropdown-item">Teacher</a>
                            <a href="student_approval.php" class="dropdown-item">Student</a>
                        </div>
                    </div>
                        <?php }  ?>
                    
                   
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
            <?php if($role==6){ ?>
        <div class="container mt-5">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-12 m-auto">
				<table class="table table-bordered table-hovered table-striped" id="productTable">
					<thead>
                        <th> S No. </th>
						<th> User Name </th>
						<th> User Role </th>
						<th> Activity </th>
                        <th> Date </th>
						<th> Time </th>
					</thead>

					<tbody>

					<?php
                    if(!empty($temp_array)) {
                        $count = 1;
                        foreach($temp_array as $val){
                            if($val['user_role_id']==1){
                                if($val['accessed_page']=='review'){
                                    $flag_raised = 'red';
                                }else{
                                    $flag_raised = 'green';
                                }
                            }elseif($val['user_role_id']==2){
                                if($val['accessed_page']=='teacher approval'||$val['accessed_page']=='student approval'||$val['accessed_page']=='review'){
                                    $flag_raised = 'red';
                                }else{
                                    $flag_raised = 'green';
                                }
                            }elseif($val['user_role_id']==3){
                                    if($val['accessed_page']== 'e learning'||$val['accessed_page']=='download e learning'||$val['accessed_page']=='index'){
                                        $flag_raised = 'green';
                                    }else{
                                        $flag_raised = 'red';
                                    }

                                }elseif($val['user_role_id']==5){
                                    if($val['accessed_page']=='download e learning'||$val['accessed_page']=='index'){
                                        $flag_raised ='green';
                                    }else{
                                        $flag_raised = 'red';

                                    }
                                }elseif($val['user_role_id']==6){
                                    if($val['accessed_page']=='index'){
                                        $flag_raised = 'green';

                                    }else{
                                        $flag_raised ='red';
                                    }
                                }
                            
                            
                            
                            ?>
                                <?php if($flag_raised=='green'){ ?>
                                    <tr style="color: green;">
                               <?php  }else {?>
                                <tr style="color: red;">
                                <?php } ?>
                                
                                <td> <?= $count ?> </td>
                                <td> <?= $val['userid'] ?> </td>
								<td> <?= $val['user_role'] ?> </td>
								<td> <?= $val['accessed_page'] ?> </td>
                                <td> <?= date("d M Y",strtotime($val['accessed_date'])) ?> </td>
								<td> <?= $val['accessed_time'] ?> </td>
								</tr>


                      <?php $count++; }

                    }else{ ?>
                        <tr>
                            <td colspan="6" style="text-align: center">NO RECORD FOUND!</td>

                        </tr>

                    <?php }
                    
                    
                    ?>

							


							
					</tbody>	
				</table>
			</div>
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


           <!-- code for reviewing table -->

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

    <!-- CDN jQuery Datatable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

</body>

</html>

<script>
	$(document).ready(function() {
    	$('#productTable').DataTable();
	});
</script>