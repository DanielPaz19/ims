<?php

// IF Edit button Click from PO Main
if (isset($_GET['printPOS'])) {

    $id = $_GET['id'];

    require 'config.php';

    $result = mysqli_query(
        $db,
        "SELECT order_tb.order_id, customers.customers_name, order_tb.pos_date, customers.customers_address
        FROM order_tb
        LEFT JOIN customers ON customers_id = order_tb.customer_id 
        WHERE order_tb.order_id = '$id'"
    );
    $row = mysqli_fetch_array($result);
    if ($result) {
        $id = $row['order_id'];
        $pos_date = $row['pos_date'];
        $customers_name = $row['customers_name'];
        $customers_address = $row['customers_address'];
    }
}

?>

<html>
<style>
    body {
        font-family: 'Courier New', Courier, monospace;
    }


    img {
        width: 8in;
        height: 10in;
        position: relative;
    }

    .container {
        position: relative;
        text-align: center;
        color: black;
        border: 1px solid black;
        width: 43%;


    }

    .bottom-left {
        position: absolute;
        bottom: 8px;
        left: 16px;
    }

    .ep--customer {
        /* border: 1px solid black; */

        position: absolute;
        top: 15px;
        /* left: 16px; */

    }

    .ep--customer--address {
        position: absolute;
        top: 7px;
        /* left: 16px; */
    }

    /* .ep--no {
        position: absolute;
        top: 12px;
        right: 16px;
    } */


    .ep--date {
        position: absolute;
        top: -10px;
        right: 16px;
    }

    .bottom-right {
        position: absolute;
        bottom: 8px;
        right: 16px;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    p {
        font-size: 20px;
        line-height: 2em;
    }

    .ep--itemlist {
        position: absolute;
        top: 8px;
        left: 16px;
    }

    .ep_tb th,
    td {
        padding: 5px;
        /* border: 1px solid black; */
    }

    .ep_tb {
        margin-left: 10px;
        border-collapse: collapse;

    }



    @media print {
        body {
            font-family: 'Courier New', Courier, monospace;
        }

        .noprint {
            visibility: hidden;
        }
    }

    textarea {
        border: none;
        background-color: transparent;
        resize: none;
        outline: none;
        font-size: 12px;
    }


    input[type=button] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        font-weight: bolder;
    }
</style>

<head>
    <script language="javascript">
        function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>



</head>

<body>



    <div class="container" id="div_print">
        <img src="../../img/drTemplate.jpg">
        <!-- class="noprint" -->
        <!-- <div class="ep--no"><br><br><br> <br>
            <p style=" margin-right:15px"><?php echo $ep_no; ?></p>

        </div> -->

        <div class="ep--date"><br><br><br> <br><br><br><br><br> <br>
            <p style=" margin-right:3px;font-weight:bold"><?php echo $pos_date; ?></p>
        </div>


        <div class="ep--customer"><br><br><br><br><br><br><br><br>
            <p style=" margin-left:80px;font-size:15px;font-weight:bold"><?php echo $customers_name; ?></p>

        </div>

        <div class="ep--customer--address"><br><br><br><br><br><br><br> <br> <br><br>
            <p style=" margin-left:55px;font-size:12px;font-weight:bold"><?php echo $customers_address; ?></p><br>

        </div>

        <div class="ep--itemlist"><br><br><br><br><br><br><br><br><br><br><br> <br> <br>
            <table class="ep_tb" width="100%">
                <tr>
                    <th>&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;</th>
                </tr>
                <?php
                $sql = "SELECT product.product_id, product.product_name, order_product.pos_temp_qty, unit_tb.unit_name, order_product.pos_temp_price
                    FROM order_product
                    LEFT JOIN product ON product.product_id = order_product.product_id
                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                    WHERE order_product.order_id='$id'
 ";

                $result = $db->query($sql);
                $count = 0;

                if ($result->num_rows >  0) {

                    while ($irow = $result->fetch_assoc()) {
                        $count = $count + 1;
                        $total[] = $irow["pos_temp_qty"] * $irow["pos_temp_price"];

                ?>
                        <tr>
                            <td style="width: 165px;"><?php echo $irow['pos_temp_qty'] ?>&nbsp;<?php echo $irow['unit_name'] ?></td>
                            <td style="width: 379px;"><?php echo $irow['product_name'] ?></td>
                            <td style="width: 60px; text-align:left">&#8369;<?php echo $irow['pos_temp_price'] ?>/<?php echo $irow['unit_name'] ?></td>
                            <td style="width: 60px; text-align:left">&#8369;<?php echo $irow["pos_temp_qty"] * $irow["pos_temp_price"] ?>.00</td>
                        </tr>
                <?php }
                } ?>

            </table>

            <table style="float: right;">
                <?php

                $limit = 0;
                $subTot = 0;
                $disTot = 0;

                while ($limit != count($total)) {
                    $subTot += $total[$limit];
                    // $disTot += $totaldisamount[$limit];
                    $limit += 1;
                }

                $grandTot = $subTot - $disTot;

                ?>

                <tr>
                    <td></td>
                    <td style="text-decoration: overline;">
                        &#8369;<?php echo $grandTot ?>.00
                    </td>
                </tr>
                <td>--------------<i>NOTHING FOLLOWS</i>--------------
                </td>
                <!-- <tr>
                    <td>&nbsp;<textarea cols="30" rows="10"><?php echo $ep_remarks; ?></textarea></td>
                </tr> -->
            </table>


        </div>


</body>
<input name="b_print" type="button" class="noprint" onClick="printdiv('div_print');" value=" Click Here to Print ! ">

</html>