<?php 
  include 'config.php';

  // CASH JSON
  // {"type":1,"id":"3","tendered":100,"balance":200,"change":0,"status":1,"date":"2021-10-21T06:35:56.929Z","productId":[],"qty":[],"discount":[],"price":[],"total":0,"orderId":15,"platform":0,"reference":"","paymentDate":"","bank":"","chequeNumber":"","chequeDate":""}

  // ONLINE JSON
  // {"type":2,"id":"4","tendered":100,"balance":100,"change":0,"status":1,"date":"2021-10-21T06:37:49.374Z","productId":[],"qty":[],"discount":[],"price":[],"total":0,"orderId":15,"platform":2,"reference":"90192083","paymentDate":"2021-10-20","bank":"","chequeNumber":"","chequeDate":""}

  // CHEQUE JSON
  // {"type":3,"id":"5","tendered":100,"balance":0,"change":0,"status":1,"date":"2021-10-21T06:39:30.956Z","productId":[],"qty":[],"discount":[],"price":[],"total":0,"orderId":15,"platform":0,"reference":"","paymentDate":"","bank":"1","chequeNumber":"121241","chequeDate":"2021-10-21"}



  $paymentDetails = json_decode($_POST['json']);
  $paymentTendered = $paymentDetails->tendered;
  $balance = $paymentDetails->balance;
  $change = $paymentDetails->change;
  $paymentStatus = $paymentDetails->status;
  $paymentDate = $paymentDetails->date;
  $paymentType = $paymentDetails->type;
  $orderId = $paymentDetails->orderId;
  $paymentId = $paymentDetails->id;
  $onlinePlatformId = $paymentDetails->platform;
  $onlineReference = $paymentDetails->reference;
  $onlinePaymentDate = $paymentDetails->paymentDate;
  $bankId = $paymentDetails->bank;
  $chequeNumber = $paymentDetails->chequeNumber;
  $chequeDate = $paymentDetails->chequeDate;




  if ($balance > 0 ) {
    //status = 1 (account receivable)
    mysqli_query($db, "INSERT INTO order_payment (payment_type_id, order_id, order_payment_debit, order_payment_date, order_payment_balance, payment_status_id) 
    VALUES ('$paymentType','$orderId','$paymentTendered','$paymentDate','$balance','1');");
  }
  
  if ($balance <= 0) {
    //status = 2 (fully paid)
    mysqli_query($db, "INSERT INTO order_payment (payment_type_id, order_id, order_payment_debit, order_payment_date, order_payment_balance, payment_status_id) 
    VALUES ('".$paymentType  ."','" .$orderId ."','" .$paymentTendered ."','" .$paymentDate ."','" .$balance ."','2');");

    mysqli_query($db, "UPDATE order_tb SET order_status_id = '3' WHERE order_id = '$orderId'");
  }
  
  //change status to archived (meaning: previous or old)
  mysqli_query($db, "UPDATE order_payment SET payment_status_id = '0' WHERE order_payment_id ='" .$paymentId ."'");

  // Save Online Details
  if ($paymentType === 2) {
    mysqli_query($db, "INSERT INTO online_payment (online_platform_id, online_payment_reference, online_payment_amount, online_payment_date, order_payment_id)
    VALUES('$onlinePlatformId', '$onlineReference', '$paymentTendered', '$onlinePaymentDate', '$paymentId')");
  }
  
  // Save Cheque Details
  if ($paymentType === 3) {
    mysqli_query($db, "INSERT INTO cheque_payment (bank_id, cheque_number, cheque_date, cheque_amount, order_payment_id)
    VALUES('$bankId', '$chequeNumber', '$chequeDate', '$paymentTendered', '$paymentId')");
  }
  

  //send result  
  $query3 = "SELECT * FROM order_payment ORDER BY order_payment_id DESC LIMIT 1";
  $result = mysqli_query($db, $query3);

  if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)){
           $output =  $row;
         };
       }

  echo json_encode($output);
