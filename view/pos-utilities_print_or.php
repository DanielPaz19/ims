<?php
include('../php/config.php');
if (isset($_GET['printOr'])) {
    include "../php/config.php";
    $inv_no = $_GET['invNo'];
    $amount = $_GET['amountInv'];
    $tax = $_GET['tax'];
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
            <tr>
                <td>SI#<?php echo $inv_no ?></td>
                <td><?php echo number_format($amount, 2)  ?></td>
            </tr>

            <?php
            $wvat = $amount / 1.12;
            $wvat2 = $wvat * 0.01;
            $gTotwVat = $amount - $wvat2;

            if ($tax == 3) {

                $str = $gTotwVat;
                echo " <tr>
                <td>LESS EWT</td>
                <td> - " . number_format($wvat2, 2) . "</td>
            </tr>";
            } else {
                $str = $amount;
            } ?>







        </table>
        <!-- table grand total -->
        <p style="position: absolute;top:9.2cm;left:2.7cm"><?php echo number_format($str, 2)  ?></p>

        <?php
        $sql = "SELECT invoice.invoice_id,invoice.invoice_number,dr_inv.dr_number,customers.customers_name,invoice.invoice_date,user.user_name, tax_type_tb.tax_type_id,       
        SUM(jo_product.jo_product_price) AS pricetot
         FROM invoice 
                            LEFT JOIN user ON user.user_id = invoice.user_id 
                            LEFT JOIN dr_inv ON dr_inv.inv_number = invoice.invoice_number 
                            LEFT JOIN dr_products ON dr_products.dr_number = dr_inv.dr_number 
                            LEFT JOIN jo_product ON dr_products.jo_product_id = jo_product.jo_product_id 
                            LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id 
                            LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
                            LEFT JOIN tax_type_tb ON tax_type_tb.tax_type_id = customers.tax_type_id
        WHERE invoice.invoice_number ='$inv_no'";

        $result = $db->query($sql);
        if ($result->num_rows >  0) {
            while ($irow = $result->fetch_assoc()) {
                $dateString = $irow['invoice_date'];
                $dateTimeObj = date_create($dateString);
                $date = date_format($dateTimeObj, 'M d, Y');
        ?>
                <!-- Date-->
                <p style="position: absolute;top:3cm;left:15cm"><?php echo $date  ?></p>
                <!-- customer name -->
                <p style="position: absolute;top:3.7cm;left:8.5cm"><?php echo $irow['customers_name']  ?></p>
                <!-- Pesos Total -->
                <p style="position: absolute;top:5.7cm;left:15.3cm"><?php echo number_format($str, 2)  ?></p>
                <!-- Payment in Form -->
                <!-- <p style="position: absolute;top:8.6cm;left:12.1cm">BDO ONLINE</p> -->
                <p style="position: absolute;top:8.6cm;left:15.5cm">
                    <?php echo number_format($str, 2)  ?>
                </p>
                <p style="position: absolute;top:11.5cm;left:15.5cm"><?php echo number_format($str, 2)  ?></p>

        <?php }
        } ?>










    </div>

</body>

</html>