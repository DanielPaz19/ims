<?php
include_once 'header.php';
// include_once 'php/pos-dr-print.php';
?>


<table>
    <tr>

        <th>Order ID</th>
        <th>Customer</th>
        <th>Date</th>
        <th>ACTION</th>
    </tr>


    <?php
    include "php/config.php";

    $sql = "SELECT order_tb.order_id, customers.customers_name, order_tb.pos_date
    FROM order_tb
    LEFT JOIN customers ON customers_id = order_tb.customer_id";

    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row

        while ($row = mysqli_fetch_assoc($result)) {
            $orderId = $row['order_id'];

    ?>

            <tr>
                <td><?php echo $row['order_id'] ?></td>
                <td><?php echo $row['customers_name'] ?></td>
                <td><?php echo $row['pos_date'] ?></td>
                <td><a style=" color: black;" href="php/pos-dr-print.php?printPOS&id=<?php echo $orderId ?>">PRINT</a></td>
            </tr>

    <?php }
    } ?>

</table>