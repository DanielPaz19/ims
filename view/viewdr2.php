<?php
session_start();
include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT order_tb.order_id, customers.customers_name, order_tb.pos_date, jo_tb.jo_no, jo_tb.jo_date, user.user_name,order_tb.dr_number,reason_tb.reason_name,reason_tb.reason_id,user.user_id,jo_tb.jo_id,customers.customers_address,user.user_name
    FROM order_tb
    LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
    LEFT JOIN jo_tb ON jo_tb.jo_id = order_tb.jo_id
    LEFT JOIN reason_tb ON reason_tb.reason_id = order_tb.reason_id
    LEFT JOIN user ON user.user_id = order_tb.user_id
    WHERE order_tb.order_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['order_id'];
        $customerName = $row['customers_name'];
        $customerAdd = $row['customers_address'];
        $joNo = $row['jo_no']; 
        $joId = $row['jo_id'];
        $dateString = $row['pos_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'F d, Y');
        $dateString2 = $row['jo_date'];
        $dateTimeObj2 = date_create($dateString2);
        $date2 = date_format($dateTimeObj2, 'F d, Y');
        $drNo = $row['dr_number'];
        $reasonId = $row['reason_id'];
        $reasonName = $row['reason_name'];
        $user_name = $row['user_name'];
    } else {
        echo "No results!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View DR</title>
    <link rel="stylesheet" href="../css/dr_print.css">
</head>
<body>
    <div class="base">
        <!-- <button  style="position: absolute;left:26cm">Print</button> -->
        <div class="dr_paper">
        <p style="position: absolute;left:17cm;top:4cm;margin:0;"> <?php echo $drNo?></p>
        
                <p style="position: absolute;left:2.7cm;top:5cm;margin:0;"> <?php echo $customerName?></p>
                <p style="position: absolute;left:2cm;top:5.7cm;margin:0;"> <?php echo $customerAdd?></p>
                <p style="position: absolute;left:2cm;top:1.2cm;margin:0;">  </p>
                <p style="position: absolute;left:17cm;top:5cm;margin:0;"> <?php echo $date?></p>
                <div class="dr_table">
                <!-- <table>
                    <tr>
                        <td style="width: 135mm; height:9mm"></td>
                        <td rowspan="2" style="width: 63mm; "></td>
                     </tr>
                     <tr>
                        <td style="width: 135mm;height:9mm"></td>
                     </tr>
                 </table> -->
                 <table class="items" style="position: absolute;">
                     <tr>
                         <td style="width: 1.9cm;height:0.6cm"></td>
                         <td style="width: 1.9cm;height:0.6cm"></td>
                         <td style="width: 15.9cm;height:0.6cm"></td>

                     </tr>
                 <?php
                $sql = "SELECT product.product_id, product.product_name, order_product.pos_temp_qty, unit_tb.unit_name, order_product.pos_temp_price, product.qty
                FROM order_product
                LEFT JOIN product ON product.product_id = order_product.product_id
                LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
            
                WHERE order_product.order_id='$id'  ";

                $result = $db->query($sql);
                $count = 0;

                if ($result->num_rows >  0) {
 
                    while ($irow = $result->fetch_assoc()) {
                        $count = $count + 1;
                        $total[] = $irow["pos_temp_qty"] * $irow["pos_temp_price"];

                ?>
                        <tr>
                            <td><?php echo $irow['pos_temp_qty'] ?></td>
                            <td><?php echo $irow['unit_name'] ?></td>
                            <td style="font-size: 12.5px;"><?php echo $irow['product_name'] ?></td>
                            <td >&#8369;<?php echo $irow['pos_temp_price'] ?>/<?php echo $irow['unit_name'] ?></td>
                            <td>&emsp;</td>
                            <!-- <td>&#8369;<?php echo number_format($irow['ep_totPrice'], 2)  ?></td> -->
                        </tr>
                <?php }
                } ?>
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
                    <tr style="text-align: center;">
                    <td></td>
                    <td style="font-size: small; padding-top:-5px" colspan="2">****** NOTHING FOLLOWS *****</td>
                    <td></td>
                    <td style="text-decoration: overline;"> 
                        &#8369;<?php echo number_format($grandTot, 2) ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <!-- <td style="font-size: small;" colspan="4"><p><?php echo $ep_remarks?></p></td> -->
                </tr>
                 </table>
                 <p style="position: absolute;top:13.3cm;left:2.5cm">/<?php echo $user_name?></p>
                 <p style="position: absolute;top:14.5cm;left:2.5cm">JO<?php echo $joNo?></p>


            </div>
        </div>
    </div>
</body>
</html>