<?php
header('Access-Control-Allow-Origin: *');

if (isset($_GET['id'])) {
  require 'config.php';

  // Load all JO Data
  $id = $_GET['id'];

  $qryJo = "SELECT jo_tb.jo_id,jo_tb.jo_no,jo_tb.customers_id,jo_tb.emp_id,jo_tb.jo_date,jo_tb.user_id,jo_tb.closed,jo_tb.jo_type_id,
  customers.customers_name, customers.customers_company, customers.customers_address, customers.customers_contact, customers.customers_note
   FROM  jo_tb 
   LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
   WHERE jo_id = $id";
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
   LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id ORDER BY jo_tb.jo_date DESC";

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
   WHERE customers.customers_name LIKE '%$qry%' OR jo_tb.jo_no LIKE '%$qry%' ORDER BY jo_tb.jo_date DESC";

  $resultJo = mysqli_query($db, $qryJo);

  $output = [];
  if (mysqli_num_rows($resultJo) > 0) {
    while ($rowJo = mysqli_fetch_assoc($resultJo)) {
      $output[] = $rowJo;
    }
  }
}

echo json_encode($output);
