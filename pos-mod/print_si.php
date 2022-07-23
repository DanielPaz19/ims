<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Invoice</title>
    <link rel="stylesheet" href="../css/si_print.css">
</head>

<body>
    <div class="dr_paper" style="position: relative;">
        <p style="position: absolute;left:2.5cm;top:4cm;margin:0;">Mang Kanor Corporation</p>
        <p style="position: absolute;left:2.5cm;top:4.6cm;margin:0;">111-222-333-000 </p>
        <p style="position: absolute;left:2.5cm;top:5.3cm;margin:0; font-size:small;width:60%">629 Edsa Cubao Quezon City</p>
        <p style="position: absolute;left:16cm;top:4cm;margin:0;">April 14,2018</p>
        <!-- dr No. -->
        <p style="position: absolute;left:17cm;top:4.6cm;margin:0;">39477</p>

        <div class="dr_table">
            <table class="items" style="position: absolute;">

                <tr>
                    <td style="width: 2.2cm;height:0.7cm;text-align:center">1pcs</td>
                    <td style="font-size: 12.8px;width: 12.8cm;">Test Item</td>
                    <td style="width: 1.9cm;text-align:right;font-size: 12.8px">99/pcs</td>
                    <td style="width: 0.95cm;"></td>
                    <td style="width: 2.5cm;;font-size: 12.8px">&#8369;99.00</td>
                </tr>

            </table>
        </div>
        <?php
        // if ($taxId == 1) {
        //     $subTot = 0;
        //     $disTot = 0;

        //     while ($limit != count($total)) {
        //         $subTot += $total[$limit];
        //         // $disTot += $totaldisamount[$limit];
        //         $limit += 1;
        //     }

        //     $grandTot = $subTot - $disTot;
        //     // $anv = $grandTot / 112;
        //     // $anvv = $anv * 100;
        //     // $av = $grandTot - $anvv;
        //     $amountNetVat  = $grandTot / 1.12;
        //     $addVat = $grandTot - $amountNetVat;


        //     echo ' <p style="position: absolute;top:15.1cm;left:18.1cm">' . number_format($amountNetVat, 2) . '</p>
        //     <p style="position: absolute;top:16.3cm;left:18.1cm">' . number_format($addVat, 2) . '</p>
        //     <p style="position: absolute;top:16.9cm;left:18.1cm">' . number_format($grandTot, 2) . '</p>';
        // } else {
        //     echo ' <p style="position: absolute;top:15.9cm;left:12cm">' . number_format($posQty * $posPrice, 2) . '</p>';
        // }
        ?>
        <p style="position: absolute;top:15.1cm;left:18.1cm">amountNetVat</p>
        <p style="position: absolute;top:16.3cm;left:18.1cm">addVat</p>
        <p style="position: absolute;top:16.9cm;left:18.1cm">GrandTot</p>
    </div>
    </div>
</body>

</html>