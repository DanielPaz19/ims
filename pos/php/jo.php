<?php
// header('content-type: application/json; charset=utf-8');
// header('Content-Type: application/x-www-form-urlencoded; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

if (isset($_GET['id'])) {
  require 'config.php';

  // Load all JO Data
  $id = $_GET['id'];

  $qryJo = "SELECT jo_tb.jo_id,jo_tb.jo_no,jo_tb.customers_id,jo_tb.emp_id,jo_tb.jo_date,jo_tb.user_id,jo_tb.closed,jo_tb.jo_type_id,
  customers.customers_name, customers.customers_company, customers.customers_address, customers.customers_contact, customers.customers_note
   FROM  jo_tb 
   LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
   WHERE jo_id = $id AND jo_tb.jo_type_id = '1' AND jo_tb.closed = '0'";
  $resultJo = mysqli_query($db, $qryJo);

  $output = [];
  if (mysqli_num_rows($resultJo) > 0) {
    while ($rowJo = mysqli_fetch_assoc($resultJo)) {

      // Run Select for product array for each jo_id
      $qryJoItems = "SELECT  product.product_id, product.product_name, unit_tb.unit_name, jo_product.product_id, jo_product.jo_product_qty, jo_product.jo_product_price,
      jo_product.jo_remarks, 
      jo_product.jo_product_price * jo_product.jo_product_qty AS jo_product_total 
      FROM jo_product 
      LEFT JOIN product ON product.product_id = jo_product.product_id 
      LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
      WHERE jo_product.jo_id =" . $rowJo['jo_id'];
      $resultJoItems = mysqli_query($db, $qryJoItems);

      if (mysqli_num_rows($resultJoItems) > 0) {
        while ($rowJoItems = mysqli_fetch_assoc($resultJoItems)) {
          $rowJo['items'][] = $rowJoItems;
        }
      }

      $output[] = $rowJo;
      // Insert product Id on product Array based on jo_id and push to each output

    }
  }
}

if (isset($_GET['pending'])) {
  require 'config.php';


  $qryJo = "SELECT jo_tb.jo_id,jo_tb.jo_no,jo_tb.customers_id,jo_tb.emp_id,jo_tb.jo_date,jo_tb.user_id,jo_tb.closed,jo_tb.jo_type_id,
  customers.customers_name, customers.customers_company, customers.customers_address, customers.customers_contact, customers.customers_note
   FROM  jo_tb 
   LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
   WHERE jo_tb.jo_type_id = '1' AND jo_tb.closed = '0' ORDER BY jo_tb.jo_date DESC";

  $resultJo = mysqli_query($db, $qryJo);

  $output = [];
  if (mysqli_num_rows($resultJo) > 0) {
    while ($rowJo = mysqli_fetch_assoc($resultJo)) {
      $output[] = $rowJo;
    }
  }
}

if (isset($_GET['qry'])) {
  require 'config.php';

  $qry = $_GET['qry'];


  $qryJo = "SELECT jo_tb.jo_id,jo_tb.jo_no,jo_tb.customers_id,jo_tb.emp_id,jo_tb.jo_date,jo_tb.user_id,jo_tb.closed,jo_tb.jo_type_id,
  customers.customers_name, customers.customers_company, customers.customers_address, customers.customers_contact, customers.customers_note
   FROM  jo_tb 
   LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id 
   WHERE (jo_tb.jo_type_id = '1' AND jo_tb.closed = '0') AND (customers.customers_name LIKE '%$qry%' OR jo_tb.jo_no LIKE '%$qry%') ORDER BY jo_tb.jo_date DESC";

  $resultJo = mysqli_query($db, $qryJo);

  $output = [];
  if (mysqli_num_rows($resultJo) > 0) {
    while ($rowJo = mysqli_fetch_assoc($resultJo)) {
      $output[] = $rowJo;
    }
  }
}



if (isset($_GET['payment'])) {
  require 'config.php';

  $joId = $_GET['id'];

  $qryPayments = "SELECT * FROM payment_tb WHERE jo_id = '$joId'";
  $resultPayments = mysqli_query($db, $qryPayments);
  $output = [];
  if (mysqli_num_rows($resultPayments) > 0) {
    while ($row = mysqli_fetch_assoc($resultPayments)) {
      $output[] = $row;
    }
  }
}

if (isset($_GET['save'])) {
  require_once 'config.php';

  $json = file_get_contents('php://input');
  $payment = json_decode($json);

  $mode = $payment->mode;
  $joId = $payment->joId;
  $invoiceNum = $payment->invoiceNum;
  $amount = $payment->amount;
  $userId = $payment->userId;
  $paymentDate = $payment->date;

  $sql = "INSERT INTO payment_tb(jo_id, invoice_no,payment_amount, user_id)
  VALUES ('$joId', '$invoiceNum', '$amount', '$userId')";

  if (mysqli_query($db, $sql)) {
    $lastPaymentId = mysqli_insert_id($db);

    if ($mode === "cash") {
      $modeSql = "INSERT INTO cash_payment(payment_id,cash_pay_amount,cash_pay_date) 
      VALUES('$lastPaymentId', '$amount','$paymentDate')";
    }

    if ($mode === "online") {
      $platform = $payment->platform;
      $onlineRef = $payment->reference;
      $modeSql = "INSERT INTO online_payment(payment_id,online_platform_id,online_payment_reference,online_payment_amount, online_payment_date) 
      VALUES('$lastPaymentId', '$platform', '$onlineRef', '$amount', '$paymentDate')";
    }

    if ($mode === "cheque") {
      $chequeNum = $payment->chequeNum;
      $bankId = $payment->bank;
      $modeSql = "INSERT INTO cheque_payment(payment_id,cheque_number,cheque_date,cheque_amount, bank_id) 
      VALUES('$lastPaymentId', '$chequeNum','$paymentDate', '$amount', '$bankId')";
    }
    mysqli_query($db, $modeSql);
    $output = new stdClass();
    $output->paymentId = $lastPaymentId;
  }
}


echo json_encode($output);
