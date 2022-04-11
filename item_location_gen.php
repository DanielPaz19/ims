<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/bootstrap.min.css">
    <script src="source/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../img/pacclogo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>PACC IMS</title>
    <style>
        @media print {
            body {
                font-size: 6pt;
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

<body style="background-color:#F4F4F4">
    <div class="container shadow p-3 mb-5 bg-body rounded" style="margin-top:3%;">
        <div class="row">
            <center>
                <div class="col-12">
                    <!-- <h3 style="color: midnightblue; letter-spacing:3px">Philippine Acrylic & Chemical Corporation</h3> -->
                </div>
                <div class="col-12">
                    <!-- <h4>PRCG Product Detailed Report</h4> -->
                </div>
            </center>
            <hr class="bg-danger border-2 border-top border-primary">

            <div class="row">
                <div class="col-3">
                    <form class="form-inline" method="GET" action="">
                        <div class="range">

                            <select class="form-select form-select" name="loc_id">
                                <option value="">Choose...</option>
                                <?php
                                include "php/config.php";
                                $records = mysqli_query($db, "SELECT * FROM loc_tb WHERE loc_name LIKE '%B2STR%'");
                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                                }
                                ?>
                            </select> <br>
                            <div class="row">

                                <div class="col-6"><button class="btn btn-primary" name="search" id='button'><i class="bi bi-tools"></i> Generate</button></div>
                                <div class="col-6"><button class="btn btn-success" id="print"><i class="bi bi-printer"></i> Print Report</button></div>
                            </div>
                            <br>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-6">
                            <a href="ton_prcg_report.php"><button class="btn btn-secondary" onclick="myFunction()" style="width:80%"><i class="bi bi-arrow-repeat"></i> Reset</button></a>
                        </div>
                        <div class="col-6">
                            <a href="index.php"> <button class="btn btn-danger" style="width:95%"><i class="bi bi-x-circle"></i> Cancel</button></a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert"><i class="bi bi-info-circle-fill"></i> Use the form above to genarate Report.</div>
                        </div>
                    </div>

                </div>

                <div class="col-9">
                    <div id="report">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Location</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require 'php/config.php';
                                if (isset($_GET['search'])) {

                                    $loc_id = $_GET['loc_id'];
                                    $query = mysqli_query($db, "SELECT product.product_id,product.product_name,product.qty,unit_tb.unit_name,loc_tb.loc_name
                                    FROM product
                                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                                    LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                                    WHERE product.loc_id = '$loc_id' AND product.qty > 0");
                                    $row = mysqli_num_rows($query);
                                    if ($row > 0) {
                                        while ($fetch = mysqli_fetch_array($query)) {

                                ?>
                                            <tr>
                                                <td><?php echo $fetch['product_id'] ?></td>
                                                <td><?php echo $fetch['product_name'] ?></td>
                                                <td><?php echo $fetch['qty'] ?>&nbsp;<?php echo $fetch['unit_name'] ?></td>
                                                <td><?php echo $fetch['loc_name'] ?></td>


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
                                    ?>



                            </tbody>
                        </table>
                        <div class="alert alert-danger" role="alert" style="text-align: center;">No data found !</div>
                    <?php
                                } ?>



                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>

    <script>
        document.getElementById("print").addEventListener("click", function() {
            var printContents = document.getElementById('report').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

        function myFunction() {
            alert("Reset Data successfully !");
        }
    </script>


</body>

</html>