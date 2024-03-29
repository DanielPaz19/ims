<?php

include './Delivery.php';

if (isset($_GET['dr_number'])) {

    $dr_number = $_GET['dr_number'];
    $dr = new Delivery();

    $customer = $dr->getCustomerDetails($dr_number);
    $drDetails = $dr->getDeliveryDetails($dr_number);

    $jo = $dr->getJoDetails($dr_number);

    $date = date_create($drDetails['dr_date']);

    // echo $customer['customers_name'] . "<br>";
    // echo $customer['customers_address'] . "<br>";
    // echo $customer['customers_tin'] . "<br>";
    // echo $customer['user_name'] . "<br>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print DR</title>
    <style>
        body {
            margin: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }

        .dr_paper {
            /* border: 1px solid black; */
            width: 21.3cm;
            height: 25.5cm;
        }

        .dr_table {
            position: absolute;
            /* border: 1px solid black; */
            width: 209mm;
            height: 120mm;
            top: 5.9cm;

            /* margin-right: .5cm; */
            /* margin-left: 3mm; */
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            /* border: 1px solid black; */
        }

        .items td {
            /* border: 1px solid black; */
        }


        .ep_table table {
            width: 100%;
            /* border: 1px solid black; */
            border-collapse: collapse;
        }

        @media print {
            .hidden-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="dr_paper" style="position:relative">
        <p style="position: absolute;left:17cm;top:2.8cm;margin:0;"> <?php echo $dr_number ?></p>
        <p style="position: absolute;left:1.7cm;top:3.9cm;margin:0;"> <?php echo $customer['customers_name'] ?></p>
        <p style="position: absolute;left:1cm;top:4.6cm;margin:0;width:70%;letter-spacing: -0px;font-size:14px"> <?php echo $customer['customers_address'] ?></p>
        <p style="position: absolute;left:17.3cm;top:3.9cm;margin:0;letter-spacing: -1px;"> <?php echo date_format($date, "F d, Y") ?></p>
    </div>

    <div class="dr_table">
        <table class="items" style="position: absolute;">
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            $itemResult = $dr->getProductDetails($dr_number);
            $grandTotal = 0;
            if ($itemResult->num_rows > 0) {
                while ($itemRow = $itemResult->fetch_assoc()) {

                    $grandTotal += $itemRow['subTotal'];
            ?>
                    <tr>
                        <td style="width:3cm;height:0.7cm;text-align:center;"><?php echo $itemRow['dr_product_qty'] ?></td>
                        <td style="width: 4cm;height:0.7cm;"> &nbsp;<?php echo $itemRow['unit_name'] ?></td>
                        <td style="font-size: 12.5px;width:25cm;"> <?php echo $itemRow['product_name'] ?></td>
                        <td style="letter-spacing:-2px"> <?php echo number_format($itemRow['jo_product_price'], 0)  ?>/<?php echo $itemRow['unit_name'] ?></td>
                        <td style=" width: 1cm;height:0.7cm"></td>
                        <td style="letter-spacing:-2px"> <?php echo number_format($itemRow['subTotal'], 2) ?></td>
                    </tr>

            <?php
                }
            }

            ?>
            <tr>

                <td></td>
                <td style="font-size: small; padding-top:-5px" colspan="4">
                    <center>****** NOTHING FOLLOWS *****</center>
                </td>
                <td style="text-decoration: overline;text-align:left;vertical-align:top;letter-spacing:-2px">
                    &#8369;<?php echo number_format($grandTotal, 2) ?>
                </td>
            </tr>
        </table>


    </div>

    <div style="position: absolute; top: 21cm;left:1.5cm">
        <?php echo "/" . $drDetails['user_name'] ?>
    </div>
    <div style="position: absolute; top: 22.6cm;left:1cm">
        JO<?php echo implode(", ", $jo) ?>
    </div>
    <div class="hidden-print" style="position: fixed; bottom: 1cm">
        <a href="../index.php">Exit Page</a>
    </div>

</body>

</html>