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
$olId = $_GET['ol_id'];
$productId = $_GET['product-id'];
$qty = $_GET['qty_order'];
$price = $_GET['price'];
$fee = $_GET['fee'];
$total = $_GET['total'];
$olTitle = $_GET['ol_title'];
$olSi = $_GET['ol_si'];
$olDate = $_GET['ol_date'];
$olType = $_GET['ol_type_id'];
$olAdjustment = $_GET['ol_adjustment'];



if (isset($_GET['btnsave']) && $productId[0] != "") { //Will not proceed if Products are Empty

    echo "<br>";

    foreach ($productId as $x) {
        echo "product id :" . $x . "<br>";
    }

    echo "EP ID:" . $olId . "<br>" . "<br>";

    $limit = 0;
    while (sizeof($productId) !== $limit) {

        $sql = "INSERT INTO ol_product (product_id, ol_id, ol_qty, ol_price, ol_fee, ol_priceTot)

            VALUES (" . $productId[$limit] . "," . $olId . "," . $qty[$limit] . "," . removeComma($price[$limit]) . "," . removeComma($fee[$limit]) . "," . removeComma($total[$limit]) . ")";


        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limit++;
    }

    // $limiter = 0;
    // while (sizeof($productId) !== $limiter) {
    //     $sql = "UPDATE ep_product 

    //                  SET stout_temp_remarks ='" . $ep_remarks[$limiter]
    //         . "' WHERE product_id = " . $productId[$limiter] . " AND ep_id =" . $epID;





    //     if (mysqli_query($db, $sql)) {
    //         echo "New record created successfully " . "<br>" . "<br>";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
    //     }

    //     $limiter++;
    // }



    $sql = "INSERT INTO ol_tb (ol_id,ol_title,ol_si,ol_date, ol_type_id,ol_adjustment,user_id)
            VALUES ('$olId','$olTitle','$olSi','$olDate','$olType','$olAdjustment','" . $_SESSION['id'] . "')";

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
