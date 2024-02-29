<?php 

require 'connection.php';
session_start();
$adminid = $_SESSION['userid'];

$teacher_name       = $_POST['teacher_name'];
$teacher_department = $_POST['teacher_department'];
$phone_number       = $_POST['teacher_number'];
$teacher_email      = $_POST['teacher_email'];
$teacher_password   = $_POST['teacher_password'];
$teacher_type       = $_POST['teacher_type'];

$teacher_query      = "INSERT INTO `teacher_login`(`tearcher_name`, `teacher_department`, `phone_number`, `teacher_email`, `teacher_password`, `teacher_type`, `created_at`, `created_by`)VALUES('$teacher_name','$teacher_department','$phone_number','$teacher_email','$teacher_password','$teacher_type',now(),'$adminid')";
$teacher_result     = mysqli_query($conn,$teacher_query);

if(!empty($teacher_result)){
    header("Location:teacher_registration.php");//write popup code for successful registration
}else{

    header("Location:teacher_registration.php");//write popup code for Error message
}



?>