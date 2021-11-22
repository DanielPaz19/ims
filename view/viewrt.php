<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT rt_tb.rt_id, rt_tb.rt_no, rt_tb.rt_date, customers.customers_name, rt_tb.rt_reason, rt_tb.rt_note, rt_tb.rt_driver, rt_tb.rt_guard
                                FROM rt_tb
                                LEFT JOIN customers ON customers.customers_id = rt_tb.customers_id
                                  WHERE rt_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['rt_id'];
        $rt_no = $row['rt_no'];
        $customer = $row['customers_name'];
        $rt_note = $row['rt_note'];
        $rt_reason = $row['rt_reason'];
        $rt_driver = $row['rt_driver'];
        $rt_guard = $row['rt_guard'];
        $dateString = $row['rt_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
    } else {
        echo "No results!";
    }
}
?>
<html>
<title>RT #<?php echo $rt_no; ?></title>

<head>
    <link rel="stylesheet" href="../css/viewrt.css" type="text/css" media="print">
    <link rel="stylesheet" href="../css/viewrt.css" type="text/css">
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
<button class="noprint" onclick="window.print()">PRINT DOCUMENT</button>

<body>

    <div class="print-area">
        <page id="print" size="A4">
            <center>
                <div class="heading">
                    <p> PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</p>
                    <p class="title">RETURN SLIP</p>
                    <hr style="width: 70%">
                </div>
            </center>
            <div class="head2">
                <table style="width: 100%;">
                    <tr>
                        <td> <label>RT # :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rt_no; ?></td>
                        <td style="text-align: right;"> <label>DATE :</label>&nbsp;&nbsp;&nbsp;<?php echo $date ?></td>
                    </tr>
                    <tr>
                        <td><label> COMPANY :</label>&nbsp;&nbsp;&nbsp;<?php echo $customer ?></td>
                    </tr>
                </table>
            </div>

            <br>
            <div class="itemTB">
                <table style="width: 100%;">

                    <?php
                    $sql = "SELECT product.product_name, rt_product.rt_qty, unit_tb.unit_name
                                  FROM product
                                  LEFT JOIN rt_product
                                  ON product.product_id = rt_product.product_id
                                  LEFT JOIN unit_tb
                                  ON product.unit_id = unit_tb.unit_id
                                  WHERE rt_product.rt_id = '$id' ";

                    $result = $db->query($sql);
                    $count = 0;
                    if ($result->num_rows >  0) {
                        while ($irow = $result->fetch_assoc()) {
                            $count = $count + 1;

                    ?>
                            <tr>
                                <td><?php echo $irow['rt_qty']; ?><?php echo $irow['unit_name']; ?></td>
                                <td><?php echo $irow['product_name']; ?></td>
                            </tr>
                    <?php }
                    } ?>
                </table>
            </div>


            <div class="others">
                <table style="width: 100%;">
                    <tr>
                        <td><label>Reason: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rt_reason ?></td>
                    </tr>
                    <tr>
                        <td><label>Note: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rt_note ?></td>
                    </tr>
                </table>
            </div>

            <div class="bottom">
                <table>
                    <tr style="text-align:center;">
                        <td><?php echo $rt_driver ?></td>
                    </tr>
                    <tr>
                        <td>___________________________</td>
                    </tr>

                    <tr style="text-align:center;">
                        <td>
                            <label> DRIVER/TRUCK</label>
                        </td>
                    </tr>
                </table>
            </div>


            <div class="bottom2">
                <table>
                    <tr style="text-align:center;">
                        <td><?php echo $rt_guard ?></td>
                    </tr>
                    <tr>
                        <td>___________________________</td>
                    </tr>

                    <tr style="text-align:center;">
                        <td>
                            <label> GUARD ON DUTY</label>
                        </td>
                    </tr>
                </table>
            </div>
        </page>
    </div>
</body>


</html>