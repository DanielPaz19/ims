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
        <table style="top:2.2cm;width:5.6cm;left:.9cm;position:absolute;border-collapse: collapse;">
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
        <p style="position: absolute;top:9.4cm;left:3.7cm"><?php echo number_format($str, 2)  ?></p>

        <?php
        $sql = "SELECT invoice.invoice_id,invoice.invoice_number,dr_inv.dr_number,customers.customers_name,invoice.invoice_date,user.user_name, tax_type_tb.tax_type_id, customers.customers_address,      
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
                $drno = $irow['dr_number'];
                $dateString = $irow['invoice_date'];
                $dateTimeObj = date_create($dateString);
                $date = date_format($dateTimeObj, 'M d, Y');
        ?>
                <!-- DR#-->

                <p style="position: absolute;top:9.3cm;left:7.5cm">DR#<?php echo $drno ?></p>
                <!-- Date-->
                <p style="position: absolute;top:2.4cm;left:15cm"><?php echo $date  ?></p>
                <!-- customer name -->
                <p style="position: absolute;top:3.2cm;left:9.2cm;font-size:small"><?php echo $irow['customers_name']  ?></p>
                <p style="position: absolute;top:3.9cm;left:7.7cm;font-size:11px"><?php echo $irow['customers_address']  ?></p>
                <!-- Pesos Total -->
                <p style="position: absolute;top:5.5cm;left:15.9cm"><?php echo number_format($str, 2)  ?></p>
                <!-- Payment in Form -->
                <!-- <p style="position: absolute;top:8.6cm;left:12.1cm">BDO ONLINE</p> -->
                <p style="position: absolute;top:7.1cm;left:15.9cm">
                    <?php echo number_format($str, 2)  ?>
                </p>
                <p style="position: absolute;top:11.3cm;left:15.9cm"><?php echo number_format($str, 2)  ?></p>

        <?php }
        } ?>


        <?php
        function number_to_word($num = '')
        {
            $num = (string) ((int) $num);

            if ((int) ($num) && ctype_digit($num)) {
                $words = array();

                $num = str_replace(array(',', ' '), '', trim($num));

                $list1 = array(
                    '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
                    'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
                    'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
                );

                $list2 = array(
                    '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
                    'seventy', 'eighty', 'ninety', 'hundred'
                );

                $list3 = array(
                    '', 'thousand', 'million', 'billion', 'trillion',
                    'quadrillion', 'quintillion', 'sextillion', 'septillion',
                    'octillion', 'nonillion', 'decillion', 'undecillion',
                    'duodecillion', 'tredecillion', 'quattuordecillion',
                    'quindecillion', 'sexdecillion', 'septendecillion',
                    'octodecillion', 'novemdecillion', 'vigintillion'
                );

                $num_length = strlen($num);
                $levels = (int) (($num_length + 2) / 3);
                $max_length = $levels * 3;
                $num = substr('00' . $num, -$max_length);
                $num_levels = str_split($num, 3);

                foreach ($num_levels as $num_part) {
                    $levels--;
                    $hundred = (int) ($num_part / 100);
                    $hundred = ($hundred ? ' ' . $list1[$hundred] . ' Hundred' . ($hundred == 1 ? '' : '') . ' ' : '');
                    $tens = (int) ($num_part % 100);
                    $singles = '';

                    if ($tens < 20) {
                        $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                    } else {
                        $tens = (int) ($tens / 10);
                        $tens = ' ' . $list2[$tens] . ' ';
                        $singles = (int) ($num_part % 10);
                        $singles = ' ' . $list1[$singles] . ' ';
                    }
                    $words[] = $hundred . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
                }
                $commas = count($words);
                if ($commas > 1) {
                    $commas = $commas - 1;
                }

                $words = implode(', ', $words);

                $words = trim(str_replace(' ,', ',', ucwords($words)), ', ');
                if ($commas) {
                    $words = str_replace(',', ' and', $words);
                }

                return $words;
            } else if (!((int) $num)) {
                return 'Zero';
            }
            return '';
        }

        $words = "<p style='position:absolute;left:8.3cm;top:5.3cm;margin:0;font-size:small'>" . number_to_word("$str") . "</p>";

        echo $words;


        ?>





    </div>

</body>

</html>