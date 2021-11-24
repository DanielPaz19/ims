<?php
session_start();
include_once "php/config.php";

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
$pinv_id = $_GET['newPinvId'];
$productId = $_GET['prodId'];
$qty = $_GET['pinvQty'];
$pinvDate = $_GET['pinv_date'];
$pinvTitle = $_GET['pinv_title'];
$pinvLocation = $_GET['pinv_location'];
$empID = $_GET['emp_id'];



if (isset($_GET['btnsave']) && $productId[0] != "") { //Will not proceed if Products are Empty


    foreach ($productId as $x) {
        echo "product id :" . $x . "<br>";
    }

    echo "pinv id:" . $pinv_id . "<br>" . "<br>";




    $sql = "INSERT INTO pinv_tb (pinv_id, pinv_title, pinv_location, emp_id, pinv_date, user_id)
            VALUES ('$pinv_id','$pinvTitle','$pinvLocation','$empID','$pinvDate','" . $_SESSION['id'] . "')";

    if (mysqli_query($db, $sql)) {
        echo "<script>alert('New Record Added')</script>";
        echo header("location:pinv_main2.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>";
    }



    $limit = 0;
    while (sizeof($productId) !== $limit) {

        $sql = "INSERT INTO pinv_product (product_id, pinv_id, pinv_qty)

            VALUES (" . $productId[$limit] . "," . $pinv_id . "," . $qty[$limit] . ")";


        if (mysqli_query($db, $sql)) {
            echo "New record created successfully " . "<br>" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
        }

        $limit++;
    }
}


//  else {

//     $url = "pos-main.html?";

//     foreach ($productId as $urlId) {
//         $url .= "product_id[]=" . $urlId . "&";
//     }
//     echo $url;
//     // header("location: " .$url); //Go back to main page
// }
