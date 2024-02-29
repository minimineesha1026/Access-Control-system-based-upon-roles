<?php 

require 'connection.php';
session_start();
$user_id = $_GET['user_id'];

$query_teacher_login  = "SELECT * FROM `teacher_login` WHERE `sno`='$user_id'";
$result_teacher_login = mysqli_query($conn,$query_teacher_login);
$teacher_login_array  = mysqli_fetch_array($result_teacher_login, MYSQLI_NUM);

$teacher_name         = $teacher_login_array[1];
$teacher_password     = $teacher_login_array[5];
$teacher_type         = $teacher_login_array[6];

$insert_teacher_login_query  = "INSERT INTO `admin_login`(`user_name`, `password`, `role_assign`, `created_at`) VALUES ('$teacher_name','$teacher_password','$teacher_type',now())";
$insert_teacher_login_result = mysqli_query($conn,$insert_teacher_login_query);

$update_teacher_approval_query  = "UPDATE `teacher_login` SET `approve_status`='1' WHERE `sno` = $user_id";
$update_teacher_approval_result = mysqli_query($conn,$update_teacher_approval_query);

//header("Location:teacher_approval.php")


?>
