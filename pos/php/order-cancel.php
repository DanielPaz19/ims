<?php
session_start();
$userLevel = $_SESSION['level'];

if ($userLevel > 1) {
    echo "Unauthorized";
    exit();
}

include 'config.php';

$orderId = $_POST['orderId'];
mysqli_query($db, "UPDATE order_tb SET order_status_id = '4' WHERE order_id = '$orderId'");

echo "Order Cancelled";
exit();
