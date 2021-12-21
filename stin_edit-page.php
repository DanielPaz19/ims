<?php

include_once 'header.php';
include 'php/stin_edit-inc.php';
?>


<link rel="stylesheet" href="css/stin_edit-style.css">
<script defer src="js/stin_edit-script.js"></script>

<h1>Edit Stock-in</h1>
<form action="php/stin_edit-inc.php" method="POST">
    <div class='container--details'>
        <a href="stin_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:midnightblue;" title="Exit"></i></a>
        <table>
            <tr>
                <td> <span class="input__label">
                        STIN ID:
                    </span>
                    <input type="text" name="stinId" id="id" class="textId" value="<?php echo str_pad($stinId, 8, 0, STR_PAD_LEFT) ?>" readonly>
                </td>
            </tr>
            <tr>
                <td><span class="input__label">
                        STIN Code:
                    </span>
                    <input type="text" name="stinCode" id="stin_code" value="<?php echo $stinCode ?>">
                </td>
                <td>
                    <span class="input__label">
                        STIN Title:
                    </span>
                    <input type="text" name="stinTitle" id="stin_title" value="<?php echo $stinTitle ?>">
                </td>

                <td> <span class="input__label">
                        Remarks:
                    </span>
                    <textarea name="stinRemarks" id="stin_remarks"><?php echo $stinRemarks ?></textarea>
                </td>
            </tr>
            <tr>
                <td> <span class="input__label input__label--employee">
                        TON By:
                    </span>&emsp;
                    <select name="employeeId" id="employee_name">
                        <option value=" <?php echo $empId ?>"><?php echo $empName ?></option>
                        // Show supplier name as options for Select input
                        <?php include 'php/render-select-employee.php' ?>
                    </select>
                </td>
                <td> <span class="input__label">
                        STIN Date:
                    </span>
                    <input type="date" name="stinDate" id="stin_date" value="<?php echo $stinDate ?>">
                </td>
            </tr>
        </table>


    </div>
    <div class="button__container--insert_item">

    </div>

    <div class="container--table">
        <button class="edit__button edit__button--insert__item" style="float: left; margin-bottom:5px"><i class="fa fa-plus"></i>&nbsp;Add item</button>
        <button class="edit__button button--update" name='update' style="float: right; margin-bottom:5px;  cursor: pointer;
   cursor: pointer;
  height: 50px;
  width: 150px;
  border-radius: 5px;
  background-color: midnightblue;
  color: #ffffff;
  font-size: 18px;
  letter-spacing: 2px;"><i class="fa fa-check" style="color:chartreuse;"></i>&nbsp;Update</button>
        <table class='table'>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th style="text-align:left;">Item Name</th>
                    <th>Qty-In</th>
                    <th>Unit</th>
                    <th>Cost</th>
                    <th>Total Cost</th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody class='table--item'>

                <?php
                $limit = 0;

                if (isset($productId)) {
                    while (count($productId) !== $limit) {
                        if ($productId[$limit] != 0) {
                            # code...
                            echo
                            "<tr>
                 <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
                 <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
                 <td class='td__edit td__edit--qty' style='text-align:center;'>" . $qtyIn[$limit] . "</td>
                 <td class='td__readonly td__readonly--unit' style='text-align:center;'>$unitName[$limit]</td>
                 <td class='td__edit td__edit--cost' style='text-align:center;'>" . number_format($itemCost[$limit], 2) . "</td>
                 <td class='td__compute td__compute--totalcost' style='text-align:center;'>" . number_format($itemCost[$limit] * $qtyIn[$limit], 2) . "</td>
                 <td class='td__edit td__edit--delete'>
                    <i class='fa fa-trash-o' style='font-size:26px'></i>
                  </td>
                  <input type='hidden' name='productId[]' value='$productId[$limit]' >
                  <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
                  <input type='hidden' name='itemCost[]' value='$itemCost[$limit]' class='input__edit input__edit--cost'>
                 </tr>
                 ";
                        }


                        $limit++;
                    }
                }
                ?>

                <!-- <tr>
                    <td class='td__readonly td__readonly--productid'>00000001</td>
                    <td class='td__readonly td__readonly--itemname'>Sample Item</td>
                    <td>100.00</td>
                    <td class='td__readonly td__readonly--unit'>pcs</td>
                    <td>100.00</td>
                    <td>1,000.00</td>
                    <td class='td__edit td__edit--delete'>
                        <i class='fa fa-trash-o' style='font-size:26px'></i>
                    </td>
                </tr>
                <tr>
                    <td class='td__readonly td__readonly--productid'>00000002</td>
                    <td class='td__readonly td__readonly--itemname'>Sample Item 2</td>
                    <td>100.00</td>
                    <td class='td__readonly td__readonly--productid'>pcs</td>
                    <td>100.00</td>
                    <td>1,000.00</td>
                    <td class='td__edit td__edit--delete'>
                        <i class='fa fa-trash-o' style='font-size:26px'></i>
                    </td>
                </tr> -->

            </tbody>
        </table>
    </div>
    <!-- <div class="container--edit__button">
        <button class="edit__button button--cancelupdate" name='cancelupdate'>Cancel</button>
        <button class="edit__button button--update" name='update'>Update</button>
    </div> -->
</form>


<div class="container--modal">
    <div class='modal--add__item'>

        <a href=""><button onclick="showadditemEDITV2()" class="button--add__item">New Item</button></a>

        <input type="text" class='input--search' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr>
                        <th>Product ID</th>
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