<?php

$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$query = "SELECT delivery_receipt.dr_id,delivery_receipt.dr_number,delivery_receipt.user_id,delivery_receipt.dr_date,user.user_name,jo_tb.jo_no,customers.customers_name
FROM delivery_receipt
LEFT JOIN dr_products ON dr_products.dr_number = delivery_receipt.dr_number
LEFT JOIN jo_product ON dr_products.jo_product_id = jo_product.jo_product_id
LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id
LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
LEFT JOIN user ON user.user_id = delivery_receipt.user_id
GROUP BY delivery_receipt.dr_number

";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Reciepts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
        @import url("https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css");

        *,
        *:before,
        *:after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font: 14px/1 'Open Sans', sans-serif;
            color: #555;
            background: aliceblue;
        }

        h1 {
            padding: 50px 0;
            font-weight: 400;
            text-align: center;
        }

        p {
            margin: 0 0 20px;
            line-height: 1.5;
        }

        main {
            min-width: 100%;
            max-width: 800px;
            padding: 50px;
            margin: 0 auto;
            background: white;
        }

        section {
            display: none;
            padding: 20px 0 0;
            border-top: 1px solid #ddd;
        }

        input {
            display: none;
        }

        label {
            display: inline-block;
            margin: 0 0 -1px;
            padding: 15px 25px;
            font-weight: 600;
            text-align: center;
            color: #bbb;
            border: 1px solid transparent;
        }

        label:before {
            font-family: fontawesome;
            font-weight: normal;
            margin-right: 10px;
        }

        img {
            height: 3vh;
        }

        label:hover {
            color: #888;
            cursor: pointer;
        }

        input:checked+label {
            color: #555;
            border: 1px solid #ddd;
            border-top: 3px solid #443DFE;
            border-bottom: 1px solid #fff;
            background-color: white;
        }


        #tab1:checked~#content1,
        #tab2:checked~#content2,
        #tab3:checked~#content3 {
            display: block;
        }

        @media screen and (max-width: 650px) {
            label {
                font-size: 0;
            }

            label:before {
                margin: 0;
                font-size: 18px;
            }
        }

        .shopee {
            padding-bottom: 7px;
            border-bottom: 1px solid #443DFE;
            line-height: 48px;
        }

        .lazada {
            padding-bottom: 7px;
            border-bottom: 1px solid #443DFE;
            line-height: 48px;
        }

        th {
            text-align: left;
        }

        #data td {
            padding: 8px;
            margin: auto;

        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #FDFCFC;
        }

        thead {
            background-color: #443DFE;

        }





        @media screen and (max-width: 400px) {
            label {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <main style="background-color: aliceblue;">
        <!-- tabs -->
        <input type="radio" name="tabs">
        <label for="tab1"><a href="pos-utilities.php">Delivery Reciepts</a></label>

        <input type="radio" name="tabs">
        <label for="tab2"><a href="pos-utilities_si.php">Sales Invoice</a></label>

        <input id="tab3" type="radio" name="tabs" checked>
        <label for="tab3"><a href="pos-utilities-or.php">Official Reciept</a></label>

        <!-- tab content -->
        <section id="content3" style=" padding:2%;border: 1px solid #ddd;background-color:white;height:auto;box-shadow: 5px 5px 5px #aaaaaa;">

            <a href="itemlist_main.php" style="float: right;text-decoration:none;color:#443DFE;font-weight:bold"> <i class="bi bi-chevron-left"></i>&emsp;Back to Itemlist</a>

            <div class="row">
                <div class="col">
                    <h3 style="color: #443DFE;"> <span class="shopee">Official Reciept Records</span> </h3>
                </div>
            </div>


            <form action="" method="get">
                <div class="shadow-sm row" style="background-color: #FEFEFC;padding:2%;width:59%">
                    <div class="col-8">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="inv_no">
                                <option selected> </option>
                                <?php
                                include "php/config.php";
                                $records = mysqli_query($db, "SELECT invoice_number 
                                FROM invoice
                                GROUP BY invoice_number
                                ORDER BY invoice_id DESC");
                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['invoice_number'] . "'>" . $data['invoice_number'] . "</option>";
                                }

                                ?>
                            </select>
                            <label for="floatingSelect">Sales Invoice No.</label>
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check2-circle"></i> Select Record</button>
                    </div>
                </div>

                <br>
            </form>


            <?php

            // IF Edit button Click from PO Main
            if (isset($_GET['submit'])) {

                $inv_no = $_GET['inv_no'];


                require 'php/config.php';

                $result = mysqli_query(
                    $db,
                    "SELECT invoice.invoice_id,invoice.invoice_number,dr_inv.dr_number,customers.customers_name,invoice.invoice_date,user.user_name,tax_type_tb.tax_type_id,dr_products.dr_product_qty,jo_product.jo_product_price,
                    SUM(jo_product.jo_product_price*dr_products.dr_product_qty) AS tot
                    FROM invoice 
                    LEFT JOIN user ON user.user_id = invoice.user_id 
                    LEFT JOIN dr_inv ON dr_inv.inv_number = invoice.invoice_number 
                    LEFT JOIN dr_products ON dr_products.dr_number = dr_inv.dr_number 
                    LEFT JOIN jo_product ON dr_products.jo_product_id = jo_product.jo_product_id 
                    LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id 
                    LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id 
                    LEFT JOIN tax_type_tb ON tax_type_tb.tax_type_id = customers.tax_type_id
                    WHERE invoice.invoice_number ='$inv_no'"
                );



                // PO Details
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $limit = 0;
                        $customerName = $row['customers_name'];
                        $invDate = $row['invoice_date'];
                        $qty = $row['dr_product_qty'];
                        $price = $row['jo_product_price'];
                        $sumTot = $row['tot'];
                        $tax_type = $row['tax_type_id'];
                        $drno = $row['dr_number'];
                    }
                } else {

                    echo "<script>alert('No Item Selected !');
location.href ='pos-utilities-or.php' </script>";
                }

            ?><br>

                <br>

                <form action="view/pos-utilities_print_or.php">

                    <table class="table">
                        <thead style="color: white;">
                            <tr>
                                <th>SI No.</th>
                                <th>DR No.</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <?php
                        // while ($limit != count($amount)) {
                        //     $subTot += $amount[$limit];
                        //     // $disTot += $totaldisamount[$limit];
                        //     $limit += 1;
                        // } 
                        ?>

                        <tbody>
                            <tr>
                                <td><?php echo $inv_no ?></td>
                                <td><?php echo $drno ?></td>
                                <td><?php echo $customerName ?></td>
                                <td><?php echo $invDate  ?></td>
                                <td>P <?php echo number_format($sumTot, 2)   ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="invNo" value="<?php echo $inv_no ?>">
                    <input type="hidden" name="amountInv" value="<?php echo $sumTot ?>">
                    <input type="hidden" name="tax" value="<?php echo $tax_type ?>">
                    <div>
                        <button class="btn btn-primary" name="printOr"> Generate OR</button>
                    </div>
                <?php }
                ?>

                </form>





        </section>

    </main>



</body>

</html>
<script>
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>