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
$epID = $_GET['ep_id'];
$productId = $_GET['product-id'];
$qty = $_GET['qty_order'];
$price = $_GET['price'];
$total = $_GET['total'];
$epNo = $_GET['ep_no'];
$epTitle = $_GET['ep_title'];
$epDate = $_GET['ep_date'];



if (isset($_GET['btnsave']) && $productId[0] != "") { //Will not proceed if Products are Empty

    echo "<br>";

    foreach ($productId as $x) {
        echo "product id :" . $x . "<br>";
    }

    echo "stout id:" . $epID . "<br>" . "<br>";

    $limit = 0;
    while (sizeof($productId) !== $limit) {

        $sql = "INSERT INTO ep_product (product_id, ep_id, ep_qty, ep_price, ep_tot)

            VALUES (" . $productId[$limit] . "," . $epID . "," . $qty[$limit] . "," . removeComma($price[$limit]) . "," . removeComma($disamount[$limit]) . "," . removeComma($total[$limit]) . ")";


        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limit++;
    }

    $limiter = 0;
    while (sizeof($productId) !== $limiter) {
        $sql = "UPDATE stout_product 
                     SET stout_temp_remarks ='" . $stout_temp_remarks[$limiter]
            . "' WHERE product_id = " . $productId[$limiter] . " AND ep_id =" . $epID;





        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limiter++;
    }



    $sql = "INSERT INTO ep_tb (ep_id,ep_no, ep_title ,ep_date ,user_id)
            VALUES ('$epID','$epNo','$epTitle','$epDate','" . $_SESSION['id'] . "')";

    if (mysqli_query($db, $sql)) {
        // echo "<script>alert('New Record Added')</script>";
        // echo "<script>window.close();</script>";
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
