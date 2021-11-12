<?php

// IF Edit button Click from PO Main
if (isset($_GET['editJo'])) {

    $joId = $_GET['id'];

    require 'php/config.php';

    $result = mysqli_query(
        $db,
        "SELECT jo_tb.jo_id, jo_tb.jo_no, jo_tb.jo_date, customers.customers_name, customers.customers_id, jo_product.product_id, jo_product.jo_product_qty, jo_product.jo_product_price, product.product_name, unit_tb.unit_name, unit_tb.unit_id, employee_tb.emp_name, employee_tb.emp_id
        FROM jo_tb
        LEFT JOIN jo_product ON jo_product.jo_id = jo_tb.jo_id
        LEFT JOIN customers ON customers.customers_id = jo_tb.customers_id
        LEFT JOIN product ON jo_product.product_id = product.product_id
        LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
        LEFT JOIN employee_tb ON employee_tb.emp_id = jo_tb.emp_id
        WHERE jo_tb.jo_id ='$joId'"

    );

    // PO Details
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $customerName = $row['customers_name'];
            $customerId = $row['customers_id'];
            $joNo = $row['jo_no'];
            $empName = $row['emp_name'];
            $empId = $row['emp_id'];
            $joDate = $row['jo_date'];
            $productId[] = str_pad($row['product_id'], 8, 0, STR_PAD_LEFT);
            $productName[] = $row['product_name'];
            $qtyIn[] = $row['jo_product_qty'];
            $unitId[] = $row['unit_id'];
            $unitName[] = $row['unit_name'];
            $itemPrice[] = $row['jo_product_price'];
        }
    } else {
        echo "0 results";
    }
}

// If po_edit-page.php update button is set
if (isset($_POST['updateep'])) {
    $epId = $_POST['epId'];
    $customerId = $_POST['customerId'];
    $epTitle = $_POST['epTitle'];
    $epNo = $_POST['epNo'];
    $epRemarks = $_POST['epRemarks'];
    $epDate = $_POST['epDate'];

    $productId = $_POST['productId'];
    $qtyIn = $_POST['qtyIn'];
    $itemPrice = $_POST['itemPrice'];
    $itemTotal = $_POST['itemTotal'];

    require '../php/config.php';

    // Update po_tb
    mysqli_query(
        $db,
        "UPDATE jo_tb SET ep_no='$epNo', ep_title='$epTitle',customers_id='$customerId',  ep_date='$epDate', ep_remarks='$epRemarks' WHERE ep_id='$epId' "
    );


    // Update po_product
    $limit = 0;
    while (count($productId) !== $limit) {
        // Check product id from po_product
        $checkResult = mysqli_query($db, "SELECT product_id FROM ep_product WHERE ep_id = $epId AND product_id ='" . $productId[$limit] . "'");

        if (mysqli_num_rows($checkResult) > 0) {
            // If product id already exist on po_product, UPDATE
            mysqli_query($db, "UPDATE ep_product SET ep_qty = '$qtyIn[$limit]', ep_price = '$itemPrice[$limit]', ep_totPrice= '$itemTotal[$limit]' WHERE ep_id = '$epId' AND product_id ='$productId[$limit]'");
        } else {
            // If product id dont exist on po_product, INSERT
            mysqli_query($db, "INSERT INTO ep_product(product_id, ep_id, ep_qty, ep_price, ep_totPrice) 
      VALUES ('$productId[$limit]','$epId','$qtyIn[$limit]','$itemPrice[$limit]','$itemTotal[$limit]')");
        }
        $limit++;
    }

    // editpo&id=2&supId=107&supName=A.F.%20SA

    header("location: ../ep_edit-page.php?editEp&id=$epId&update=success");
}

// If po_edit-page.php update button is set
if (isset($_POST['cancelupdate'])) {
    header('location: ../ep_main.php');
}


if (isset($_GET['update'])) {
    echo '<script>alert("Update records successfully !")</script>';
}
