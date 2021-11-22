<?php
session_start();
$userLevel = $_SESSION['level'];

// if ($userLevel > 1) {
//     echo "Unauthorized";
//     exit();
// }

$orderId = $_POST['orderId'];
require 'config.php';


if (!mysqli_query($db, "UPDATE order_tb SET order_status_id = '4' WHERE order_id = '$orderId'")) {
  echo "Error on SQL";
  exit();
}

echo "Order Successfully Cancelled!";

// Change status of order on order_tb
// Change qty of products in product_tb based on order_product
// Update in_qty on Item movement