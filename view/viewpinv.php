<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT pinv_tb.pinv_id, pinv_tb.pinv_title, pinv_tb.pinv_location, employee_tb.emp_name, pinv_tb.pinv_date
                                 FROM pinv_tb
                                 LEFT JOIN employee_tb ON employee_tb.emp_id = pinv_tb.emp_id
                                 WHERE pinv_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['pinv_id'];
        $pinv_title = $row['pinv_title'];
        $pinv_location = $row['pinv_location'];
        $emp_name = $row['emp_name'];
        $dateString = $row['pinv_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
    } else {
        echo "No results!";
    }
}
?>
<html>
<title><?php echo $pinv_title; ?></title>

<head>
    <link rel="stylesheet" href="../css/viewpinv.css" type="text/css" media="print">
    <link rel="stylesheet" href="../css/viewpinv.css" type="text/css">
</head>
<script>
    function printDiv() {
        var divContents = document.getElementById("print-area").innerHTML;
        var a = window.open('', '', 'height=1000, width=1300');
        a.document.write(divContents);
        a.document.close();
        a.print();
    }
</script>

<body>
    <button class="noprint" onclick="window.print()">PRINT DOCUMENT</button>
    <div class="print-area">
        <page id="print" size="A4">
            <div class="top">
                <table style="width: 100%; ">
                    <tr>
                        <td><label>PINV Title:</label>&nbsp;&nbsp;&nbsp;<?php echo $pinv_title ?></td>

                        <td style="text-align: right;"><label>PINV Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date ?></td>
                    </tr>
                    <tr>
                        <td><label>Location:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> <?php echo $pinv_location ?></td>
                        <td style="text-align: right;"><label>Personel: </label>&nbsp;&nbsp;&nbsp;<?php echo $emp_name ?></td>
                    </tr>
                </table>
            </div>
            <br> <br>
            <div class="itemtb">
                <table width="100%">
                    <tr style="text-align: left;">
                        <th width="10%">Product ID</th>
                        <th width="30%">Item Description</th>
                        <th width="10%">Sys. Count</th>
                        <th width="10%">P. Count</th>
                        <th width="5%">Unit</th>

                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT pinv_product.pinv_id, pinv_product.product_id, pinv_product.pinv_qty, product.product_name, unit_tb.unit_name, product.qty
                                FROM pinv_product
                                LEFT JOIN product ON product.product_id = pinv_product.product_id
                                LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                                LEFT JOIN pinv_tb ON pinv_tb.pinv_id = pinv_product.pinv_id
                                WHERE pinv_tb.pinv_id = '$id'";

                        $result = $db->query($sql);
                        $count = 0;

                        if ($result->num_rows >  0) {

                            while ($irow = $result->fetch_assoc()) {
                                $count = $count + 1;
                                $prodId = str_pad($irow['product_id'], 8, 0, STR_PAD_LEFT);
                        ?>
                                <td><?php echo $prodId ?></td>
                                <td><?php echo $irow['product_name'] ?></td>
                                <td><?php echo number_format($irow['qty'], 2)  ?></td>
                                <td>
                                    <font color="red"><?php echo number_format($irow['pinv_qty'], 2) ?></font>
                                </td>
                                <td><?php echo $irow['unit_name'] ?></td>


                    </tr>
            <?php }
                        } ?>
                </table>

            </div>
        </page>
    </div>
</body>


</html>