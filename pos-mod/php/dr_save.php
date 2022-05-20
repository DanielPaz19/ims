<?php


if (isset($_POST['save'])) {

    session_start();
    $user_id = $_SESSION['id'];

    include "./database.php";

    $dr_number = $_POST['dr_number'];
    $jo_id = $_GET['jo_id'];
    $product_qty = $_POST['qty'];
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];


    // Check DR Number
    $dr = new Database();
    $drColumn = "dr_number";
    $drTable = "delivery_receipt";
    $drFilter = "dr_number = $dr_number";
    $drResult = $dr->select($drColumn, $drTable, $drFilter);
    $joArr =  http_build_query(array('jo_id' => $jo_id));

    // if dr number is used, go back to page
    if (mysqli_num_rows($drResult) > 0) {
        header('Location: ../pos-dr-products.php?next&error=duplicate-dr&' . $joArr);
        exit;
    }

    // If total product qty = 0;
    $totalQty = 0;
    foreach ($product_qty as $qty) {
        $totalQty += $qty;
    }
    if ($totalQty == 0) {
        header('Location: ../pos-dr-products.php?next&error=zero-qty&' . $joArr);
        exit;
    }

    // Save dr Number
    $dr->insert("delivery_receipt", 'dr_number,user_id', "$dr_number,$user_id");

    // Insert into order_tb
    foreach ($jo_id as $id) {
        $dr->insert("order_tb", "jo_id,dr_number", "$id,$dr_number");
    }

    // Insert into order_product
    $limit = 0;
    while (count($product_id) != $limit) {
        if ($product_id[$limit] == 0 || $product_qty[$limit] == 0) {
            $limit++;
            continue;
        }

        $dr->insert(
            "order_product",
            "product_id,dr_number,pos_temp_qty,pos_temp_price",
            "$product_id[$limit],$dr_number,$product_qty[$limit],$product_price[$limit]"
        );
        $limit++;
    }


    // Get product id, jo id, product_price, qty


    // UPDATE dr number from order_tb with jo_numbers

    header('Location: ../pos-dr.php?dr=saved');
}
