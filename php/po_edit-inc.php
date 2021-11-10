<?php

// IF Edit button Click from PO Main
if (isset($_GET['editpo'])) {

  $poId = $_GET['id'];

  require 'php/config.php';

  $result = mysqli_query(
    $db,
    "SELECT po_tb.po_id, po_tb.po_terms, po_tb.po_remarks, po_tb.po_code,
  po_tb.po_date, po_tb.po_title, po_product.item_qtyorder, po_product.item_cost, 
  po_product.item_disamount, po_product.po_temp_tot, product.product_name, product.product_name,
  product.class_id, product.unit_id, product.product_id, sup_tb.sup_name, unit_tb.unit_name
 FROM po_tb  
 LEFT JOIN po_product ON po_product.po_id = po_tb.po_id
 LEFT JOIN product ON po_product.product_id = product.product_id
 LEFT JOIN sup_tb ON sup_tb.sup_id = po_tb.sup_id
 LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
 WHERE po_tb.po_id ='$poId'"
  );


  // PO Details
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $supName = $row['sup_name'];
      $poTerms = $row['po_terms'];
      $poRemarks = $row['po_remarks'];
      $poDate = $row['po_date'];
      $poCode = $row['po_code'];
      $poTitle = $row['po_title'];
      $productId[] = str_pad($row['product_id'], 8, 0, STR_PAD_LEFT);
      $productName[] = $row['product_name'];
      $qtyIn[] = $row['item_qtyorder'];
      $unitId[] = $row['unit_id'];
      $unitName[] = $row['unit_name'];
      $itemCost[] = $row['item_cost'];
      $itemDisamount[] = $row['item_disamount'];
      $itemTotal[] = $row['po_temp_tot'];
    }
  } else {
    echo "0 results";
  }
}

// If po_edit-page.php update button is set
if (isset($_POST['updatepo'])) {
  echo 'you clicked update';
}

// If po_edit-page.php update button is set
if (isset($_POST['cancelupdate'])) {
  header('location: ../po_main.php');
}
