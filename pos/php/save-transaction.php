<?php
include 'config.php';

// {"customerId":12,"transactionId":3,"transDate":"2021-10-23T23:45:24.908Z","productId":[15],"qty":[1],"discount":[0],"price":[0],"total":0}


$transDetails = json_decode($_POST['json']);
$customerId = $transDetails->customerId;
$transDate = $transDetails->transDate;
$productId = $transDetails->productId;
$productQty = $transDetails->qty;
$productPrice = $transDetails->price;
$discount = $transDetails->discount;
$orderId = $transDetails->transactionId;
$total = $transDetails->total;

$lastQty = [];

$query = "INSERT INTO order_tb (customer_id, pos_date, total, order_status_id) 
  VALUES ('$customerId','$transDate','$total','1');";

$query2 = "INSERT INTO order_payment (order_id, payment_type_id, order_payment_credit, order_payment_balance, order_payment_date, payment_status_id)
  VALUES ('$orderId','0','$total','$total','$transDate', '1');";

mysqli_query($db, $query);
mysqli_query($db, $query2);





$limit = 0;
while (sizeof($productId) != $limit) {

  $query3 = "INSERT INTO order_product (product_id, order_id, pos_temp_qty, pos_temp_price, pos_temp_disamount) 
    VALUES ('" . $productId[$limit] . "','" . $orderId . "','" . $productQty[$limit] . "','" . $productPrice[$limit] . "','" . $discount[$limit] . "');";
  // echo $productId[$limit], $productQty[$limit], $discount[$limit] ."<br>";

  mysqli_query($db, $query3);

  //subract qty from product table
  $query4 = "SELECT qty FROM product WHERE product_id=" . $productId[$limit];
  $result = mysqli_query($db, $query4);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $query5 = "UPDATE product SET qty=" . ($row['qty'] - $productQty[$limit]) . " WHERE product_id =" . $productId[$limit];

      mysqli_query($db, $query5);
    };
  }


  $limit++;
}

echo $query;
