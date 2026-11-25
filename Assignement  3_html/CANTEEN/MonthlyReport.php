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
    die("Connection Failed : " . mysqli_connect_error());
}
$revenueQuery ="SELECT SUM(TotalAmount) AS Revenue FROM orders WHERE Status='Paid'";
$revenueResult =mysqli_query($con,$revenueQuery);
$revenue =mysqli_fetch_assoc($revenueResult);
$orderQuery ="SELECT COUNT(*) AS Orders FROM orders";
$orderResult =mysqli_query($con,$orderQuery);
$orders =mysqli_fetch_assoc($orderResult);
$customerQuery ="SELECT COUNT(*) AS Customers FROM users WHERE Role='customer'";
$customerResult =mysqli_query($con,$customerQuery);
$customers =mysqli_fetch_assoc($customerResult);
$productQuery ="SELECT COUNT(*) AS Products FROM product";
$productResult =mysqli_query($con,$productQuery);
$products =mysqli_fetch_assoc($productResult);
$outQuery ="SELECT COUNT(*) AS OutOfStock FROM product WHERE Quantity=0";
$outResult =mysqli_query($con,$outQuery);
$outStock =mysqli_fetch_assoc($outResult);
$userQuery ="SELECT COUNT(*) AS TotalUsers FROM users";
$userResult =mysqli_query($con,$userQuery);
$totalUsers =mysqli_fetch_assoc($userResult);
$dailyQuery ="SELECT OrderDate,COUNT(OrderId) AS TotalOrders,SUM(TotalAmount) AS Revenue
FROM orders
WHERE Status='Paid'
GROUP BY OrderDate
ORDER BY OrderDate DESC";
$dailyResult =mysqli_query($con,$dailyQuery);

?>

<!DOCTYPE html>

<html>

<head>

    <title>
        Monthly Report
    </title>

    <link rel="stylesheet" type="text/css" href="Manager.css">

</head>

<body>

<div class="menu">

    <div>
        <a href="Manager.php">
            Dashboard
        </a>
    </div>

    <div>
        Monthly Report
    </div>

</div>

<h1>Monthly Management Report</h1>

<div class="summary">

    <div class="card">
        <h3>Total Revenue</h3>

        <p>
            <?php echo $revenue['Revenue']; ?> RWF
        </p>
    </div>

    <div class="card">
        <h3>Total Orders</h3>

        <p>
            <?php echo $orders['Orders']; ?>
        </p>
    </div>

    <div class="card">
        <h3>Total Customers</h3>

        <p>
            <?php echo $customers['Customers']; ?>
        </p>
    </div>

    <div class="card">
        <h3>Out Of Stock Products</h3>

        <p>
            <?php echo $outStock['OutOfStock']; ?>
        </p>
    </div>

</div>

<h2>System Summary</h2>

<div class="System">

    <p>
        Total Products :
        <?php echo $products['Products']; ?>
    </p>

    <p>
        Total Registered Users :
        <?php echo $totalUsers['TotalUsers']; ?>
    </p>

    <p>
        Total Revenue :
        <?php echo $revenue['Revenue']; ?> RWF
    </p>

</div>

<h2>Sales Breakdown</h2>

<table border="1">

<tr>
    <th>Date</th>
    <th>Orders</th>
    <th>Revenue</th>
</tr>

<?php

while($row =
      mysqli_fetch_assoc($dailyResult))
{
?>

<tr>

<td>
    <?php echo $row['OrderDate']; ?>
</td>

<td>
    <?php echo $row['TotalOrders']; ?>
</td>

<td>
    <?php echo $row['Revenue']; ?> RWF
</td>

</tr>

<?php
}
?>

</table>

<footer>

    AUCA Canteen Management System © 2026

</footer>

</body>

</html>