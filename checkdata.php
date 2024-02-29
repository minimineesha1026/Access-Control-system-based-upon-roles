<?php 

require 'connection.php';
session_start();
if(!empty($_POST)){

    $username = $_POST['user_name'];
    $password = $_POST['password'];
   // $password = md5($password);
}

    $query_admin = "SELECT * FROM `admin_login` WHERE `user_name` = '$username' AND `password` = '$password'";
   // echo $query_admin; query executed

    $result_array = mysqli_query($conn,$query_admin);
    $data = mysqli_fetch_array($result_array, MYSQLI_NUM);

   // print_r($data);  data returned from query
    
    if(!empty($data)){
       
        $_SESSION['userid'] = $data[0];
        header("Location:index.php");
       // write code if admin's user_id and password is correct

    }else{

        // echo '<script type ="text/JavaScript">';  
        // echo 'alert(" Welcome to JavaTpoint !!!! ")';  
        // echo '</script>'; 
        // sleep(5);
       header("Location:login.php");
      
        //write code if admin's user_id and password is incorrect
}


?>