<?php

session_start();

$con = mysqli_connect("localhost","root","","auca_canteen2");

if(mysqli_connect_errno())
{
    die("Failed to connect to the database: " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

if(isset($_POST['role']))
{
    $role = $_POST['role'];

    $sql = "SELECT *
            FROM users
            WHERE UserName='$username'
            AND Password='$password'
            AND Role='$role'";

    $result = mysqli_query($con,$sql);
    if(!$result)
    {
        die("Query failed: " . mysqli_error($con));
    }

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['UserId'] = $row['UserId'];
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['Role'] = $row['Role'];

        if($role == "cashier")
        {
            header("Location: ../CANTEEN/Cashier.html");
            exit();
        }
        elseif($role == "supervisor")
        {
            header("Location: ../CANTEEN/Supervisor.html");
            exit();
        }
        elseif($role == "manager")
        {
            header("Location: ../CANTEEN/Manager.html");
            exit();
        }
        elseif($role == "customer")
        {
            header("Location: ../CUSTOMER/Customer.php");
            exit();
        }
    }
    else
    {
        echo "User not found.<br>";
        echo "Please sign up then login.";
    }
}
else
{
    echo "Please select a role.";
}

mysqli_close($con);

?>