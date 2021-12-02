<?php

// connect to the database
include "../config.php";
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_GET['add'])) {
  // receive all input values from the form
  echo "connect";
  $product_name = mysqli_real_escape_string($db, $_GET['product_name']);
  $class_id = mysqli_real_escape_string($db, $_GET['class_id']);
  $qty = mysqli_real_escape_string($db, $_GET['qty']);
  $unit_id = mysqli_real_escape_string($db, $_GET['unit_id']);
  $pro_remarks = mysqli_real_escape_string($db, $_GET['pro_remarks']);
  $location = mysqli_real_escape_string($db, $_GET['loc_id']);
  $barcode = mysqli_real_escape_string($db, $_GET['barcode']);
  $price = mysqli_real_escape_string($db, $_GET['price']);
  $cost = mysqli_real_escape_string($db, $_GET['cost']);
  $dept_id = mysqli_real_escape_string($db, $_GET['dept_id']);
  $sup_id = mysqli_real_escape_string($db, $_GET['sup_id']);
  $product_type_id = mysqli_real_escape_string($db, $_GET['product_type_id']);




  $query = "INSERT INTO product (product_name,class_id,qty,unit_id,pro_remarks,loc_id,barcode,price,cost,dept_id,sup_id,product_type_id) 
  			  VALUES('$product_name','$class_id','$qty','$unit_id','$pro_remarks','$location','$barcode','$price','$cost','$dept_id','$sup_id','$product_type_id')";


  if (mysqli_query($db, $query)) {
    $last_id = mysqli_insert_id($db);

    // product_id	bal_qty	in_qty	out_qty	mov_type_id	move_ref	mov_date	

    mysqli_query($db, "INSERT INTO move_product (product_id, bal_qty, in_qty, out_qty, mov_type_id, move_ref, mov_date)
    VALUES('$last_id', '$qty', '$qty', '0', '5', 'Beginning','" . date('Y-m-d') . "')");

    echo date('Y-m-d');

    echo '<script type="text/javascript"> alert("Data Inserted Successfully!"); </script>';
  } else {
    echo '<script type="text/javascript"> alert("Error Uploading Data!"); </script>';  // when error occur
  }

  header('location: ../../itemlist_main.php');
}
