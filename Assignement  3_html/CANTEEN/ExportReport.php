<?php

session_start();

$con = mysqli_connect("localhost","root","","auca_canteen");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Monthly_Report.csv"');

$output = fopen('php://output', 'w');

fputcsv($output,
[
    'Date',
    'Orders',
    'Revenue'
]);

$query ="SELECT OrderDate,COUNT(OrderId) AS Orders,SUM(TotalAmount) AS Revenue
FROM orders
WHERE Status='Paid'
GROUP BY OrderDate";

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_assoc($result))
{
    fputcsv($output,$row);
}

fclose($output);

exit();

?>