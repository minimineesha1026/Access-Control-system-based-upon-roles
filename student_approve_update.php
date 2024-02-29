<?php 

require 'connection.php';
session_start();
$user_id = $_GET['user_id'];


$query_student_login  = "SELECT * FROM `student_login` WHERE `sno`='$user_id'";
$result_student_login = mysqli_query($conn,$query_student_login);
$student_login_array  = mysqli_fetch_array($result_student_login, MYSQLI_NUM);

$student_name         = $student_login_array[1];
$student_password     = $student_login_array[5];
$student_type         = $student_login_array[6];

$insert_student_login_query  = "INSERT INTO `admin_login`(`user_name`, `password`, `role_assign`, `created_at`) VALUES ('$student_name','$student_password','$student_type',now())";
$insert_student_login_result = mysqli_query($conn,$insert_student_login_query);

$update_student_approval_query  = "UPDATE `student_login` SET `approve_status`='1' WHERE `sno` = $user_id";
$update_student_approval_result = mysqli_query($conn,$update_student_approval_query);

//header("Location:teacher_approval.php")


?>