<?php include('../main_header_v2.php'); ?>
<style>
    .report--content {
        border: 1px solid lightgray;
        padding: 2px;
        background-color: #F8F8F8;
    }

    @media print {
        .report--content {
            font-size: 12px;
        }
    }
</style>
<div style="padding: 2%;">
    <div class="row">
        <div class="col-3">
            <div class="shadow-lg p-5 mt-5 bg-body rounded printPage" style="width:100%;">
                <form class="form-inline" method="POST" action="">
                    <div class="range">
                        <label style="float: left;">From:</label>
                        <input type="date" class="form-control" placeholder="Start" name="date1" /> <br>
                        <label style="float: left;">To :</label>
                        <input type="date" class="form-control" placeholder="End" name="date2" /> <br>
                        <center><button class="btn btn-primary" name="search" style="width: 100%;">Generate Report</button></center> <br> <br>
                        <button class="btn btn-success" id="doPrint">Print Records</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-9">
            <div class="shadow-lg p-5 mt-5 bg-body rounded printPage" style="width:100%;border:5px solid #cce0ff" id="printDiv">
                <?php
                include "../php/config.php";
                if (isset($_POST['search'])) {
                    $date1 = date("Y-m-d", strtotime($_POST['date1']));
                    $date2 = date("Y-m-d", strtotime($_POST['date2']));
                    $sql = "SELECT jo_tb.jo_id, jo_tb.jo_no, customers.customers_name, jo_tb.jo_date
                            FROM jo_tb 
                            LEFT JOIN customers ON customers.customers_id = jo_tb.customers_id
                            WHERE jo_tb.jo_date 
                            BETWEEN '$date1' AND '$date2'
                                ";

                    $result = $db->query($sql);
                    $count = 0;
                    if ($result->num_rows >  0) {

                        while ($irow = $result->fetch_assoc()) {
                            $joId = str_pad($irow["jo_id"], 8, 0, STR_PAD_LEFT);
                            $joNo = $irow["jo_no"];
                            $customerName = $irow['customers_name'];
                            $dateString = $irow['jo_date'];
                            $dateTimeObj = date_create($dateString);
                            $date = date_format($dateTimeObj, 'm/d/y');
                            // $empName = $irow['emp_name'];
                            // $deptName = $irow['dept_name'];
                            // $stinRemarks = $irow['stin_remarks'];
                            // $closed = $irow["closed"];

                            // if ($closed == 1) {
                            //     $str = 'Closed';
                            // } else {
                            //     $str = 'Open';
                            // }


                            $sqlItem = "SELECT jo_product.jo_id, 
                                               product.product_name, 
                                               product.product_id, 
                                               jo_product.jo_product_qty, 
                                               unit_tb.unit_name,
                                               jo_product.jo_product_price
                                               
                                        FROM jo_product 
                                        LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id
                                        LEFT JOIN product ON product.product_id = jo_product.product_id                  
                                        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                                        WHERE jo_product.jo_id = $joId 
                                    ";

                            $resultItem = $db->query($sqlItem);
                            $prodId = [];
                            $prodName = [];
                            $qty = [];
                            $unit = [];
                            $price = [];
                            if ($result->num_rows >  0) {
                                while ($irow = $resultItem->fetch_assoc()) {
                                    $prodId[] = str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT);
                                    $prodName[] = $irow["product_name"];
                                    $qty[] = $irow["jo_product_qty"];
                                    $unit[] = $irow["unit_name"];
                                    $price[] = $irow["jo_product_price"];
                                }
                            }
                            echo "
                        <div class='report--content'>
                        
                            <table class='table table-borderless'>
                                <tr>
                                    <td style='width:40%'><label>JO ID:</label> $joId </td>
                                    <td style='width:40%'><label>Jo No.:</label> $joNo</td>
                                    <td style='width:20%'><label>JO Date: </label> $date</td>
                                </tr>
                                <tr>
                                    <td colspan='3'><label>Customer:</label> $customerName</td>
                                </tr>
                            </table>

                            <table class='tb--items table'>
                            <tr style='text-align:left'>
                                <th>Product ID</th>
                                <th>Item Name</th>
                                <th>Qty-Order</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                                
                            </tr>";

                            $limit = 0;
                            while (count($prodId) !== $limit) {
                                $total[$limit] = $qty[$limit] * $price[$limit];
                                echo "<tr>
                                <td>$prodId[$limit]</td>
                                <td>$prodName[$limit]</td>
                                <td>$qty[$limit] $unit[$limit]</td>
                                <td>" . number_format($price[$limit], 2) . "/$unit[$limit]</td>
                                <td>" . number_format($total[$limit], 2) . "</td>
                                </tr>
                              
                                 
                
                              ";

                                $limit++;
                            }
                            $limit = 0;
                            $subTot = 0;
                            $disTot = 0;
                            while ($limit != count($total)) {
                                $subTot += $total[$limit];
                                // $disTot += $totaldisamount[$limit];
                                $limit += 1;
                            }
                            $grandTot = $subTot - $disTot;


                            echo " <tr><td style='font-weight:bold;text-align:right' colspan='5'>Grand Total: " . number_format($grandTot, 2)  . "</td></tr>  </table>

                        </div>
                       <center> ****************************************************** </center>
                
                        ";
                        }
                    }
                }
                ?>
            </div>

        </div>
    </div>
</div>


<script>
    document.getElementById("doPrint").addEventListener("click", function() {
        var printContents = document.getElementById('printDiv').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>