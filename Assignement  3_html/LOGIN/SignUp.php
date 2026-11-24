<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: SignUp.html");
    exit;
}
$con=mysqli_connect("localhost","root","","auca_canteen");
if(mysqli_connect_errno()){
    echo "Can't connect to the DataBase".mysqli_connect_error();
}
$fname=mysqli_real_escape_string($con,$_POST['Fname']);
$lname=mysqli_real_escape_string($con,$_POST['Lname']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$tel=mysqli_real_escape_string($con,$_POST['tel']);
$role=mysqli_real_escape_string($con,$_POST['role']);
$username=mysqli_real_escape_string($con,$_POST['username']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);
if(empty($fname)||empty($lname)||empty($email)||empty($tel)||empty($role)||empty($username)||empty($password)||empty($cpassword)){
    header("Location: SignUp.html?error=empty");
    exit;
}
if($password !== $cpassword){
    header("Location: SignUp.html?error=password");
    exit;
}
$sql="INSERT INTO users (FirstName, LastName, Email, Telephone, Role, UserName, Password ) VALUES('$fname','$lname','$email','$tel','$role','$username','$password')";
if(!mysqli_query($con,$sql)){
    echo "Error!".mysqli_error($con);
} else{
    echo "1 record added successfully! Go and login to your account.";
}
mysqli_close($con);
?>