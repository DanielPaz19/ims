<?php

include '../../../php/config.php';

$product_id = $_GET['id'];
$product_qty = $_GET['qty'];
$item_location = $_GET['location'];
$sql = "SELECT * FROM product WHERE product_id = '$product_id' LIMIT 1";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {



        echo "<tr>
    <td><input id='product" . $row['product_id'] . "' name='product-id[]'  value='" . $row['product_id'] . "'></td>
    <td>" . $row['product_name'] . "</td>
    <td><input name='qty_order[]' style='border:none;' value='" . $product_qty . "' readonly></td>
    <td><input name='location[]' style='border:none;' style='border:none;' value='" . $item_location . "' readonly></td>
    <td style='text-align:center;'><span><a href='#' class='delete' id='" . $row['product_id'] . " title='remove' ><font color='red'><i class='fa fa-trash-o' style='font-size:20px'></i></font></a></span></td>
    </tr>";
    }
} else {

    echo '0 results';
}

?>
<input type='button' value='X'>
<button></button>