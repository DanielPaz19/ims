<?php
include "../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE FROM po_tb WHERE po_id=" . $_GET['id']);
    $result = mysqli_query($db, "DELETE FROM po_product WHERE po_id=" . $_GET['id']);
    if ($result == true)
        echo "success";
    header("Location:../po_main.php");
}

?>