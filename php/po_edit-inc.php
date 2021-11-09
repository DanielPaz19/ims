<?php
if (isset($_POST['po_submit'])) {
  $id = $_POST['id'];
  $po_code = mysqli_real_escape_string($db, $_POST['po_code']);
  $po_title = mysqli_real_escape_string($db, $_POST['po_title']);
  $po_date = mysqli_real_escape_string($db, $_POST['po_date']);
  $po_remarks = mysqli_real_escape_string($db, $_POST['po_remarks']);
  $sup_id = mysqli_real_escape_string($db, $_POST['sup_id']);
  $productId = $_POST['productId'];
  $poTempQty = $_POST['poTempQty'];
  $cost = $_POST['cost'];
  $discount = $_POST['discount'];
  $incomintQty = $_POST['incomingQty'];

  require_once 'config.php';

  mysqli_query($db, "UPDATE po_tb SET po_code='$po_code', po_title='$po_title' ,po_date='$po_date',po_remarks='$po_remarks',sup_id='$sup_id'
WHERE po_id='$id'");


  function updatePoProd($id, $productId, $poTempQty, $cost, $discount, $incomintQty)
  {
    include('../php/config.php');
    mysqli_query($db, "UPDATE po_product SET item_qtyorder = '$poTempQty', item_cost = '$cost',
item_disamount = '$discount', po_temp_tot = '$incomintQty' WHERE po_id = '$id' AND product_id = '$productId'");
  }

  function addPoProdRecord($productId, $id, $poTempQty, $cost, $discount, $incomintQty)
  {
    include('../php/config.php');
    mysqli_query($db, "INSERT INTO po_product(product_id, po_id, item_qtyorder, item_cost, item_disamount, po_temp_tot)
VALUES ('$productId', '$id', '$poTempQty', '$cost', '$discount', '$incomintQty')");
  }


  // If product ID exist, update the record
  // If product ID doesnt exist, add record
  $counter = 0;
  while (count($productId) !== $counter) {
    $result = mysqli_query($db, "SELECT * FROM po_product WHERE product_id = $productId[$counter] AND po_id = $id");
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
      addPoProdRecord($productId[$counter], $id, $poTempQty[$counter], $cost[$counter], $discount[$counter], $incomintQty[$counter]);
    } else {
      updatePoProd($id, $productId[$counter], $poTempQty[$counter], $cost[$counter], $discount[$counter], $incomintQty[$counter]);
    }
    $counter++;
  }



  header("Location: ../po_main.php");
}
