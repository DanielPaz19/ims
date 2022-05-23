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
</head>

<body style="box-sizing:border-box; padding: 0px; margin: 0px; position:relative;">
    <div style="position: absolute; left: 10cm">
        <?php echo $dr_number ?>
    </div>
    <div style="position: absolute;">
        <?php echo $customer['customers_name'] ?>
    </div>
    <div style="position: absolute; top: 1cm;">
        <?php echo $customer['customers_address'] ?>
    </div>
    <div style="position: absolute; top: 2cm;">
        <?php echo $customer['customers_tin'] ?>
    </div>
    <div style="position: absolute; top: 3cm;">
        <?php echo date_format($date, "F d, Y") ?>
    </div>


    <div class="items__container" style="position: absolute; top: 4cm;">
        <?php

        $itemResult = $dr->getProductDetails($dr_number);
        if ($itemResult->num_rows > 0) {
            while ($itemRow = $itemResult->fetch_assoc()) {

        ?>


                <div>
                    <div style="display:inline-block ;">
                        <?php echo $itemRow['dr_product_qty'] ?>
                    </div>
                    <div style="display:inline-block ;">
                        <?php echo $itemRow['unit_name'] ?>
                    </div>
                    <div style="display:inline-block ;">
                        <?php echo $itemRow['product_name'] ?>
                    </div>
                    <div style="display:inline-block ;">
                        <?php echo $itemRow['jo_product_price'] ?>
                    </div>
                    <div style="display:inline-block ;">
                        <?php echo $itemRow['subTotal'] ?>
                    </div>
                </div>


        <?php
            }
        }

        ?>
        <div>
            ****** NOTHING FOLLOWS ******
        </div>
    </div>

    <div style="position: absolute; top: 10cm;">
        <?php echo $drDetails['user_name'] ?>
    </div>
    <div style="position: absolute; top: 11cm;">
        JO NUMBER:<br>
        <?php echo implode(", ", $jo) ?>
    </div>

</body>

</html>