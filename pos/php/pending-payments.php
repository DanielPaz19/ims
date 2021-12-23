<?php
include "config.php";

// $joId = $_POST['joId'];
$output = [];

$query = "SELECT order_tb.jo_id, jo_tb.jo_no, order_tb.order_status_id, order_tb.order_id, order_tb.customer_id, order_tb.total, order_tb.pos_date, 
  customers.customers_name, order_payment.order_payment_balance, order_payment_id
  FROM order_tb 
  LEFT JOIN jo_tb ON jo_tb.jo_id = order_tb.jo_id
  LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
  LEFT JOIN order_payment ON order_tb.order_id = order_payment.order_id
  WHERE order_tb.jo_id = '95' ORDER BY order_tb.order_id DESC";

$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
  }
} else {
  echo "No result";
}

echo json_encode($output);
