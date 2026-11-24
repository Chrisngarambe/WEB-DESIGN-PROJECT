<?php

session_start();

if(!isset($_SESSION['UserId']))
{
    die("Please log in first.");
}

$con = mysqli_connect("localhost","root","","auca_canteen");

$userId = $_SESSION['UserId'];

$totalAmount = $_POST['totalAmount'];

$sql = "INSERT INTO orders(UserId,OrderDate,TotalAmount,Status)
VALUES('$userId',CURDATE(),'$totalAmount','Pending')";
if(mysqli_query($con,$sql))
{
    echo "Order Placed Successfully";

    header("refresh:2;url=Customer.php");
}
else
{
    echo mysqli_error($con);
}

?>