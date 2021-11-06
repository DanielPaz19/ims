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
        <a href="../ep_main.php" style="float: right; color: red;" title="Close"><i class="fa fa-close" style="font-size:24px"></i></a>

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <!-- Stock-Out Details -->
        <fieldset class="fieldset">
            <legend>
                <h2>Exit-Pass Details</h2>
            </legend>
            <table class="stock-details" width="100%">
                <tr>
                    <td class="head"><b>EP No. :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ep_no; ?></td>
                    <td class="head"><b> Title: </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ep_title; ?></td>
                    <td class="head"><b> Remarks:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ep_remarks; ?></td>
                    <td class="head"><b> Date:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ep_date; ?></td>
                    <td class="head">Customer :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $customers_name; ?></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                    <td class="head"></td>
                </tr>
            </table>
            <!-- Items Details -->
            <form method="GET" action="../commit/que/ep_commit_que.php">
                <input type="hidden" name="ep_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name='mov_date' class='date'>
                <table class="item-details">
                    <tr>
                        <th width="5%">Item No.</th>
                        <th width="30%">Item Name</th>
                        <th width="10%">Beg. Qty</th>
                        <th width="10%">Qty Out</th>
                        <th width="5%">Unit</th>
                        <th width="10%">Price</th>
                        <th width="10%">SubTotal Price</th>
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
                                <td><?php echo $count; ?></td>
                                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                                <td><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>
                                <td contenteditable="false">
                                    <font color="red"><input type="number" name="out_qty[]" value="<?php echo $irow['ep_qty'] ?>" style="border: none;"></font>
                                </td>
                                <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
                                <td contenteditable="false"><?php echo $irow['ep_price'] ?></td>
                                <td class="ep_totPrice"><input type="number" name="ep_totPrice[]" style="border: none" value="<?php echo $irow["ep_qty"] * $irow["ep_price"]; ?>" contenteditable="false"></td>

                            </tr>
                            <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                    <?php }
                    } ?>

                    </center>
                </table>
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