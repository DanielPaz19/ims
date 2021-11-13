<?php

// IF Edit button Click from PO Main
if (isset($_GET['editStin'])) {

    $stinId = $_GET['id'];

    require 'php/config.php';

    $result = mysqli_query(
        $db,
        "SELECT stin_tb.stin_id, stin_tb.stin_code, stin_tb.stin_title, stin_tb.stin_date, stin_tb.stin_remarks, employee_tb.emp_name, stin_product.stin_product_id, stin_product.product_id, stin_product.stin_id, stin_product.stin_temp_qty, stin_product.stin_temp_cost, stin_product.stin_temp_disamount, stin_product.stin_temp_tot, product.product_name, unit_tb.unit_name, unit_tb.unit_id, employee_tb.emp_id
        FROM stin_tb
        LEFT JOIN employee_tb ON employee_tb.emp_id = stin_tb.emp_id
        LEFT JOIN stin_product ON stin_product.stin_id = stin_tb.stin_id
        LEFT JOIN product ON product.product_id = stin_product.product_id
        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
        WHERE stin_tb.stin_id ='$stinId'"
    );



    // PO Details
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $empId = $row['emp_id'];
            $empName = $row['emp_name'];
            $stinCode = $row['stin_code'];
            $stinTitle = $row['stin_title'];
            $stinRemarks = $row['stin_remarks'];
            $stinDate = $row['stin_date'];
            $productId[] = str_pad($row['product_id'], 8, 0, STR_PAD_LEFT);
            $productName[] = $row['product_name'];
            $qtyIn[] = $row['stin_temp_qty'];
            $unitId[] = $row['unit_id'];
            $unitName[] = $row['unit_name'];
            $itemPrice[] = $row['stin_temp_cost'];
            $itemTotal[] = $row['stin_temp_tot'];
        }
    } else {
        echo "0 results";
    }
}

// If po_edit-page.php update button is set
if (isset($_POST['updatestin'])) {
    $stinId = $_POST['stinId'];
    $empId = $_POST['empId'];
    $stinCode = $_POST['stinCode'];
    $stinTitle = $_POST['stinTitle'];
    $stinRemarks = $_POST['stinRemarks'];
    $stinDate = $_POST['stinDate'];

    $productId = $_POST['productId'];
    $qtyIn = $_POST['qtyIn'];
    $itemPrice = $_POST['itemPrice'];
    $itemTotal = $_POST['itemTotal'];

    require '../php/config.php';

    // Update po_tb
    mysqli_query(
        $db,
        "UPDATE stin_tb SET stin_code='$stinCode', stin_title='$stinTitle', emp_id='$empId', stin_date='$stinDate', stin_remarks='$stinRemarks' WHERE stin_id='$stinId' "
    );


    // Update po_product
    $limit = 0;
    while (count($productId) !== $limit) {
        // Check product id from po_product
        $checkResult = mysqli_query($db, "SELECT product_id FROM stin_product WHERE stin_id = $stinId AND product_id ='" . $productId[$limit] . "'");

        if (mysqli_num_rows($checkResult) > 0) {
            // If product id already exist on po_product, UPDATE
            mysqli_query($db, "UPDATE stin_product SET stin_temp_qty = '$qtyIn[$limit]', stin_temp_cost = '$itemPrice[$limit]', stin_temp_tot= '$itemTotal[$limit]' WHERE stin_id = '$stinId' AND product_id ='$productId[$limit]'");
        } else {
            // If product id dont exist on po_product, INSERT
            mysqli_query($db, "INSERT INTO stin_product(product_id, stin_id, stin_temp_qty, stin_temp_cost, stin_temp_tot) 
      VALUES ('$productId[$limit]','$stinId','$qtyIn[$limit]','$itemPrice[$limit]','$itemTotal[$limit]')");
        }
        $limit++;
    }

    // editpo&id=2&supId=107&supName=A.F.%20SA

    header("location: ../stin_edit-page.php?editStin&id=$stinId&update=success");
}

// If po_edit-page.php update button is set
if (isset($_POST['cancelupdate'])) {
    header('location: ../stin_main.php');
}


if (isset($_GET['update'])) {
    echo '<script>alert("Update records successfully !")</script>';
}
