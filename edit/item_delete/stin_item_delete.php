<?php
include "../../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['stinProdId'])) {

    $result = mysqli_query($db, "DELETE FROM stin_product WHERE stin_product_id=" . $_GET['stinProdId']);
    if ($result == true)
        mysqli_close($db); // Close connection

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>