<?php
session_start();
include_once "../../../php/config.php";

//function for removing comma
function removeComma($str)
{
    $comma = "/,/i";
    if (preg_match($comma, $str)) {
        return str_replace(',', '', $str);
    } else {
        return $str;
    }
}
$rtID = $_GET['rt_id'];
$productId = $_GET['product-id'];
$qty = $_GET['qty_order'];
$rtNo = $_GET['rt_no'];
$rtDate = $_GET['rt_date'];
$rtReason = $_GET['rt_reason'];
$custId = $_GET['customers_id'];
$rtNote = $_GET['rt_note'];
$rtDriver = $_GET['rt_driver'];
$rtGuard = $_GET['rt_guard'];


if (isset($_GET['btnsave']) && $productId[0] != "") { //Will not proceed if Products are Empty

    echo "<br>";

    foreach ($productId as $x) {
        echo "product id :" . $x . "<br>";
    }

    echo "Rt id:" . $rtID . "<br>" . "<br>";

    $limit = 0;
    while (sizeof($productId) !== $limit) {

        $sql = "INSERT INTO rt_product (product_id, rt_id, rt_qty)

            VALUES (" . $productId[$limit] . "," . $rtID . "," . $qty[$limit] . ")";


        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limit++;
    }

    // $limiter = 0;
    // while (sizeof($productId) !== $limiter) {
    //     $sql = "UPDATE stout_product 
    //                  SET stout_temp_remarks ='" . $stout_temp_remarks[$limiter]
    //         . "' WHERE product_id = " . $productId[$limiter] . " AND stout_id =" . $stoutID;





    //     if (mysqli_query($db, $sql)) {
    //         echo "New record created successfully " . "<br>" . "<br>";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
    //     }

    //     $limiter++;
    // }


    $sql = "INSERT INTO rt_tb (rt_id,rt_no, rt_date ,rt_reason , rt_note, customers_id, rt_driver, rt_guard, user_id)
            VALUES ('$rtID','$rtNo','$rtDate','$rtReason','$rtNote','$custId','$rtDriver','$rtGuard','" . $_SESSION['id'] . "')";

    if (mysqli_query($db, $sql)) {
        echo "<script>alert('New Record Added')</script>";
        echo "<script>window.close();</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>";
    }
} else {

    $url = "pos-main.html?";

    foreach ($productId as $urlId) {
        $url .= "product_id[]=" . $urlId . "&";
    }
    echo $url;
    // header("location: " .$url); //Go back to main page
}
