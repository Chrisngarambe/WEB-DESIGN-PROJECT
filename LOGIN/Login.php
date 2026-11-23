<?php
$con=mysqli_connect("localhost","root","","auca_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to the database" .mysqli_connect_error();
}
$username=mysqli_real_escape_string($con, $_POST['username']);
$password=mysqli_real_escape_string($con, $_POST['password']);
if(isset($_POST['role'])){
    $role=$_POST['role'];
    if($role == "cashier"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            header("Location: ../CANTEEN/Cashier.html");
        }else{
            echo "User not found. ".mysqli_error($con);
            echo "Please Sign up then login.";
        }
    } else if($role=="supervisor"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            header("Location: ../CANTEEN/Supervisor.html");
        }else{
            echo "User not found. ".mysqli_error($con);
            echo "Please Sign up then login.";
        }
    } else if($role=="manager"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            header("Location: ../CANTEEN/Manager.html");
        }else{
            echo "User not found. ".mysqli_error($con);
            echo "Please Sign up then login.";
        }
    } else if($role=="customer"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            header("Location: ../CUSTOMER/Customer.html");
        }else{
            echo "User not found. ".mysqli_error($con);
            echo "Please Sign up then login.";
        }
    }
}
?>