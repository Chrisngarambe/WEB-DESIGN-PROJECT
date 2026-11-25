<?php

session_start();

if(!isset($_SESSION['UserId']))
{
    header("Location: ../LOGIN/Login.html");
    exit();
}
$con = mysqli_connect("localhost","root","","auca_canteen");
if(!$con)
{
    die("Connection Failed: " . mysqli_connect_error());
}
$orderId = $_POST['OrderId'];
$sql = "UPDATE orders SET Status='Paid' WHERE OrderId='$orderId'";

if(mysqli_query($con,$sql))
{
    header("Location: Cashier.php");
    exit();
}
else
{
    echo mysqli_error($con);
}

?>