
<?php

include "../../php/config.php";


if (isset($_GET['stoutProdId'])) {

    $result = mysqli_query($db, "DELETE FROM stout_product WHERE product_id=" . $_GET['stoutProdId']);
    if ($result == true)
        mysqli_close($db); // Close connection

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}



?>