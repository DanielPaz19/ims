<?php

require 'config.php';

// Load all JO Data
$qryJo = "SELECT * FROM  jo_tb ";
$resultJo = mysqli_query($db, $qryJo);

$output = [];
if (mysqli_num_rows($resultJo) > 0) {
  while ($rowJo = mysqli_fetch_assoc($resultJo)) {

    // Run Select for product array for each jo_id
    $qryJoItems = "SELECT jo_product.product_id, jo_product.jo_id, jo_product.jo_product_qty, jo_product.jo_product_price,
    jo_product.jo_remarks FROM jo_product WHERE jo_product.jo_id =" . $rowJo['jo_id'];
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