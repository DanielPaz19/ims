<?php
include 'config.php';


$query = "SELECT product.pro_remarks,
            product.product_id, 
            product.product_name, 
            product.price, 
            product.qty, 
            product.barcode, 
            loc_name,
            product.unit_id,
            product.cost
            FROM product 
            LEFT JOIN loc_tb ON product.loc_id = loc_tb.loc_id
            WHERE product_name LIKE '%" . $_GET['q'] . "%' ORDER BY product_id LIMIT 100";

$output = [];

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
  }
} else {
  echo "No result";
}

echo json_encode($output);
