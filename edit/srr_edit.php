<?php

include('../php/config.php');

if (isset($_POST['srr_submit'])) {
    $id = $_POST['id'];
    $srr_no = mysqli_real_escape_string($db, $_POST['srr_no']);
    $emp_id = mysqli_real_escape_string($db, $_POST['emp_id']);
    $srr_qty = mysqli_real_escape_string($db, $_POST['srr_qty']);
    $sup_id = mysqli_real_escape_string($db, $_POST['sup_id']);
    $srr_date = mysqli_real_escape_string($db, $_POST['srr_date']);

    mysqli_query($db, "UPDATE srr_tb SET srr_no='$srr_no', emp_id='$emp_id'
                       WHERE srr_id='$id'");

    header("Location:../main/srr_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT   srr_tb.srr_id, srr_tb.srr_no, employee_tb.emp_name
                                FROM srr_tb
                                LEFT JOIN employee_tb ON srr_tb.emp_id = employee_tb.emp_id
                                WHERE srr_tb.srr_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['srr_id'];
        $srr_no = $row['srr_no'];
        $emp_id = $row['emp_id'];
    } else {
        echo "No results!";
    }
}
?>


<head>
    <title>PACC IMS</title>
    <link rel="shortcut icon" href="../img/pacclogo.png" />
    <link rel="stylesheet" href="../css/srr_edit.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body style="margin: 0px;" bgcolor="#B0C4DE">

    <div class="container">
        <a href="../main/srr_main.php" style="float: right;"><i class="fa fa-close" style="font-size:24px; color: red;"></i></a><br>
        <fieldset>
            <legend>&nbsp;&nbsp;&nbsp;Stock Reciept Register: Editing Record&nbsp;&nbsp;&nbsp;</legend>
            <button id="myBtn" title="Add Entry" style="font-size: 18px; padding: 8px; float:right;"><i class="fa fa-plus-circle"></i>&nbsp;Add Entry</button>
            <form autocomplete="off" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />

                <table class="table1" width="100%">
                    <tr>
                        <td style="width: 20%;"><b>
                                <font color='midnightblue'>Srr No:</font>
                            </b>
                            <input type="text" class="form-control" name="srr_no" value="<?php echo $_GET['srrNo'] ?>" style="height: 30px;">
                        </td>

                        <td style="width: 30%;"><b>
                                <font color='midnightblue'>Prepared By:</font>
                            </b>
                            <select name="emp_id" class="select--emp" style="height: 30px;">
                                <option value="<?php echo $_GET['empId'] ?>"><?php echo $_GET['empName']; ?></option>
                                <?php
                                $records = mysqli_query($db, "SELECT * FROM employee_tb ");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['emp_id'] . "'>" . $data['emp_name'] . "</option>";
                                }
                                ?>

                            </select>
                        </td>
                        <td style="width: 30%;"></td>

                    </tr>

                </table>

                <br>
                <table width="100%" class="itemtb">
                    <tr>
                        <th width="10%">DATE</th>
                        <th width="30%">SUPPLIER</th>
                        <th width="10%">REF NO.</th>
                        <th width="20%">DESCRIPTION</th>
                        <th width="10%">QTY</th>
                        <th width="10%">UNIT</th>
                        <th width="10%">Remarks</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT  srr_product.srr_date, sup_tb.sup_name, srr_product.srr_ref, product.product_name, srr_product.srr_qty, unit_tb.unit_name, product.pro_remarks

   				 FROM srr_product
   				 LEFT JOIN sup_tb ON srr_product.sup_id = sup_tb.sup_id
   				 LEFT JOIN product ON srr_product.product_id = product.product_id
   				 LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id

   				 WHERE srr_product.srr_id=" . $_GET['id'];

                        $result = $db->query($sql);
                        $count = 0;
                        if ($result->num_rows >  0) {

                            while ($irow = $result->fetch_assoc()) {
                                $count = $count + 1;
                        ?>
                                <td><?php echo $irow['srr_date'] ?></td>
                                <td><?php echo $irow['sup_name'] ?></td>
                                <td><?php echo $irow['srr_ref'] ?></td>
                                <td><?php echo $irow['product_name'] ?></td>
                                <td><?php echo $irow['srr_qty'] ?></td>
                                <td><?php echo $irow['unit_name'] ?></td>
                                <td><?php echo $irow['pro_remarks'] ?></td>
                                <td> <a href="#" title="Remove">
                                        <font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
                                    </a></td>

                    </tr>
            <?php }
                        } ?>
                </table>
                <br>
                <button class="butLink" name="srr_submit" onclick="alert('Edit Records Successfully !')">Update</button>
            </form>
            <br>
        </fieldset>
        <!-- EDIT PO END -->
    </div>



    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" title="close">&times;</span><br>
            </div>
            <div class="modal-body">
                <div class="addCont">
                    <div id="search">
                        <label>Description:&nbsp;&nbsp;</label>
                        <input type="text" name="item" id="item-name" style="height: 30px;" placeholder=" 🔍 Search item here ......." />
                        <div id="item-list"></div><!-- Dont Remove this -->
                    </div>

                    <br>
                    <!-- input for item qty -->
                    <label>Quantity: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input name="srr_qty" class="item-qty" type="number" placeholder="Quantity" value="1" />

                    <!-- input for refno -->

                    <label>Reference No.&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input name="srr_ref" class="item-ref" type="text" style="height: 30px;" />
                    <br /><br />
                    <!-- input for supplier -->
                    <label>Supplier: &nbsp;&nbsp;</label>
                    <select name="sup_id" class="item-sup" style="width:auto; height: 26px; height: 30px;">
                        <option></option>
                        <?php
                        include "../../php/config.php";
                        $records = mysqli_query($db, "SELECT * FROM sup_tb");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['sup_id'] . "'>" . $data['sup_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <!-- input for date -->
                    <label>Date&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input name="srr_date" class="item-date" type="date" style="height: 30px;" /> <br><br>

                    <button class="add-button" title="Add Item"><i class="fa fa-plus"></i>&nbsp; Add</button>
                </div>
            </div>
        </div>

    </div>

    </div>




    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>