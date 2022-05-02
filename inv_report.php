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
                font-size: medium;
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
    <title>PACC IMS</title>
</head>
<!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> -->


<body style="background-color:#cce0ff">
    <div style="padding: 2%;">
        <div class="row">
            <div class="col-4">
                <div style="padding: 10%; background-color:aliceblue">
                    <p>Select Department to Generate Report.</p>
                    <form class="form-inline" method="GET" action="">
                        <div class="range">
                            <div class="form-floating mb-2">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dept_id">
                                    <option></option>
                                    <?php
                                    include "php/config.php";
                                    $records = mysqli_query($db, "SELECT * FROM dept_tb");
                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Department List</label>
                            </div>



                            <div class="row">

                                <div class="col-6"><button class="btn btn-primary" name="search" id='button'><i class="bi bi-tools"></i> Generate</button></div>
                                <div class="col-6"><button class="btn btn-success" id="print"><i class="bi bi-printer"></i> Print Report</button></div>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-8" style="background-color: white;">
                <?php
                /*
 
*   File:       displayByCompany.php
 
*/


                // Connect DB

                $hostName  = "localhost";
                $userName = "root";
                $userPassword = "";
                $database = "inventorymanagement";
                $comArray = array();
                $orderClause = '';
                $tempcompany = '';
                $comArray = array();


                $dbConnectionStatus  = new mysqli($hostName, $userName, $userPassword, $database);

                //Connection Error
                if ($dbConnectionStatus->connect_error) {


                    die("Connection failed: " . $dbConnectionStatus->connect_error);
                }
                // Connected to Database JaneDB
                // Object oriented  -> pointing 
                if ($dbConnectionStatus->query("SELECT DATABASE()")) {

                    $dbSuccess = true;
                    //
                    $result = $dbConnectionStatus->query("SELECT DATABASE()");
                    $row = $result->fetch_row();
                    // printf("Default database is %s.\n", $row[0]);
                    $result->close();
                }


                // DB Connect Successful

                if ($dbSuccess) {

                    //  -------------------- Style declarations---------------------------------------------------------


                    $textFont = 'style = " font-family: arial, helvetica, sans-serif; "';
                    $indent50 = 'style = " margin-left: 50; "';
                    $indent100 = 'style = " margin-left: 100; "';
                    //  ----------------------------------------------------------------------------------------------------


                    // echo '<h1>PACC Inventory List</h1>';

                    //-------------------------- Select Company Querries-------------------------------------------------------


                    if (isset($_GET['search'])) {
                        $dept_id = $_GET['dept_id'];

                        $selectCompany = "SELECT product.product_id, product.product_name,class_tb.class_name
                                        FROM product
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                            WHERE dept_id = '$dept_id'";
                        $selectCompany_Query = mysqli_query($dbConnectionStatus, $selectCompany);
                        $companyArray = array();

                        // Loop Through Company Records
                        while ($rowsCompany = mysqli_fetch_assoc($selectCompany_Query)) {

                            // Get the Company Name/ id


                            $companyName = $rowsCompany['class_name'];

                            // Check whether the Company Table is Created f No Create the Table
                            if (!in_array($companyName, $comArray)) {

                                array_push($comArray, $companyName);

                                echo '<h5 ' . $indent50 . '>' . '<i class="bi bi-stop-fill"></i> Group by ' . $companyName . '</h5>';
                                echo '<div ' . $indent100 . '>';
                                echo "<table border='0' class='table table-striped'>";

                                echo "<tr>";
                                echo "<td style='width:10% ;font-weight:bold'>Product_id</td>";
                                echo "<td style='width:60%;font-weight:bold'>Item Description</td>";

                                echo "</tr>";

                                //-----------------Add Row into the Selected Company --------------------------------

                                $selectPerson = "SELECT product.product_id, product.product_name,class_tb.class_name
                                FROM product
                                                LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                                 WHERE class_tb.class_name = '$companyName'";
                                $selectPerson_Query = mysqli_query($dbConnectionStatus, $selectPerson);
                                $arrayPerson = array();
                                while ($personrows = mysqli_fetch_assoc($selectPerson_Query)) {

                                    $arrayPerson[] = $personrows;
                                }
                                foreach ($arrayPerson as $data) {

                                    echo '<tr>';
                                    // Search through the array print out value if see the Key  eg: 'id', 'firstname ' etc.
                                    echo '<td>' . str_pad($data['product_id'], 8, 0, STR_PAD_LEFT) . '</td>';
                                    echo '<td>' . $data['product_name'] . '</td>';

                                    echo '</tr>';
                                }

                                //-------------------------------------------------------------------------------------

                                echo "</table>";
                                echo '</div>';
                            }
                        }





                        echo '</div>';
                    }
                }


                ?>
            </div>
        </div>
    </div>












    <div class="container shadow p-3 mb-5 bg-body rounded" style="margin-top:3%;">
        <div class="row">
            <center>
                <div class="col-12">
                    <h3 style="color: midnightblue; letter-spacing:3px">Philippine Acrylic & Chemical Corporation</h3>
                </div>
                <div class="col-12">
                    <h4 style="letter-spacing: 3px;">Physical Inventory Report</h4>
                </div>
            </center>
            <hr class="bg-danger border-2 border-top border-primary">

            <div class="row">
                <div class="col-3">
                    <form class="form-inline" method="GET" action="">
                        <div class="range">
                            <!-- <label style="float: left;">From:</label>
                        <input type="date" class="form-control" placeholder="Start" name="date1" /> <br>
                    <label style="float: left;">To :</label>
                        <input type="date" class="form-control" placeholder="End" name="date2" /> <br>
                    <label for="inputEmail4" class="form-label">Select Product Class <span style="color: red;">*</span> </label> -->
                            <select class="form-select form-select" name="dept_id">
                                <option value="">Choose...</option>
                                <?php
                                include "php/config.php";
                                $records = mysqli_query($db, "SELECT * FROM dept_tb");
                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
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
                            <a href="pinv_report.php"><button class="btn btn-secondary" onclick="myFunction()" style="width:80%"><i class="bi bi-arrow-repeat"></i> Reset</button></a>
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
                        <?php
                        /*
 
*   File:       displayByCompany.php
 
*/


                        // Connect DB

                        $hostName  = "localhost";
                        $userName = "root";
                        $userPassword = "";
                        $database = "inventorymanagement";
                        $comArray = array();
                        $orderClause = '';
                        $tempcompany = '';
                        $comArray = array();


                        $dbConnectionStatus  = new mysqli($hostName, $userName, $userPassword, $database);

                        //Connection Error
                        if ($dbConnectionStatus->connect_error) {


                            die("Connection failed: " . $dbConnectionStatus->connect_error);
                        }
                        // Connected to Database JaneDB
                        // Object oriented  -> pointing 
                        if ($dbConnectionStatus->query("SELECT DATABASE()")) {

                            $dbSuccess = true;
                            //
                            $result = $dbConnectionStatus->query("SELECT DATABASE()");
                            $row = $result->fetch_row();
                            // printf("Default database is %s.\n", $row[0]);
                            $result->close();
                        }


                        // DB Connect Successful

                        if ($dbSuccess) {

                            //  -------------------- Style declarations---------------------------------------------------------


                            $textFont = 'style = " font-family: arial, helvetica, sans-serif; "';
                            $indent50 = 'style = " margin-left: 50; "';
                            $indent100 = 'style = " margin-left: 100; "';
                            //  ----------------------------------------------------------------------------------------------------


                            // echo '<h1>PACC Inventory List</h1>';

                            //-------------------------- Select Company Querries-------------------------------------------------------


                            if (isset($_GET['search'])) {
                                $dept_id = $_GET['dept_id'];

                                $selectCompany = "SELECT product.product_name, pinv_product.pinv_qty, class_tb.class_name
FROM pinv_product
LEFT JOIN product ON product.product_id = pinv_product.product_id
LEFT JOIN class_tb ON product.class_id = class_tb.class_id
WHERE product.dept_id = '$dept_id'
ORDER BY class_tb.class_name ASC";
                                $selectCompany_Query = mysqli_query($dbConnectionStatus, $selectCompany);
                                $companyArray = array();

                                // Loop Through Company Records
                                while ($rowsCompany = mysqli_fetch_assoc($selectCompany_Query)) {

                                    // Get the Company Name/ id


                                    $companyName = $rowsCompany['class_name'];

                                    // Check whether the Company Table is Created f No Create the Table
                                    if (!in_array($companyName, $comArray)) {

                                        array_push($comArray, $companyName);

                                        echo '<h5 ' . $indent50 . '>' . '<i class="bi bi-stop-fill"></i> Group by ' . $companyName . '</h5>';
                                        echo '<div ' . $indent100 . '>';
                                        echo "<table border='0' class='table table-striped'>";

                                        echo "<tr>";
                                        echo "<td style='width:10% ;font-weight:bold'>Product_id</td>";
                                        echo "<td style='width:60%;font-weight:bold'>Item Description</td>";
                                        echo "<td style='width:10%;font-weight:bold;text-align:right'>Qty</td>";
                                        echo "<td style='width:10%;font-weight:bold'>Unit</td>";
                                        echo "<td style='width:10%;font-weight:bold'>Location</td>";
                                        echo "</tr>";

                                        //-----------------Add Row into the Selected Company --------------------------------

                                        $selectPerson = "SELECT product.product_name, pinv_product.pinv_qty, class_tb.class_name,product.product_id,unit_tb.unit_name,loc_tb.loc_name
                                                              FROM pinv_product
                                                              LEFT JOIN product ON product.product_id = pinv_product.product_id
                                                              LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                                              LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                                                              LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                                                              WHERE class_tb.class_name = '$companyName' AND pinv_product.pinv_qty > 0
                                                              ORDER BY product.product_name ASC";
                                        $selectPerson_Query = mysqli_query($dbConnectionStatus, $selectPerson);
                                        $arrayPerson = array();
                                        while ($personrows = mysqli_fetch_assoc($selectPerson_Query)) {

                                            $arrayPerson[] = $personrows;
                                        }
                                        foreach ($arrayPerson as $data) {

                                            echo '<tr>';
                                            // Search through the array print out value if see the Key  eg: 'id', 'firstname ' etc.
                                            echo '<td>' . str_pad($data['product_id'], 8, 0, STR_PAD_LEFT) . '</td>';
                                            echo '<td>' . $data['product_name'] . '</td>';
                                            echo '<td style="text-align:right">' . number_format($data['pinv_qty'], 2) . '</td>';
                                            echo '<td>' . $data['unit_name'] . '</td>';
                                            echo '<td>' . $data['loc_name'] . '</td>';
                                            echo '</tr>';
                                        }

                                        //-------------------------------------------------------------------------------------

                                        echo "</table>";
                                        echo '</div>';
                                    }
                                }





                                echo '</div>';
                            }
                        }


                        ?>




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

</body>

<script>
    document.getElementById("print").addEventListener("click", function() {
        var printContents = document.getElementById('report').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>