<?php 

require 'connection.php';
session_start();

$file_id = $_GET['file_id'];

$delete_file_query  ="DELETE FROM `file_upload` WHERE `sno`='$file_id'";
$delete_file_result = mysqli_query($conn,$delete_file_query);



//header("Location:teacher_approval.php")


?>