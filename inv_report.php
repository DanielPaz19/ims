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
<title>PACC IMS</title>
</head>
<!-- <link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> -->
<?php include('main_header_v2.php'); ?>


<body style="background-color:#cce0ff">
    <?php include('main_sidebar.php') ?>
    <div style="padding: 2%;">
        <div class="row">
            <div class="col-4">
                <div class="card" style="padding: 10%; background-color:aliceblue;">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle-fill"></i> Choose on <strong>Department</strong> listed below to generate reports based on inventory records.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>


                    <form class="form-inline" method="GET" action="">
                        <div class="range">
                            <div class="form-floating mb-5">
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
                                <div class="col-4"><button class="btn btn-primary" name="search" id='button'><i class="bi bi-tools"></i> Generate</button></div>
                                <div class="col-4"><button class="btn btn-success" type="button" id="print"><i class="bi bi-printer"></i> Print Report</button></div>
                                <div class="col-4"> <a href="itemlist_main.php"> <button type="button" class="btn btn-danger" style="width:100%">Cancel</button></a></div>
                            </div>
                            <br>
                        </div>

                    </form>
                </div>
            </div>

            <div class="content col-8" style="background-color: white;">
                <div id="report">
                    <div class="header mt-3" style="text-align:center;">
                        <h5>Philippine Acrylic & Chemical Corporation</h5>
                        <h6 style="line-height: .5;">Inventory Management System</h6>
                        <h6>Inventory Reports</h6>
                    </div>
                    <div class=" dept-title">
                        <?php

                        $dept_id = $_GET['dept_id'];
                        $date = date('m/d/Y', time());
                        $result = mysqli_query(
                            $db,
                            "SELECT * FROM dept_tb WHERE dept_id  = '$dept_id'"
                        );

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                $dept_name = $row['dept_name'];
                            }
                        } else {
                            echo "0 results";
                        }

                        ?>
                        <div class="row">
                            <div class="col">
                                <strong>Department :</strong> <?php echo $dept_name ?>
                            </div>
                            <div class="col" style="text-align:right">
                                <strong>Date Generated :</strong> <?php echo $date ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>Submitted by:</strong> <?php echo $_SESSION["empName"]; ?>
                            </div>
                        </div>
                        <hr>


                        <!-- <script>
                            //date
                            document.querySelector('.date').value = new Date().toISOString();
                        </script> -->
                    </div>
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
                        $indent50 = 'style = " margin-left: 0; "';
                        $indent100 = 'style = " margin-left: 0; "';
                        //  ----------------------------------------------------------------------------------------------------


                        // echo '<h1>PACC Inventory List</h1>';

                        //-------------------------- Select Company Querries-------------------------------------------------------


                        if (isset($_GET['search'])) {


                            $dept_id = $_GET['dept_id'];


                            $selectCompany = "SELECT product.product_id, product.product_name,class_tb.class_name,dept_tb.dept_name
                                        FROM product
                                        LEFT JOIN dept_tb ON dept_tb.dept_id = product.dept_id
                                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id

                                        WHERE product.dept_id = '$dept_id' 
                                        AND class_tb.dept_id = '$dept_id'  
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

                                    echo '<br>';

                                    echo '<div class="shadow-sm" id="conentTb" style="padding:2%; border:1px dotted lightgrey;"';

                                    echo '<h5' . $indent50 . ' >' . '<strong>**</strong> GROUP  <b>' . $companyName . '</b></h5>';
                                    echo '<div ' . $indent100 . '>';
                                    echo "<table border='0' class='table'";

                                    echo "<tr>";
                                    // echo "<td style='width:10% ;font-weight:bold'>Product_id</td>";
                                    echo "<td style='width:50%;font-weight:bold'>PRODUCT</td>";
                                    // echo "<td style='width:20%;font-weight:bold'>Location</td>";
                                    echo "<td style='width:20%;font-weight:bold;text-align:right'>B.BAL</td>";
                                    echo "<td style='width:20%;font-weight:bold'>UNIT</td>";
                                    echo "<td style='width:20%;font-weight:bold;text-align:right'>E.BAL</td>";
                                    echo "<td style='width:20%;font-weight:bold'>UNIT</td>";
                                    echo "<td style='width:20%;font-weight:bold'>REMARKS</td>";

                                    echo "</tr>";

                                    //-----------------Add Row into the Selected Company --------------------------------

                                    $selectPerson = "SELECT
                                    product.product_id, product.product_name,class_tb.class_name,product.qty,unit_tb.unit_name,loc_tb.loc_name,dept_tb.dept_id,product.pro_remarks
                                                FROM product
                                                LEFT JOIN dept_tb ON dept_tb.dept_id = product.dept_id
                                                LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                                LEFT JOIN unit_tb ON unit_tb.unit_id= product.unit_id
                                                LEFT JOIN loc_tb ON loc_tb.loc_id= product.loc_id
                                                 WHERE class_tb.class_name = '$companyName' AND product.qty > 0.000001 AND product.dept_id = '$dept_id' 
                                                 ORDER BY product.product_id ASC";

                                    $selectPerson_Query = mysqli_query($dbConnectionStatus, $selectPerson);
                                    $arrayPerson = array();
                                    while ($personrows = mysqli_fetch_assoc($selectPerson_Query)) {

                                        $arrayPerson[] = $personrows;
                                    }




                                    foreach ($arrayPerson as $data) {

                                        echo '<tr>';
                                        // Search through the array print out value if see the Key  eg: 'id', 'product_name ' etc.
                                        // echo '<td>' . str_pad($data['product_id'], 8, 0, STR_PAD_LEFT) . '</td>';
                                        echo '<td>' . $data['product_name'] . '</td>';
                                        // echo '<td>' . $data['loc_name'] . '</td>';
                                        echo '<td style="text-align:right">0.00</td>';
                                        echo '<td> ' . $data['unit_name'] . '</td>';

                                        echo '<td style="text-align:right">' . $str = $data['qty'];
                                        strlen(substr(strrchr($str, "."), 2));
                                        '</td>';
                                        echo '<td>' . $data['unit_name'] . '</td>';
                                        echo '<td>' . $data['pro_remarks'] . '</td>';
                                        // echo '<td>' . $data['pro_remarks'] . '</td>';
                                        echo '</tr>';
                                        echo '<tr>';
                                    }

                                    //-------------------------------------------------------------------------------------

                                    echo '<tr>';

                                    echo '<td style="color:red"><strong><i>Subtotal</i></strong></td>';
                                    echo '<td style="text-align:right;color:red"><strong>0.00</strong></td>';

                                    //SUM and display total of quantity
                                    $selectPerson2 = "SELECT SUM(product.qty) AS total
                                    FROM product
                                    LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                                    WHERE class_tb.class_name = '$companyName' AND product.dept_id = '$dept_id' ";

                                    $selectPerson_Query2 = mysqli_query($dbConnectionStatus, $selectPerson2);
                                    $arrayPerson2 = array();

                                    while ($personrows2 = mysqli_fetch_assoc($selectPerson_Query2)) {

                                        $arrayPerson2[] = $personrows2;
                                    }
                                    foreach ($arrayPerson2 as $data2) {

                                        echo '<td style="text-align:right;color:red"></td>';
                                        echo '<td style="color:red;margin:0px;text-align:right"> <b>' . number_format($data2['total'], 2) . '</b></td>';
                                        echo '<td style="text-align:right;color:red"><b></b></td>';
                                        echo '</tr>';
                                    }
                                    echo "</table>";
                                    echo '</div>';
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