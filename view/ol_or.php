<?php
include('../php/config.php');
if (isset($_GET['save'])) {
    include "../php/config.php";
    $set = $_GET['set'];
    $fcTotal = $_GET['fcTotal'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Reciept</title>
    <style>
        body {
            margin: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }

        .or_paper {
            /* border: 1px solid black; */
            width: 19cm;
            height: 13.5cm
        }

        td {
            /* border: 1px solid black; */
            height: .6cm;
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="or_paper" style="position: relative;">


        <!-- table breakdown -->
        <table style="top:2.2cm;width:5.6cm;left:.3cm;position:absolute;border-collapse: collapse;">
            <?php
            $sql = "SELECT ol_product.ol_id,ol_tb.ol_title,ol_type.ol_type_name,ol_tb.ol_si,ol_tb.ol_adjustment,
                    SUM(ol_product.ol_fee) AS fc,
                    SUM(ol_product.ol_priceTot) AS price,
                    SUM(ol_product.ol_qty) AS qty
                    FROM ol_product

                    LEFT JOIN ol_tb ON ol_tb.ol_id = ol_product.ol_id
                    LEFT JOIN ol_type ON ol_tb.ol_type_id = ol_type.ol_type_id
                    WHERE ol_tb.ol_title ='$set'
                    GROUP BY ol_tb.ol_id";

            $result = $db->query($sql);
            if ($result->num_rows >  0) {

                while ($irow = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <td style=""><?php echo $irow['ol_si'] ?></td>
                        <td style=""><?php echo number_format($irow['price'], 2) ?></td>
                    </tr>

            <?php }
            } ?>
            <tr>
                <td>
                    <p>Adjustment</p>
                </td>
                <td><?php echo "+" . number_format($_GET['addTot'], 2)  ?></td>
            </tr>
            <tr>
                <td>
                    <p>Less Fee's</p>
                </td>
                <td style=""><?php echo "-" . number_format($_GET['fcTotal'], 2)  ?></td>
            </tr>

        </table>
        <!-- table grand total -->
        <p style="position: absolute;top:9.2cm;left:2.7cm"><?php echo number_format($_GET['grandTot'] - $_GET['fcTotal'] + $_GET['addTot'], 2)  ?></p>

        <?php
        $sql = "SELECT ol_product.ol_id,ol_tb.ol_title,ol_type.ol_type_name,ol_tb.ol_si,ol_tb.ol_date
               
               
                FROM ol_product
                LEFT JOIN ol_tb ON ol_tb.ol_id = ol_product.ol_id
                LEFT JOIN ol_type ON ol_tb.ol_type_id = ol_type.ol_type_id
                WHERE ol_tb.ol_title ='$set'
                GROUP BY ol_tb.ol_id AND ol_type.ol_type_name";

        $result = $db->query($sql);
        if ($result->num_rows >  0) {
            while ($irow = $result->fetch_assoc()) {
                $dateString = $irow['ol_date'];
                $dateTimeObj = date_create($dateString);
                $date = date_format($dateTimeObj, 'M d, Y');
        ?>
                <!-- Date-->
                <p style="position: absolute;top:3.5cm;left:15cm"><?php echo $date  ?></p>
                <!-- customer name -->
                <p style="position: absolute;top:3.7cm;left:9.5cm"><?php echo $irow['ol_type_name']  ?></p>
                <!-- Pesos Total -->
                <p style="position: absolute;top:6.2cm;left:15.3cm"><?php echo number_format($_GET['grandTot'] - $_GET['fcTotal'] + $_GET['addTot'], 2)  ?></p>
                <!-- Payment in Form -->
                <p style="position: absolute;top:8.6cm;left:12.1cm">BDO ONLINE</p>
                <p style="position: absolute;top:8.6cm;left:15.5cm"><?php echo number_format($_GET['grandTot'] - $_GET['fcTotal'] + $_GET['addTot'], 2)  ?></p>
                <p style="position: absolute;top:11.5cm;left:15.5cm"><?php echo number_format($_GET['grandTot'] - $_GET['fcTotal'] + $_GET['addTot'], 2)  ?></p>
        <?php }
        } ?>










    </div>

</body>

</html>