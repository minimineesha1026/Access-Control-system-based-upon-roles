<?php 

require 'connection.php';
session_start();
$adminid = $_SESSION['userid'];

$student_name       = $_POST['student_name'];
$student_department = $_POST['student_department'];
$phone_number       = $_POST['phone_number'];
$student_email      = $_POST['student_email'];
$student_password   = $_POST['student_password'];
$student_type       = $_POST['student_type'];



$student_query      = "INSERT INTO `student_login`(`student_name`, `phone_number`, `department`, `email`, `password`, `student_type`, `created_at`, `created_by`) VALUES ('$student_name','$phone_number','$student_department','$student_email','$student_password','$student_type',now(),'$adminid')";
$student_result     = mysqli_query($conn,$student_query);
if(!empty($student_result)){
    header("Location:student_registration.php");//write popup code for successful registration
}else{

    header("Location:student_registration.php");//write popup code for Error message
}



?>