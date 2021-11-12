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
$joId = $_GET['jo_id'];
$productId = $_GET['product-id'];
$qty = $_GET['qty_order'];
$price = $_GET['price'];
$total = $_GET['total'];
$joNo = $_GET['jo_no'];
$customersId = $_GET['customers_id'];
$joDate = $_GET['jo_date'];
$emp_id = $_GET['emp_id'];


if (isset($_GET['btnsave']) && $productId[0] != "") { //Will not proceed if Products are Empty

    echo "<br>";

    foreach ($productId as $x) {
        echo "product id :" . $x . "<br>";
    }

    echo "stin id:" . $joId . "<br>" . "<br>";

    $limit = 0;
    while (sizeof($productId) !== $limit) {

        $sql = "INSERT INTO jo_product (product_id,jo_id, jo_product_qty,jo_product_price)
            VALUES (" . $productId[$limit] . "," . $joId . "," . $qty[$limit] . "," . removeComma($price[$limit]) . ")";

        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limit++;
    }

    $sql = "INSERT INTO jo_tb (jo_id, jo_no, customers_id ,emp_id ,jo_date, user_id)
            VALUES ('$joId','$joNo','$customersId','$emp_id','$joDate','" . $_SESSION['id'] . "')";

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