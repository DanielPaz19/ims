<?php
require 'php/config.php';
if (isset($_POST['filter'])) {

    $loc_id = $_POST['loc_id'];
    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode
                    FROM product
                    LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                    WHERE product.loc_id = '$loc_id'");
    while ($fetch = mysqli_fetch_array($query)) {
        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);

        echo "<tr><td style='display:none'><input type='hidden' name='pinv_id' style='border:none;' readonly> </td>
        <td><input type='text' name='prodId[]' value='$prodId' style='border:none;' readonly> </td>
                  <td>" . $fetch['product_name'] . "</td>
                  <td>"  . $fetch['qty'] . "</td>
                  <td>" . $fetch['unit_name'] . " </td>
                  <td>"  . $fetch['loc_name'] . "</td>
                  <td>" . $fetch['barcode'] . "</td>
                  <td>"  . "<input type='number' name='pinvQty[]' style='width:100%' >" . "</td></tr>";
    }
} else if (isset($_POST['reset'])) {
    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode
                        FROM product
                        LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id LIMIT 40");
    while ($fetch = mysqli_fetch_array($query)) {
        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);
        echo "<tr><td>" . $prodId . "</td><td>" . $fetch['product_name'] . "</td><td>"  . $fetch['qty'] . "</td><td>" . $fetch['unit_name'] . " </td><td>"  . $fetch['loc_name'] . "</td><td>" . $fetch['barcode'] . "</td><td>"  . "<input type='number' name='user_count'  style='width:100%'>" . "</td></tr>";
    }
} else {
    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode
                    FROM product
                    LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id LIMIT 40");
    while ($fetch = mysqli_fetch_array($query)) {
        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);
        echo "<tr><td>" . $prodId . "</td><td>" . $fetch['product_name'] . "</td><td>"  . $fetch['qty'] . "</td><td>" . $fetch['unit_name'] . " </td><td>"  . $fetch['loc_name'] . "</td><td>" . $fetch['barcode'] . "</td><td>"  . "<input type='number' name='user_count'  style='width:100%'>" . "</td></tr>";
    }
}
