<?php 
    include 'config.php';

    $orderId = $_POST['orderId'];

    mysqli_query($db, "UPDATE order_tb SET order_status_id = '4' WHERE order_id = '$orderId'");
?>