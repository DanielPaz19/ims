<?php

// connect to the database
include "config.php";
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item-Acrylic-items
if (isset($_GET['addAcry'])) {
  // receive all input values from the form
  echo "connect";
  $acry_color_id = mysqli_real_escape_string($db, $_GET['acry_color_id']);
  $acry_thick_id = mysqli_real_escape_string($db, $_GET['acry_thick_id']);
  $product_type_id = mysqli_real_escape_string($db, $_GET['product_type_id']);
  $inventory_type_id = mysqli_real_escape_string($db, $_GET['inventory_type_id']);
  $acry_mask_id = mysqli_real_escape_string($db, $_GET['acry_mask_id']);
  $acry_class_id = mysqli_real_escape_string($db, $_GET['acry_class_id']);
  $unit_id = mysqli_real_escape_string($db, $_GET['unit_id']);
  $location = mysqli_real_escape_string($db, $_GET['loc_id']);
  $qty = mysqli_real_escape_string($db, $_GET['qty']);
  $cost = mysqli_real_escape_string($db, $_GET['cost']);
  $price = mysqli_real_escape_string($db, $_GET['price']);
  $barcode = mysqli_real_escape_string($db, $_GET['barcode']);
  $pro_remarks = mysqli_real_escape_string($db, $_GET['pro_remarks']);
  $product_name = mysqli_real_escape_string($db, $_GET['product_name']);

// checking_itemname
    $checkResult = mysqli_query($db, "SELECT product.product_name, acry_color_tb.acry_color_id,acry_thick_tb.acry_thick_id, acry_tb.product_id 
                                      FROM acry_tb 
                                      LEFT JOIN product ON product.product_id = acry_tb.product_id
                                      LEFT JOIN acry_color_tb ON acry_color_tb.acry_color_id = acry_tb.acry_color_id
                                      LEFT JOIN acry_thick_tb ON acry_thick_tb.acry_thick_id = acry_tb.acry_thick_id

    
    WHERE product.product_name = '$product_name' AND acry_color_tb.acry_color_id = '$acry_color_id' AND acry_thick_tb.acry_thick_id ='$acry_thick_id'");

    if (mysqli_num_rows($checkResult) > 0) {
        // If product name already exist on product_name, go back to..
        echo "<script>alert('Item Already Exist !!')</script>";
        echo "<script>location.href='../../itemlist_main.php'</script>";
    } else {
        // If product id dont exist on po_product, INSERT
        mysqli_query($db, "INSERT INTO product(product_name, unit_id, product_type_id,inventory_type_id, price, cost, pro_remarks, loc_id) 
  VALUES ('$product_name','$unit_id',1,'$inventory_type_id','$price','$cost','$pro_remarks','$location')");
    }

    $last_id = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO acry_tb (product_id,acry_color_id,acry_mask_id,acry_thick_id,acry_class_id,barcode,product_type_id)
    VALUES('$last_id','$acry_color_id','$acry_mask_id','$acry_thick_id','$acry_class_id','$barcode','$product_type_id' )");


    mysqli_query($db, "INSERT INTO product_loc_tb (product_id,loc_id,qty)
    VALUES('$last_id','$location','$qty')");
    echo "<script>alert('Create New Item Successfully!')</script>";
    echo "<script>location.href='../../itemlist_main.php'</script>";
  }
  








// Add item-Fabricated-items
if (isset($_GET['addFabr'])) {
  // receive all input values from the form
  echo "connect";
  $product_type_id = mysqli_real_escape_string($db, $_GET['product_type_id']);
  $inventory_type_id = mysqli_real_escape_string($db, $_GET['inventory_type_id']);

  $product_name = mysqli_real_escape_string($db, $_GET['product_name']);
  $unit_id = mysqli_real_escape_string($db, $_GET['unit_id']);
  $location = mysqli_real_escape_string($db, $_GET['loc_id']);
  $qty = mysqli_real_escape_string($db, $_GET['qty']);
  $cost = mysqli_real_escape_string($db, $_GET['cost']);
  $price = mysqli_real_escape_string($db, $_GET['price']);
  $pro_remarks = mysqli_real_escape_string($db, $_GET['pro_remarks']);


// checking_itemname
    $checkResult = mysqli_query($db, "SELECT product.product_name
                                      FROM product  WHERE product.product_name = '$product_name'");

    if (mysqli_num_rows($checkResult) > 0) {
        // If product name already exist on product_name, go back to..
        echo "<script>alert('Item Already Exist !!')</script>";
        echo "<script>location.href='../../itemlist_main.php'</script>";
    } else {
        // If product id dont exist on po_product, INSERT
        mysqli_query($db, "INSERT INTO product(product_name, unit_id, product_type_id, inventory_type_id, price, cost, pro_remarks, loc_id) 
  VALUES ('$product_name','$unit_id',2,'$inventory_type_id','$price','$cost','$pro_remarks','$location')");
    }

    $last_id = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO fab_tb(product_id)
    VALUES('$last_id')");

    mysqli_query($db, "INSERT INTO product_loc_tb (product_id,loc_id,qty)
    VALUES('$last_id','$location','$qty')");
    echo "<script>alert('Create New Item Successfully!')</script>";
    echo "<script>location.href='../../itemlist_main.php'</script>";
  }
  


  // Add item-Prcg-Items
if (isset($_GET['addPrcg'])) {
  // receive all input values from the form
  echo "connect";
  $product_type_id = mysqli_real_escape_string($db, $_GET['product_type_id']);
  $product_name = mysqli_real_escape_string($db, $_GET['product_name']);
  $unit_id = mysqli_real_escape_string($db, $_GET['unit_id']);
  $location = mysqli_real_escape_string($db, $_GET['loc_id']);
  $qty = mysqli_real_escape_string($db, $_GET['qty']);
  $cost = mysqli_real_escape_string($db, $_GET['cost']);
  $price = mysqli_real_escape_string($db, $_GET['price']);
  $pro_remarks = mysqli_real_escape_string($db, $_GET['pro_remarks']);
  $prcg_class_id = mysqli_real_escape_string($db, $_GET['prcg_class_id']);

// checking_itemname
    $checkResult = mysqli_query($db, "SELECT product.product_name
                                      FROM product  WHERE product.product_name = '$product_name'");

    if (mysqli_num_rows($checkResult) > 0) {
        // If product name already exist on product_name, go back to..
        echo "<script>alert('Item Already Exist !!')</script>";
        echo "<script>location.href='../../itemlist_main.php'</script>";
    } else {
        // If product id dont exist on po_product, INSERT
        mysqli_query($db, "INSERT INTO product(product_name, unit_id, product_type_id, price, cost, pro_remarks, loc_id) 
  VALUES ('$product_name','$unit_id',3,'$price','$cost','$pro_remarks','$location')");
    }

    $last_id = mysqli_insert_id($db);
    mysqli_query($db, "INSERT INTO prcg_tb(product_id,prcg_class_id)
    VALUES('$last_id','$prcg_class_id')");

    mysqli_query($db, "INSERT INTO product_loc_tb (product_id,loc_id,qty)
    VALUES('$last_id','$location','$qty')");
    echo "<script>alert('Create New Item Successfully!')</script>";
    echo "<script>location.href='../../itemlist_main.php'</script>";
  }
  