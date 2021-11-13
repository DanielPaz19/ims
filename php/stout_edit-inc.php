<?php

// IF Edit button Click from PO Main
if (isset($_GET['editStout'])) {

    $stoutId = $_GET['id'];

    require 'php/config.php';

    $result = mysqli_query(
        $db,
        "SELECT stout_tb.stout_id, stout_tb.stout_code, stout_tb.stout_title, stout_tb.stout_date, stout_tb.stout_remarks, employee_tb.emp_name,  stout_product.product_id, stout_product.stout_id, stout_product.stout_temp_qty, stout_product.stout_temp_cost, stout_product.stout_temp_disamount, stout_product.stout_temp_tot, product.product_name, unit_tb.unit_name, unit_tb.unit_id, employee_tb.emp_id
        FROM stout_tb
        LEFT JOIN employee_tb ON employee_tb.emp_id = stout_tb.emp_id
        LEFT JOIN stout_product ON stout_product.stout_id = stout_tb.stout_id
        LEFT JOIN product ON product.product_id = stout_product.product_id
        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
        WHERE stout_tb.stout_id ='$stoutId'"
    );



    // PO Details
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $empId = $row['emp_id'];
            $empName = $row['emp_name'];
            $stoutCode = $row['stout_code'];
            $stoutTitle = $row['stout_title'];
            $stoutRemarks = $row['stout_remarks'];
            $stoutDate = $row['stout_date'];

            $productId[] = str_pad($row['product_id'], 8, 0, STR_PAD_LEFT);
            $productName[] = $row['product_name'];
            $qtyIn[] = $row['stout_temp_qty'];
            $unitId[] = $row['unit_id'];
            $unitName[] = $row['unit_name'];
            $itemPrice[] = $row['stout_temp_cost'];
            $itemTotal[] = $row['stout_temp_tot'];
        }
    } else {
        echo "0 results";
    }
}

// If po_edit-page.php update button is set
if (isset($_POST['updatestout'])) {
    $stoutId = $_POST['stoutId'];
    $empId = $_POST['empId'];
    $stoutCode = $_POST['stoutCode'];
    $stoutTitle = $_POST['stoutTitle'];
    $stoutRemarks = $_POST['stoutRemarks'];
    $stoutDate = $_POST['stoutDate'];

    $productId = $_POST['productId'];
    $qtyIn = $_POST['qtyIn'];
    $itemPrice = $_POST['itemPrice'];
    $itemTotal = $_POST['itemTotal'];

    require '../php/config.php';

    // Update po_tb
    mysqli_query(
        $db,
        "UPDATE stout_tb SET stout_code='$stoutCode', stout_title='$stoutTitle', emp_id='$empId', stout_date='$stoutDate', stout_remarks='$stoutRemarks' WHERE stout_id='$stoutId' "
    );


    // Update po_product
    $limit = 0;
    while (count($productId) !== $limit) {
        // Check product id from po_product
        $checkResult = mysqli_query($db, "SELECT product_id FROM stout_product WHERE stout_id = $stoutId AND product_id ='" . $productId[$limit] . "'");

        if (mysqli_num_rows($checkResult) > 0) {
            // If product id already exist on po_product, UPDATE
            mysqli_query($db, "UPDATE stout_product SET stout_temp_qty = '$qtyIn[$limit]', stout_temp_cost = '$itemPrice[$limit]', stout_temp_tot= '$itemTotal[$limit]' WHERE stout_id = '$stoutId' AND product_id ='$productId[$limit]'");
        } else {
            // If product id dont exist on po_product, INSERT
            mysqli_query($db, "INSERT INTO stout_product(product_id, stout_id, stout_temp_qty, stout_temp_cost, stout_temp_tot) 
      VALUES ('$productId[$limit]','$stoutId','$qtyIn[$limit]','$itemPrice[$limit]','$itemTotal[$limit]')");
        }
        $limit++;
    }

    // editpo&id=2&supId=107&supName=A.F.%20SA

    header("location: ../stout_edit-page.php?editStout&id=$stoutId&update=success");
}

// If po_edit-page.php update button is set
if (isset($_POST['cancelupdate'])) {
    header('location: ../stout_main.php');
}


if (isset($_GET['update'])) {
    echo '<script>alert("Update records successfully !")</script>';
}
