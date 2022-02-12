<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT ep_tb.ep_id, ep_tb.ep_no, ep_tb.ep_title, ep_tb.ep_remarks, ep_tb.ep_date, customers.customers_name, user.user_name
                                 FROM ep_tb
                                 LEFT JOIN user ON user.user_id = ep_tb.user_id
                                 LEFT JOIN customers ON ep_tb.customers_id = customers.customers_id
                                WHERE ep_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['ep_id'];
        $ep_no = $row['ep_no'];
        $ep_title = $row['ep_title'];
        $ep_remarks = $row['ep_remarks'];
        $customers_name = $row['customers_name'];
        $user_name = $row['user_name'];
        $dateString = $row['ep_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'F d, Y');
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
    <title>ExitPass</title>
    <link rel="stylesheet" href="../css/ep_print.css">
</head>
<body>
    <div class="base">
        <!-- <button  style="position: absolute;left:26cm">Print</button> -->
        <div class="ep_paper">
        <p style="position: absolute;left:19cm;top:3.6cm;margin:0;"> <?php echo $ep_no?></p>
            <div class="ep_table">
                <p style="position: absolute;left:3cm;top:0.4cm;margin:0;"> <?php echo $customers_name?></p>
                <p style="position: absolute;left:2cm;top:1.2cm;margin:0;">  </p>
                <p style="position: absolute;left:15cm;top:1.2cm;margin:0;"> <?php echo $date?></p>
                
                <table>
                    <tr>
                        <td style="width: 135mm; height:9mm"></td>
                        <td rowspan="2" style="width: 63mm; "></td>
                     </tr>
                     <tr>
                        <td style="width: 135mm;height:9mm"></td>
                     </tr>
                 </table>
                 <table style="position: absolute;">
                     <tr>
                         <td style="width: 4.5cm;height:9mm"></td>
                         <td style="width: 15.2cm;height:9mm"></td>
                     </tr>
                 <?php
                $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.price, ep_product.ep_qty, ep_product.ep_price, ep_product.ep_totPrice, ep_tb.ep_remarks, ep_tb.ep_no
                FROM ep_tb
                LEFT JOIN ep_product ON ep_product.ep_id = ep_tb.ep_id
                LEFT JOIN product ON product.product_id = ep_product.product_id
                LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
            
                WHERE ep_tb.ep_no='$ep_no'  ";

                $result = $db->query($sql);
                $count = 0;

                if ($result->num_rows >  0) {
 
                    while ($irow = $result->fetch_assoc()) {
                        $count = $count + 1;
                        $total[] = $irow["ep_qty"] * $irow["ep_price"];

                ?>
                        <tr>
                            <td style="height:.6cm">&emsp;&emsp;<?php echo $irow['ep_qty'] ?>&nbsp;<?php echo $irow['unit_name'] ?></td>
                            <td style="font-size: 12.5px;"><?php echo $irow['product_name'] ?></td>
                            <td >&#8369;<?php echo $irow['ep_price'] ?>/<?php echo $irow['unit_name'] ?></td>
                            <td>&emsp;</td>
                            <td>&#8369;<?php echo number_format($irow['ep_totPrice'], 2)  ?></td>
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
                    <td style="font-size: small;" colspan="4"><p><?php echo $ep_remarks?></p></td>
                </tr>
                 </table>
                 <p style="position: absolute;top:9.6cm;left:4cm">/<?php echo $user_name?></p>
                 <p style="position: absolute;top:10.7cm;left:2cm">/ctg</p>
                 <p style="position: absolute;top:10.7cm;left:7cm">/re</p>
            </div>
        </div>
    </div>
</body>
</html>