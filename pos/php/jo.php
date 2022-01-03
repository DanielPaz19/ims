<?php
header('Access-Control-Allow-Origin: *');

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
    jo_product.jo_remarks FROM jo_product 
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

echo json_encode($output);

// Filter JO Data so that only those that are not fully paid will appear