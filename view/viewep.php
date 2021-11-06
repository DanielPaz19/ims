<!-- <?php

        include('../php/config.php');

        if (isset($_POST['stout_submit'])) {
            $id = $_POST['id'];
            $stout_code = mysqli_real_escape_string($db, $_POST['stout_code']);
            $stout_title = mysqli_real_escape_string($db, $_POST['stout_title']);
            $stout_remarks = mysqli_real_escape_string($db, $_POST['stout_remarks']);
            $stout_date = mysqli_real_escape_string($db, $_POST['stout_date']);



            mysqli_query($db, "UPDATE stout_tb SET stout_code='$stout_code', stout_title='$stout_title' ,stout_remarks='$stout_remarks',stout_date='$stout_date'  WHERE stout_id='$id'");

            header("Location:stin.php");
        }


        if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

            $id = $_GET['id'];
            $result = mysqli_query($db, "SELECT  stout_tb.stout_id ,stout_tb.stout_code, stout_tb.stout_title, stout_tb.stout_remarks, stout_tb.itemdesc, stout_tb.stout_date, employee_tb.emp_name, dept_tb.dept_name
														FROM stout_tb  
														INNER JOIN employee_tb ON stout_tb.emp_id = employee_tb.emp_id
														INNER JOIN dept_tb ON employee_tb.dept_id = dept_tb.dept_id
														WHERE stout_id=" . $_GET['id']);

            $row = mysqli_fetch_array($result);

            if ($row) {

                $id = $row['stout_id'];
                $stout_code = $row['stout_code'];
                $stout_title = $row['stout_title'];
                $stout_remarks = $row['stout_remarks'];
                $stout_date = $row['stout_date'];
                $emp_name = $row['emp_name'];
                $dept_name = $row['dept_name'];
                $itemdesc = $row['itemdesc'];
            } else {
                echo "No results!";
            }
        }

        /* TEST CODE*/

        /* TEST CODE END */
        ?>
<html>
<title><?php echo $stout_code; ?></title>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: sans-serif;
            margin: 100px;
            padding: 50px;
        }

        .top {

            letter-spacing: 3px;
            line-height: 1%;
            padding-top: 10px;

        }


        .itemtb td,
        th {
            text-align: left;
            border: 1px solid lightgrey;
            padding: 5px;
        }

        .itemtb th {
            color: midnightblue;
        }

        label,
        th {
            color: midnightblue;
        }


        .itemtb {
            border-collapse: collapse;
            width: 100%;
        }



        .content {
            width: 100%;
        }

        .footertb td {
            padding: 10px;
        }


        @media print {
            #printPageButton {
                display: none;
            }
        }

        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 30mm 45mm 30mm 45mm;
                /* change the margins as you want them to be. */
            }
        }

        button {
            background-color: midnightblue;
            color: white;
            width: 80px;
            height: 30px;
            padding: 5px;
            font-weight: bolder;
        }

        .top1 {
            border-collapse: collapse;
        }

        .top1 td,
        th {
            border: 1px solid black;
        }
    </style>

</head>


<body style="margin: auto;">

    <div class="top">
        <center>
            <h3 style="color: midnightblue;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h3>
            <h4 style="color: midnightblue;">REQUISITION SLIP</h4>
            <hr width="50%">
            <br>
        </center>
    </div>

    <div class="labels">
        <table width="100%">
            <tr>
                <td><b>Job-Order.:</b>&nbsp;&nbsp;<?php echo $stout_title; ?></td>
                <td width="40%"></td>
                <td><b>RS No. :</b>&nbsp;&nbsp;<?php echo $stout_code; ?></td>
            </tr>
            <tr>
                <td><b>Item Description:</b>&nbsp;&nbsp;<?php echo $itemdesc; ?></td>
                <td width="40%"></td>
                <td><b>Date:</b>&nbsp;&nbsp;<?php echo $stout_date; ?></td>
            </tr>
        </table>
    </div>

    <br>

    <div class="content">
        <table width="50%" class="itemtb">
            <tr>
                <th>QTY</th>
                <th>MATERIAL USE</th>
            </tr>
            <?php
            $sql = "SELECT product.product_name,stout_product.stout_temp_qty,unit_tb.unit_name, stout_product.stout_temp_remarks 
			   FROM stout_product 
			   INNER JOIN product ON product.product_id = stout_product.product_id
			   INNER JOIN stout_tb ON stout_product.stout_id=stout_tb.stout_id
			   INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE stout_product.stout_id='$id'";

            $result = $db->query($sql);
            $count = 0;
            if ($result->num_rows >  0) {

                while ($irow = $result->fetch_assoc()) {
                    $count = $count + 1;
            ?>
                    <tr>
                        <td style=" padding-left: 10px;"><?php echo $irow['stout_temp_qty'] ?><?php echo $irow['unit_name'] ?></td>
                        <td><?php echo $irow['product_name'] ?><br><?php echo $irow['stout_temp_remarks'] ?></td>
                    </tr>
            <?php }
            } ?>
        </table>

    </div>



    <table width="100%">
        <tr>
            <td>
                <p style="float: left;"><b>Requested By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $emp_name; ?></p>
            </td>
            <td>
                <p style="float: right;"><b>Department:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $dept_name; ?></p>
            </td>
        </tr>
    </table>







    <br><br><br>
    <button id="printPageButton" onclick="window.print()">Print <i class="fa fa-print"></i></button>
    <a href="../stout_main.php"><button id="printPageButton">Back</button></a>



</body>


</html> -->
<!-- <style>
    body {
        width: 808.81889764px;
        height: 657.63779528px;
        margin: 0%;
        background-image: url('../img/epTemplate.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;

    }
</style>


<body>

</body> -->
<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT ep_tb.ep_id, ep_tb.ep_no, ep_tb.ep_title, ep_tb.ep_remarks, ep_tb.ep_date, customers.customers_name
                                 FROM ep_tb
                                 LEFT JOIN customers ON ep_tb.customers_id = customers.customers_id
                                WHERE ep_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['ep_id'];
        $ep_no = $row['ep_no'];
        $ep_title = $row['ep_title'];
        $ep_remarks = $row['ep_remarks'];
        $ep_date = $row['ep_date'];
        $customers_name = $row['customers_name'];
    } else {
        echo "No results!";
    }
}


?>
<html>
<style>
    * {
        font-family: sans-serif;
    }

    img {
        width: 808.81889764px;
        height: 657.63779528px;
        position: relative;
    }

    .container {
        position: relative;
        text-align: center;
        color: black;
        border: 1px solid black;
        width: 43%;


    }

    .bottom-left {
        position: absolute;
        bottom: 8px;
        left: 16px;
    }

    .ep--customer {
        position: absolute;
        top: 8px;
        left: 16px;
    }

    .ep--customer--address {
        position: absolute;
        top: 8px;
        left: 16px;
    }

    .ep--no {
        position: absolute;
        top: 8px;
        right: 16px;
    }


    .ep--date {
        position: absolute;
        top: 8px;
        right: 16px;
    }

    .bottom-right {
        position: absolute;
        bottom: 8px;
        right: 16px;
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    p {
        font-size: 20px;
        line-height: 2em;
    }

    .ep--itemlist {
        position: absolute;
        top: 8px;
        left: 16px;
    }

    .ep_tb th,
    td {
        padding: 5px;
        border: none;
    }

    .ep_tb {
        margin-left: 10px;
        border-collapse: collapse;

    }
</style>

<head>
    <script language="javascript">
        function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            return false;
        }
    </script>



</head>

<body>


    <div class="container" id="div_print">
        <img src="../img/eptemplate.jpg">

        <div class="ep--no"><br><br><br> <br>
            <p style=" margin-right:15px"><?php echo $ep_no; ?></p>

        </div>

        <div class="ep--date"><br><br><br> <br><br><br><br><br> <br>
            <p style=" margin-right:100px"><?php echo $ep_date; ?></p>
        </div>


        <div class="ep--customer"><br><br><br><br><br><br> <br>
            <p style=" margin-left:120px"><?php echo $customers_name; ?></p>

        </div>

        <div class="ep--customer--address"><br><br><br><br><br><br><br> <br> <br>
            <p style=" margin-left:100px"></p><br>

        </div>

        <div class="ep--itemlist"><br><br><br><br><br><br><br><br><br><br><br> <br> <br>
            <table class="ep_tb" width="100%">
                <tr>
                    <th>&nbsp;&nbsp;</th>
                    <th>&nbsp;&nbsp;</th>
                </tr>
                <?php
                $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.price, ep_product.ep_qty, ep_product.ep_price
                    FROM product 
                    INNER JOIN ep_product ON product.product_id = ep_product.product_id
                    INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE ep_product.ep_id='$id' ";

                $result = $db->query($sql);
                $count = 0;
                if ($result->num_rows >  0) {

                    while ($irow = $result->fetch_assoc()) {
                        $count = $count + 1;
                ?>
                        <tr>
                            <td style="width: 165px;"><?php echo $irow['ep_qty'] ?>&nbsp;<?php echo $irow['unit_name'] ?></td>
                            <td style="width: 570px;"><?php echo $irow['product_name'] ?></td>
                        </tr>
                <?php }
                } ?>
            </table>

        </div>





</body>
<input name="b_print" type="button" class="ipt" onClick="printdiv('div_print');" value=" Print ">

</html>