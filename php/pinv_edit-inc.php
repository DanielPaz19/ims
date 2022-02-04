<?php

// IF Edit button Click from STOUT Main
if (isset($_GET['edit'])) {

    $pinvId = $_GET['id'];

    require 'php/config.php';

    $result = mysqli_query(
        $db,
        "SELECT pinv_tb.pinv_id, pinv_tb.pinv_title, pinv_tb.pinv_date, employee_tb.emp_name,employee_tb.emp_id, pinv_product.pinv_qty, loc_tb.loc_id,loc_tb.loc_name, product.product_id, product.product_name, unit_tb.unit_name
        FROM pinv_tb
        LEFT JOIN employee_tb ON employee_tb.emp_id = pinv_tb.emp_id
        LEFT JOIN pinv_product ON pinv_product.pinv_id = pinv_tb.pinv_id
        LEFT JOIN loc_tb ON loc_tb.loc_id = pinv_product.loc_id
        LEFT JOIN product ON product.product_id = pinv_product.product_id
        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
        WHERE pinv_tb.pinv_id = '$pinvId';

"
    );


    // STOUT Details
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $pinvId = $row['pinv_id'];
            $pinvTitle = $row['pinv_title'];
            $pinvDate = $row['pinv_date'];
            $empId = $row['emp_id'];
            $empName = $row['emp_name'];

            $productId[] = $row['product_id'];
            $productName[] = $row['product_name'];
            $unit[] = $row['unit_name'];
            $qtyIn[] = $row['pinv_qty'];
            $locationName[] = $row['loc_name'];
            $locId[] = $row['loc_id'];
        }
    } else {
        echo "0 results";
    }
}

// If stout_edit-page.php update button is set
if (isset($_POST['update'])) {

    $pinvId = number_format($_POST['pinvId']);
    $employeeId = $_POST['employeeId'];
    $pinvTitle = $_POST['pinvTitle'];
    $pinvDate = $_POST['pinvDate'];



    $productId = $_POST['productId'];
    $qtyIn = $_POST['qtyIn'];
    $locId = $_POST['locId'];


    require '../php/config.php';

    // Update stout_tb
    if (!mysqli_query(
        $db,
        "UPDATE pinv_tb SET emp_id ='$employeeId', pinv_title = '$pinvTitle', pinv_date = '$pinvDate' 
    WHERE pinv_id = '$pinvId'"
    )) {
        printf("Error message: %s\n", mysqli_error($link));
    };


    // Update stout_tb
    $limit = 0;
    while (count($productId) !== $limit) {
        // Check product id from stout_product
        $checkResult = mysqli_query($db, "SELECT product_id FROM pinv_product WHERE pinv_id = $pinvId AND product_id ='" . $productId[$limit] . "'");

        if (mysqli_num_rows($checkResult) > 0) {
            // If product id already exist on stout_product, UPDATE
            $sql = "UPDATE pinv_product SET pinv_qty = '$qtyIn[$limit]', loc_id='$locId[$limit]'  WHERE pinv_id = '$pinvId' AND product_id ='$productId[$limit]'";
        } else {
            // If product id dont exist on stout_product, INSERT
            if ($productId[$limit] != 0) {
                $sql = "INSERT INTO pinv_product(product_id, pinv_id, pinv_qty,loc_id) 
                VALUES ('$productId[$limit]','$pinvId','$qtyIn[$limit]','$locId[$limit]')";
            }
        }

        mysqli_query($db, $sql);

        $limit++;
    }


    header("location: ../pinv_edit-page.php?edit&updated&id=$pinvId");
}

// If po_edit-page.php update button is set
if (isset($_POST['cancelupdate'])) {
    header('location: ../pinv_main2.php');
}


// If stout_edit-page.php delete button is set
if (isset($_POST['delete'])) {
    $pinvId = $_POST['pinvId'];
    $productId = $_POST['productId'];

    require '../php/config.php';

    mysqli_query($db, "DELETE FROM pinv_product WHERE pinv_id = '$pinvId' AND product_id = '$productId'");

    echo "pinvId" . $pinvId . "productId" . $productId;
}

if (isset($_GET['updated'])) {
    echo
    '<script>
  alert("Successfully updated!");
  location.href = "pinv_edit-page.php?edit&id=' . $_GET['id'] . '";
  </script>';
}
