<?php

include_once 'header.php';
include 'php/stin_edit-inc.php';
?>


<link rel="stylesheet" href="css/po_edit-style.css">
<script defer src="js/stin_edit-script.js"></script>

<h1 style="float: left; margin-left: 50px">Stock Inventory IN: Editing Records</h1> <br><br><br>
<hr>
<form action="php/stin_edit-inc.php" method="POST">
    <div class='container--po__details'>

        <span class="po__label">
            STIN ID:
        </span>
        <input type="text" name="stinId" id="po_id" value="<?php echo str_pad($stinId, 8, 0, STR_PAD_LEFT) ?>" readonly>

        <span class="po__label">
            Prep. By:
        </span>
        <select name="empId">
            <option value="<?php echo $empId ?>"><?php echo $empName; ?></option>
            <?php
            include "config.php";
            $records = mysqli_query($db, "SELECT * FROM employee_tb ORDER BY emp_name ASC");

            while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['emp_id'] . "'>" . $data['emp_name'] . "</option>";
            }
            ?>
        </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="po__label">
            Remarks:
        </span>
        <textarea name="stinRemarks" cols="30" rows="3"><?php echo $stinRemarks; ?></textarea> <br>

        <span class="po__label">
            STIN CODE :
        </span>
        <input type="text" name="stinCode" id="po_terms" value="<?php echo $stinCode ?>">
        <span class=" po__label">
            STIN Title:
        </span>
        <input type="text" name="stinTitle" id="po_title" value="<?php echo $stinTitle ?>">

        <span class="po__label">
            STIN Date:
        </span>
        <input type="date" name="stinDate" id="po_date" value="<?php echo $stinDate ?>">


    </div>

    <div class="container--po__table">
        <button class="po__button button--insert__item">Add item</button>
        <table class='po__table'>
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Cost</th>
                    <th>Total Cost</th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody class='po__table--item'>

                <?php

                $limit = 0;

                while (count($productId) !== $limit) {
                    echo
                    "<tr>
         <td>$productId[$limit]</td>
         <td>$productName[$limit]</td>
         <td>" . number_format($qtyIn[$limit], 2) . "</td>
         <td>$unitName[$limit]</td>
         <td>" . number_format($itemPrice[$limit], 2) . "</td>
         <td>" . number_format($itemTotal[$limit], 2) . "</td>
         <td>
            <font color='red'><i class='fa fa-trash-o' style='font-size:26px'></i></font>
          </td>
         </tr>
         <input type='hidden' name='productId[]' value='$productId[$limit]'>
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]'>
         <input type='hidden' name='itemTotal[]' value='" . $itemPrice[$limit] * $qtyIn[$limit] . "'>
         ";

                    $limit++;
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="container--po__button">
        <button class="po__button button--po__update" name='updatestin'>Update</button>
        <button class="po__button button--po__cancel" name='cancelupdate'>Cancel</button>
    </div>
</form>


<div class="container--modal">
    <div class='modal--add__item'>

        <a href=""><button onclick="showadditem()" class="button--add__item">New Item</button></a>

        <input type="text" class='input--search' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Location</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody class='container--itemlist'>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'footer.php' ?>