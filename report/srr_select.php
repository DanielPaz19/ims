<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- font include -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro&display=swap" rel="stylesheet">

    <!-- sidebar styles -->
    <link rel="stylesheet" href="../css/../main_style.css">

    <!-- sidebar script -->
    <script src="js/sidebar_scriot.js"></script>
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
                font-size: 9pt;
            }

            /* table {
                line-height: .5;
            } */

            th {
                font-size: 10pt;
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
            /* body {
                line-height: .5;
            } */
        }

        @media only screen and (min-width: 320px) and (max-width: 480px) and (resolution: 150dpi) {
            body {
                line-height: 1.4;
            }
        }
    </style>
    <title>PACC IMS</title>
</head>


<body style="background-color:#cce0ff">
    <div style="padding: 2%;">
        <div class="row">
            <div class="col-3">
                <div class="shadow-lg p-5 mt-5 bg-body rounded printPage" style="width:100%;">
                    <form class="form-inline" method="POST" action="" autocomplete="off">
                        <div class="range">
                            <label style="float: left;">From:</label>
                            <input type="date" class="form-control" placeholder="Start" name="date1" /> <br>
                            <label style="float: left;">To :</label>
                            <input type="date" class="form-control" placeholder="End" name="date2" /> <br>
                            <label style="float: left;">Srr No. :</label>
                            <input type="text" class="form-control" name="srr_no"> <br>
                            <label style="float: left;">Month :</label>
                            <input type="text" class="form-control" name="srr_month"> <br>
                            <center>
                                <button class="btn btn-primary" name="search" style="width: 100%;">Generate Report</button>
                            </center>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col"> <button class="btn btn-success" id="print" style="width: 100%;">Print Records</button></div>
                                <div class="col"><button class="btn btn-danger" onClick="self.close()" style="width: 100%;">Close Page</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-9">
                <div class="shadow-lg p-5 mt-5 bg-body rounded printPage" style="width:100%;border:5px solid #cce0ff" id="report">
                    <center>
                        <h4>
                            PHILIPPINE ACRYLIC & CHEMICAL CORPORATION
                        </h4>
                        <h5 style="line-height:1px">Storeroom Reciepts Register
                        </h5>
                        <hr>
                    </center>
                    <div class="row">
                        <div class="col">
                            <?php
                            if (isset($_POST['search'])) {

                                echo ' <h5>Month : <u>' . $_POST["srr_month"] . '</u></h5>
                                </div>
                                <div class="col">
                                <h5 style="text-align:right">SRR No. <u>' . $_POST["srr_no"] . '</u></h5>
                                </div>';
                            } ?>
                        </div>
                        <table class="srrItem table">
                            <thead>
                                <tr style="text-align: left;">
                                    <th>Date</th>
                                    <th>Supplier</th>
                                    <th>Ref. No.</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../php/config.php';
                                if (isset($_POST['search'])) {
                                    $date1 = date("Y-m-d", strtotime($_POST['date1']));
                                    $date2 = date("Y-m-d", strtotime($_POST['date2']));
                                    $query = mysqli_query($db, "SELECT po_tb.po_date, sup_tb.sup_name, po_tb.po_code, product.product_name, po_product.item_qtyorder, unit_tb.unit_name, product.pro_remarks, po_tb.po_type_id
                                    FROM po_tb
                                    LEFT JOIN sup_tb ON sup_tb.sup_id = po_tb.sup_id
                                    LEFT JOIN po_product ON po_product.po_id = po_tb.po_id
                                    INNER JOIN product ON product.product_id = po_product.product_id
                                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
                                    LEFT JOIN po_type ON po_type.po_type_id = po_tb.po_type_id
                                    WHERE po_tb.po_type_id = 1 AND po_tb.po_date 
                                    BETWEEN '$date1' AND '$date2'
                                     ORDER BY sup_tb.sup_name ASC");
                                    $row = mysqli_num_rows($query);
                                    if ($row > 0) {
                                        while ($fetch = mysqli_fetch_array($query)) {
                                            $dateString = $fetch['po_date'];
                                            $dateTimeObj = date_create($dateString);
                                            $date = date_format($dateTimeObj, 'm/d/y');
                                ?>

                                            <tr>
                                                <td><?php echo $date ?><br></td>
                                                <td><?php echo $fetch['sup_name'] ?></td>
                                                <td><?php echo $fetch['po_code'] ?></td>
                                                <td><?php echo $fetch['product_name'] ?></td>
                                                <td><?php echo $fetch['item_qtyorder'] ?></td>
                                                <td><?php echo $fetch['unit_name'] ?></td>
                                                <td><?php echo $fetch['pro_remarks'] ?></td>

                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo '
			<tr>
				<script>alert("No records found !");</script>
			</tr>';
                                    }
                                } else {
                                    $query = mysqli_query($db, "SELECT po_tb.po_date, sup_tb.sup_name, po_tb.po_code, product.product_name, po_product.item_qtyorder, unit_tb.unit_name, product.pro_remarks
                                                    FROM po_tb
                                                    LEFT JOIN sup_tb ON sup_tb.sup_id = po_tb.sup_id
                                                    LEFT JOIN po_product ON po_product.po_id = po_tb.po_id
                                                    INNER JOIN product ON product.product_id = po_product.product_id
                                                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
                                                    LEFT JOIN po_type ON po_type.po_type_id = po_tb.po_type_id
                                                    WHERE po_tb.po_type_id = 1 
                                                    ORDER BY sup_tb.sup_name ASC");
                                    while ($fetch = mysqli_fetch_array($query)) {
                                        $dateString = $fetch['po_date'];
                                        $dateTimeObj = date_create($dateString);
                                        $date = date_format($dateTimeObj, 'm/d/y');
                                        ?>
                                        <tr>
                                            <td><?php echo $date ?></td>
                                            <td><?php echo $fetch['sup_name'] ?></td>
                                            <td><?php echo $fetch['po_code'] ?></td>
                                            <td><?php echo $fetch['product_name'] ?></td>
                                            <td><?php echo $fetch['item_qtyorder'] ?></td>
                                            <td><?php echo $fetch['unit_name'] ?></td>
                                            <td><?php echo $fetch['pro_remarks'] ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

</body>







<!-- <script>
    function refresh() {
        window.location.reload("Refresh")
    }
</script> -->
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