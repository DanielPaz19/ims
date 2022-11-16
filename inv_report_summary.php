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
            line-height: 1;
        }

        th {
            font-size: 8pt;
        }

        .report--content {
            page-break-before: always !important;
            border: 1px solid black;
        }
    }

    @media screen {
        body {
            font-size: medium;
        }
    }

    @media print {
        body {
            line-height: .5;
            page-break-inside: always;
        }

        .content {
            page-break-inside: always;
        }

        #contentTb {
            break-inside: avoid;
            color: red
        }
    }

    @media only screen and (min-width: 320px) and (max-width: 480px) and (resolution: 150dpi) {
        body {
            line-height: .5;
        }
    }
</style>
<title>Summary Inventory Report</title>
</head>
<!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> -->
<?php include('main_header_v2.php'); ?>
<?php include('php/config.php'); ?>

<body style="background-color:#cce0ff">
    <?php include('main_sidebar.php') ?>
    <div style="padding: 2%;">
        <div class="row">
            <!-- right panel -->
            <div class="col-3" style="background-color: aliceblue;padding:1%">
                <br>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Select Date Range to generate report.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form class="form-inline" method="GET" action="">
                    <div class="range mt-4">
                        <label style="float: left;">From:</label>
                        <input type="date" class="form-control" placeholder="Start" name="date1" /> <br>
                        <label style="float: left;">To :</label>
                        <input type="date" class="form-control" placeholder="End" name="date2" /> <br>



                        <div class="row">
                            <div class="col-4"><button class="btn btn-primary btn-sm" style="width: 100%;" name="search" id='button'><i class="bi bi-tools"></i> Generate</button></div>
                            <div class="col-4"><button class="btn btn-success btn-sm" type="button" style="width: 100%;" id="print"><i class="bi bi-printer"></i> Print</button></div>
                            <div class="col-4"> <a href="itemlist_main.php"> <button type="button" style="width: 100%;" class="btn btn-danger btn-sm" style="width:100%">Cancel</button></a></div>
                        </div>
                        <br>
                    </div>
            </div>

            <!-- left panel -->
            <div class="col">
                <div class="content" style="background-color: white;">
                    <div id="report">
                        <div class="header " style="text-align:center;">
                            <br>
                            <h5>Philippine Acrylic & Chemical Corporation</h5>
                            <h6 style="line-height: .5;">Inventory Management System</h6>
                            <h6>Summary Inventory Reports</h6>
                        </div>
                        <hr>
                        <div style="padding:3%">

                            <?php
                            $dateString = $_GET['date1'];
                            $dateTimeObj = date_create($dateString);
                            $date = date_format($dateTimeObj, 'F d ');

                            $dateString2 = $_GET['date2'];
                            $dateTimeObj2 = date_create($dateString2);
                            $date2 = date_format($dateTimeObj2, 'F d, Y ');

                            if (isset($_GET['search'])) {
                                echo $date; ?> - <?php echo $date2; ?>

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">DEPARTMENT</th>
                                            <th scope="col">FINISH GOODS</th>
                                            <th scope="col">RAW MATERIAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ACRYLIC</td>

                                            <td> <?php

                                                    $result = mysqli_query(
                                                        $db,
                                                        "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 3 AND class_tb.class_type = 0"
                                                    );

                                                    if (mysqli_num_rows($result) > 0) {
                                                        // output data of each row
                                                        while ($row = mysqli_fetch_assoc($result)) {

                                                            $totalAcry = $row['tot'];
                                                        }
                                                    } else {
                                                        echo "0 results";
                                                    }
                                                    ?><?php echo number_format($totalAcry, 2);  ?> pcs
                                            </td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 3 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalAcry2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalAcry2, 2);  ?> pcs</td>


                                        </tr>
                                        <tr>
                                            <td>FABRICATION</td>

                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 2 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalFab = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalFab, 2); ?> pcs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 2 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalFab2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalFab2, 2); ?> pcs</td>

                                        </tr>
                                        <tr>
                                            <td>PROCESSING</td>

                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 1 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalPro = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalPro, 2); ?> kgs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 1 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalPro2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalPro2, 2); ?> kgs</td>

                                        </tr>
                                        <tr>
                                            <td>SALES & DELIVERY</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 12 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalSal = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalSal, 2); ?> pcs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 12 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalSal2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalSal2, 2); ?> pcs</td>

                                        </tr>
                                        <tr>
                                            <td>ADMINISTRATION</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 8 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalAdm = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalAdm, 2); ?> pcs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 8 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalAdm2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalAdm2, 2); ?> pcs</td>

                                        </tr>
                                        <tr>
                                            <td>MAINTENANCE</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 12 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalMai = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalMai, 2); ?> pcs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 12 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalMai2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalMai2, 2); ?> pcs</td>


                                        </tr>
                                        <tr>
                                            <td>AGRICULTURE</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 17 AND class_tb.class_type = 0"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalAgr = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalAgr, 2); ?> pcs</td>
                                            <td><?php
                                                $result = mysqli_query(
                                                    $db,
                                                    "SELECT SUM(product.qty) AS tot FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                        WHERE product.dept_id = 17 AND class_tb.class_type = 1"
                                                );

                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $totalAgr2 = $row['tot'];
                                                    }
                                                } else {
                                                    echo "0 results";
                                                } ?><?php echo number_format($totalAgr2, 2) . ' pcs';
                                                    ?> </td>


                                        </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-primary" role="alert">
                                    <i><strong>*</strong> Total <strong>Quantity</strong> based on ending inventory reports.</i>
                                </div>
                            <?php } ?>
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

        <?php include 'footer.php' ?>
</body>