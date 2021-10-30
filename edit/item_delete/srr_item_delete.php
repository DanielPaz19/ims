
<?php

include "../../php/config.php";


if (isset($_GET['srrProdId'])) {

    $result = mysqli_query($db, "DELETE FROM srr_product WHERE product_id=" . $_GET['srrProdId']);
    if ($result == true)
        mysqli_close($db); // Close connection

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}



?>