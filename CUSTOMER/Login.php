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
        if(!mysqli_query($con,$sql)){
            echo "Error!".mysqli_error($con);
        }else{
            header("Location: Cashier.html");
        }
    } else if($role=="supervisor"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        if(!mysqli_query($con,$sql)){
            echo "Error!".mysqli_error($con);
        }else{
            header("Location: Supervisor.html");
        }
    } else if($role=="manager"){
        $sql= "SELECT * FROM users WHERE UserName='$username' AND Password='$password' AND Role='$role'";
        if(!mysqli_query($con,$sql)){
            echo "Error!".mysqli_error($con);
        }else{
            header("Location: Manager.html");
        }
    }
}
?>