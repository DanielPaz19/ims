<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT pinv_tb.pinv_id, pinv_tb.pinv_title, pinv_tb.pinv_location, employee_tb.emp_name, pinv_tb.pinv_date, user.user_name, pinv_tb.closed
    FROM pinv_tb
    LEFT JOIN user ON user.user_id = pinv_tb.user_id
    INNER JOIN employee_tb 
    ON pinv_tb.emp_id = employee_tb.emp_id WHERE pinv_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['pinv_id'];
        $pinv_title = $row['pinv_title'];
        $pinv_location = $row['pinv_location'];
        $emp_name = $row['emp_name'];
        $pinv_date = $row['pinv_date'];
    } else {
        echo "No results!";
    }
}


?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            color: black;
            padding: 50px;
        }

        .item-details {
            border-collapse: collapse;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        .item-details td {
            padding: 7px;
            border: 1px solid grey;
            text-align: left;
            font-size: 15px;
            background-color: white;

        }

        .item-details th {
            background-color: midnightblue;
            color: white;
            padding: 5px;
            border: 1px solid grey;
            text-align: left;
            font-size: 15px;
        }

        .fieldset {
            border: none;
        }

        h2 {
            color: midnightblue;
            letter-spacing: 4px;
            text-decoration: underline;
        }


        .button {
            background-color: midnightblue;
            /* Green */
            border: none;
            color: white;
            padding: 7px 16px;
            text-align: center;
            letter-spacing: 2px;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
        }

        .button:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .head {
            color: midnightblue;
        }

        .stock-details td {
            padding: 15px;

        }

        .container {
            padding: 30px;
            background-color: #EAEAEA;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            height: 1000px;
        }

        input[type=number] {
            color: red;
            font-weight: bolder;
        }
    </style>
</head>

<body style="margin: 0px;" bgcolor="#B0C4DE">

    <div class="container">
        <a href="../pinv_main2.php" style="float: right; color: red;" title="Close"><i class="fa fa-close" style="font-size:24px"></i></a>

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <!-- Stock-Out Details -->
        <fieldset class="fieldset">
            <legend>
                <h2>Physical Inventory Details</h2>
            </legend>
            <table class="stock-details" width="100%">
                <tr>
                    <td class="head"><b>Title:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pinv_title; ?></td>
                    <td class="head"><b> Location: </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pinv_location; ?></td>
                    <td class="head"><b> Created Date:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pinv_date; ?></td>
                    <td class="head"><b> Prep By:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $emp_name ?></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                </tr>
            </table>
            <!-- Items Details -->
            <form method="GET" action="../commit/que/pinv_commit_que.php">
                <input type="hidden" name="pinv_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name='mov_date' class='date'>
                <center>
                    <table class="item-details" style="width: 80%;">
                        <tr>
                            <th width="10%">Product ID.</th>
                            <th width="60%">Description</th>
                            <th width="5%">On-Hand</th>
                            <th width="5%">Phy-Qty</th>
                        </tr>

                        <?php
                        $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.cost, pinv_product.pinv_qty
                    FROM product 
                    LEFT JOIN pinv_product ON product.product_id = pinv_product.product_id
                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
                    WHERE pinv_product.pinv_id='$id' ";

                        $result = $db->query($sql);
                        $count = 0;
                        if ($result->num_rows >  0) {

                            while ($irow = $result->fetch_assoc()) {

                        ?>
                                <tr>
                                    <td><?php echo $irow['product_id']; ?></td>
                                    <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                                    <td><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>
                                    <td contenteditable="false">
                                        <font color="red"><input type="number" name="out_qty[]" value="<?php echo $irow['pinv_qty'] ?>" style="border: none;"></font>
                                    </td>
                                </tr>
                                <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                        <?php }
                        } ?>

                </center>
                </table>
                </center>
                <br>
                <input type="submit" name="submit" value="Commit" class="button" onclick="confirmUpdate()">
            </form>
        </fieldset>
    </div>
</body>

<script type="text/javascript">
    function PrintPage() {
        window.print();
    }

    function HideBorder(id) {
        var myInput = document.getElementById(id).style;
        myInput.borderStyle = "none";
    }
</script>
<script>
    //date
    document.querySelector('.date').value = new Date().toISOString();

    function confirmUpdate() {
        let confirmUpdate = confirm("Are you sure you want to Commit record?\n \nNote: Double Check Input Records");
        if (confirmUpdate) {
            alert("Update Record Database Successfully!");
        } else {

            alert("Action Canceled");
        }
    }
</script>

<script>
    function confirmCancel() {
        let confirmUpdate = confirm("Are you sure you want to cancel ?");
        if (confirmUpdate) {
            alert("Nothing Changes");
        } else {

            alert("Action Canceled");
        }
    }
</script>

</html>