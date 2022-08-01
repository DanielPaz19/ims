<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../source/css/bootstrap.min.css">
    <script src="../source/js/bootstrap.min.js"></script>
    <title>PACC IMS</title>
    <style>
        label {
            font-weight: bold;
        }

        @media print {
            body {
                font-size: 6pt;
                font-family: 'Courier New', Courier, monospace;
            }

            td {
                font-size: 7pt;
            }

            table {
                line-height: .5;
            }

            th {
                font-size: 8pt;
            }

            .report--content {
                /* page-break-before: always !important; */
                border: 1px solid black;
            }
        }

        @media screen {
            body {
                font-size: 12px;
            }
        }

        @media print {
            body {
                line-height: .5;
            }
        }

        @media only screen and (min-width: 320px) and (max-width: 480px) and (resolution: 150dpi) {
            body {
                line-height: 1.4;
            }
        }
    </style>
</head>

<body>

</body>

</html>
<div class="mt-2" style="padding: 2%;">

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <a href="sales-report.php?date1=&date2="><button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Generate by Date</button></a>
            <a href="sales-report.php?date1=&date2="><button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">By Customer</button></a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="background-color: white;">
            <div style="padding: 2%;">
                <div class="row">
                    <div class="col-3">
                        <div class="p-5 mt-3 bg-body rounded" style="border:5px solid #cce0ff">
                            <form class="form-inline" method="GET" action="">
                                <div class="range">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="cusName">
                                            <option selected> </option>
                                            <?php
                                            include "../php/config.php";
                                            $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name DESC");

                                            while ($data = mysqli_fetch_array($records)) {
                                                echo "<option value='" . $data['customers_name'] . "'>" . $data['customers_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Choose Customer</label>
                                    </div>
                                    <br>
                                    <center>
                                        <button class="btn btn-primary btn-sm" name="search" style="width: 100%;">Generate Report</button>
                                    </center>
                                    <br> <br>
                                    <div class="row">
                                        <div class="col"> <button class="btn btn-success btn-sm" id="print" style="width: 100%;">Print Records</button></div>
                                        <div class="col"><a href="../itemlist_main.php"> <button class="btn btn-danger btn-sm" style="width: 100%;" type="button">Close Page</button></a></div>
                                    </div>

                                    &emsp;

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="p-5 mt-3 bg-body rounded printPage" style="width:100%;border:5px solid #cce0ff" id="report">
                            <h5> PACC Delivery Reciepts Reports</h5>
                            <h6> Customer Report</h6>




                            <br>
                            <div class="report">
                                <?php
                                include "../php/config.php";
                                if (isset($_GET['search'])) {
                                    $cusName = $_GET['cusName'];

                                    $sql = "SELECT delivery_receipt.dr_id,delivery_receipt.dr_number,delivery_receipt.user_id,delivery_receipt.dr_date,user.user_name,jo_tb.jo_no,customers.customers_name,customers.customers_address,jo_tb.jo_remarks
                                    FROM delivery_receipt
                                    LEFT JOIN dr_products ON dr_products.dr_number = delivery_receipt.dr_number
                                    LEFT JOIN jo_product ON dr_products.jo_product_id = jo_product.jo_product_id
                                    LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id
                                    LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id
                                    LEFT JOIN user ON user.user_id = delivery_receipt.user_id
                                    WHERE customers.customers_name = '$cusName'
                                    GROUP BY  customers.customers_name
                                   
                                    
                                    
                                ";

                                    $result = $db->query($sql);
                                    $count = 0;
                                    if ($result->num_rows >  0) {

                                        while ($irow = $result->fetch_assoc()) {

                                            $dr_id = str_pad($irow["dr_id"], 8, 0, STR_PAD_LEFT);
                                            $jo_no = $irow["jo_no"];

                                            $cusName = $irow['customers_name'];
                                            $dr_number = $irow['dr_number'];
                                            $dateString = $irow['dr_date'];
                                            $dateTimeObj = date_create($dateString);
                                            $date = date_format($dateTimeObj, 'm/d/y');


                                            // $deptName = $irow['dept_name'];
                                            // $stinRemarks = $irow['stin_remarks'];
                                            // $closed = $irow["closed"];

                                            // if ($closed == 1) {
                                            //     $str = 'Closed';
                                            // } else {
                                            //     $str = 'Open';
                                            // }


                                            $sqlItem = "SELECT product.product_id, dr_products.dr_product_qty, dr_products.jo_product_id, product.product_name, jo_product.jo_product_price, unit_tb.unit_name,
                                            jo_product.jo_product_price *dr_products.dr_product_qty AS subTot
                                            FROM dr_products
                                            LEFT JOIN delivery_receipt ON delivery_receipt.dr_number = dr_products.dr_number
                                            LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
                                            LEFT JOIN product ON product.product_id = jo_product.product_id
                                            LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                                            WHERE delivery_receipt.dr_number='$dr_number'
                                            
                                    ";

                                            $resultItem = $db->query($sqlItem);
                                            $prodId = [];
                                            $prodName = [];
                                            $qty = [];
                                            $unit = [];
                                            $price = [];
                                            $total = [];
                                            // $itemRemarks = [];


                                            if ($result->num_rows >  0) {
                                                while ($irow = $resultItem->fetch_assoc()) {
                                                    $prodId[] = str_pad($irow["jo_product_id"], 8, 0, STR_PAD_LEFT);
                                                    $prodName[] = $irow["product_name"];
                                                    $qty[] = $irow["dr_product_qty"];
                                                    $unit[] = $irow["unit_name"];
                                                    $total[] = $irow["dr_product_qty"] * $irow["jo_product_price"];
                                                    $price[] = $irow["jo_product_price"];
                                                    // $itemRemarks[] = $irow["stin_temp_remarks"];
                                                }
                                            }


                                            echo "
                                           
                        <div class='report--content' style='border: 1px solid lightgrey;padding:1%'>
                        
                            <table class='tb--head table table-borderless'>
                                <tr>
                                    <td><label>Customer</label>&emsp;  $cusName </td>
                                    <td><label>DR No.</label>&emsp; $dr_number</td>
                                    <td><label>JO No.</label>&emsp; $jo_no</td>
                                    <td><label>Date </label>&emsp; $date</td>
                                </tr>
                                <tr>
                                   
                                   
                                    
                                </tr>
                                <tr>
                                
                            </tr>
                            </table>

                            <table class='tb--items table'>
                            <tr style='text-align:left'>
                                <th>Product ID</th>
                                <th>Item Name</th>
                                <th>Order-Qty</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>";

                                            $limit = 0;
                                            while (count($prodId) !== $limit) {
                                                echo "<tr>
                                <td>$prodId[$limit]</td>
                                <td>$prodName[$limit]</td>
                                <td>$qty[$limit]$unit[$limit]</td>
                                <td>" . number_format($price[$limit], 0) . "/$unit[$limit]</td>
                                <td>" . number_format($total[$limit], 2) . "</td>        
                                </tr>";

                                                $limit++;
                                            }




                                            $limita = 0;
                                            $subTot = 0;
                                            $disTot = 0;
                                            while ($limita != count($total)) {
                                                $subTot += $total[$limita];
                                                // $disTot += $totaldisamount[$limit];
                                                $limita += 1;
                                            }
                                            $grandTot = $subTot - $disTot;
                                            echo "   
                                            <tr>
                                            <td colspan='4'></td>
                                            <td align='right'><b style='color:red'>Grand Total: " . number_format($grandTot, 2) . "</b> </td>
                                            </tr>
                            
                                            </table>

                        </div>
                        <br><br>";
                                        }
                                    }
                                } else {
                                    echo '<div class="alert alert-primary" role="alert">
                        No data to display.
                      </div>';
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>












<body style="background-color:#cce0ff">

</body>



<div class="print-area">
    <page size="A4">

    </page>
</div>
</body>



<script>
    function refresh() {
        window.location.reload("Refresh")
    }
</script>
<script>
    document.getElementById("print").addEventListener("click", function() {
        var printContents = document.getElementById('report').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>

</html>