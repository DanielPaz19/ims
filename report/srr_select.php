<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/srr_report.css" type="text/css" media="print">
    <link rel="stylesheet" href="../css/srr_report.css" type="text/css">
    <style>
        body {
            padding: 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .srrItem {
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        .srrItem th,
        td {
            border: 1px solid black;
        }

        p {
            margin-left: 10px;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 2px;
        }

        .range {
            margin-left: 30px;
        }

        .head {
            padding: 10px;
        }

        input[type=date] {
            width: 20%;
            padding: 6px 10px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 15px;
        }

        button {
            height: 40px;
            cursor: pointer;
            font-size: 13px;
        }
    </style>
</head>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ]
        });
    });
</script>

<body>

    <div class="noprint">
        <form class="form-inline" method="POST" action="">

            <p><i class="fa fa-lightbulb-o" style="font-size:24px"></i>&nbsp;Hint: You can choose which data to include from this report by creating filter for fields for the fields below. <br> </p>

            <div class="range">
                <label>Date:</label>
                <input type="date" class="form-control" placeholder="Start" name="date1" />
                <label>To</label>
                <input type="date" class="form-control" placeholder="End" name="date2" />
                <button class="btn btn-primary" name="search">Generate Report</button>

            </div>
        </form>

        <br /><br />
    </div>




    <hr style="border-top:1px" />
    <div class="print-area">
        <page id="print" size="A4">

            <div class="head">
                <center>
                    <h3 style="color: midnightblue;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h3>
                    <h4 style="color: midnightblue; line-height:1px">Storeroom Reciepts Register</h4>
                    <hr>
                </center>
            </div>

            <h5 style="float:right">SRR No. : <input type="text" style="border: none; background-color:transparent" placeholder="00000000"></h5>
            <h5 style="float:left"><input type="text" style="border: none; background-color:transparent" placeholder="For the month of : Year"></h5>
            <table class="srrItem" id="example">
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
                        $query = mysqli_query($db, "SELECT po_tb.po_date, sup_tb.sup_name, po_tb.po_code, product.product_name, po_product.item_qtyorder, unit_tb.unit_name, product.pro_remarks
                                    FROM po_tb
                                    LEFT JOIN sup_tb ON sup_tb.sup_id = po_tb.sup_id
                                    LEFT JOIN po_product ON po_product.po_id = po_tb.po_id
                                    INNER JOIN product ON product.product_id = po_product.product_id
                                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
                                    WHERE po_tb.po_date 
                                    BETWEEN '$date1' AND '$date2' ORDER BY sup_tb.sup_name ASC");
                        $row = mysqli_num_rows($query);
                        if ($row > 0) {
                            while ($fetch = mysqli_fetch_array($query)) {
                    ?>
                                <tr>
                                    <td><?php echo $fetch['po_date'] ?></td>
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
                                                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id");
                        while ($fetch = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $fetch['po_date'] ?></td>
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
        </page>
    </div>
</body>

<script>
    function refresh() {
        window.location.reload("Refresh")
    }
</script>
<script>
    function printDiv() {
        var divContents = document.getElementById("print-area").innerHTML;
        var a = window.open('', '', 'height=1000, width=1300');
        a.document.write(divContents);
        a.document.close();
        a.print();
    }
</script>

</html>