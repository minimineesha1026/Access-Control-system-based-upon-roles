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

if(isset($_POST['submit']) && isset($_FILES['add_file'])){
    $title = $_POST["title"];
    $subject = $_POST['subject'];
    $file  = $_FILES['add_file'];

    //echo '<pre>';print_r($file);die;
    // File Properties

    $file_name = $file['name'];
    $file_tmp  = $file['tmp_name'];
    $file_size = $file['size'];
    $file_destination = 'uploads/'.$file_name;
    if(move_uploaded_file($file_tmp,$file_destination)){
   $file_upload_query = "INSERT INTO `file_upload`(`title`, `subject`, `file`, `userid`, `created_date`) VALUES ('$title','$subject','$file_name','$adminid',now())";
   $query_executed = mysqli_query($conn,$file_upload_query);
    header("Location:e_learning.php");
  }

       
  


}

?>