<?php

include_once 'header.php';
include 'php/jo_edit-inc.php';
?>


<link rel="stylesheet" href="css/jo_edit-style.css">
<script defer src="js/jo_edit-script.js"></script>

<h1 style="float: left; margin-left: 50px">Job Order: Editing Records</h1> <br><br><br>
<hr>
<form action="php/jo_edit-inc.php" method="POST">
    <div class='container--details'>
        <a href="jo_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:midnightblue;" title="Exit"></i></a>
        <span class="po__label">
            JO ID:
        </span>
        <input type="text" name="joId" id="id" class="textId" value="<?php echo str_pad($joId, 8, 0, STR_PAD_LEFT) ?>" readonly>
        <br>


        <span class="po__label">
            Jo No. :
        </span>&nbsp;&nbsp;
        <input type="text" name="joNo" id="po_terms" value="<?php echo $joNo ?>">
        &nbsp;&nbsp;&nbsp;&nbsp;

        <span class="po__label">
            JO Date:
        </span>
        <input type="date" name="joDate" id="po_date" value="<?php echo $joDate ?>">
        <span class="po__label">
            JO Type:
        </span>
        <select name="jo_type_id" style="width: 250px; height: 26px; border: 1px solid gray;">

            <option value="<option value=" <?php echo $jo_type_id ?>"><?php echo $jo_type_name ?></option>

            <?php
            include "config.php";
            $records = mysqli_query($db, "SELECT * FROM jo_type ORDER BY jo_type_id ASC");

            while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['jo_type_id'] . "'>" . $data['jo_type_name'] . "</option>";
            }
            ?>
        </select>
        <br>
        <span class="po__label">
            Customer:
        </span>
        <select name="customerId">
            <option value="<?php echo $customerId ?>"><?php echo $customerName; ?></option>
            <?php
            include "config.php";
            $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name ASC");

            while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
            }
            ?>
        </select>

    </div>

    <div class="button__container--insert_item">

        <div class="container--table">
            <button class="edit__button edit__button--insert__item" style="float: left; margin-bottom:5px"><i class="fa fa-plus"></i>&nbsp;Add item</button>
            <!-- <button class="edit__button button--cancelupdate" name='cancelupdate' style="float: right; margin-bottom:5px;  cursor: pointer;
  height: 50px;
  width: 100px;
  border-radius: 5px;
  background-color: midnightblue;
  color: #ffffff;">Cancel</button> -->
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
                    <tr style="text-align: left;">
                        <th>&nbsp;&nbsp;Product ID</th>
                        <th>&nbsp;&nbsp;Item Name</th>
                        <th>&nbsp;&nbsp;Qty</th>
                        <th>&nbsp;&nbsp;Unit</th>
                        <th>&nbsp;&nbsp;Price</th>
                        <th>&nbsp;&nbsp;Total Price</th>
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
                                "<tr style='text-align:left;'>
        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
        <td class='td__readonly td__readonly--unit'>$unitName[$limit]</td>
        <td class='td__edit td__edit--cost'>" . number_format($itemPrice[$limit], 2) . "</td>
        <td class='td__compute td__compute--totalcost'>" . number_format($itemPrice[$limit] * $qtyIn[$limit], 2) . "</td>
        <td class='td__edit td__edit--delete'>
        <i class='fa fa-trash-o' style='font-size:26px'></i>
      </td>
         <input type='hidden' name='productId[]' value='$productId[$limit]' >
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]' class='input__edit input__edit--cost'>
         </tr>
         ";
                            }
                            $limit++;
                        }
                    }

                    ?>

                </tbody>
            </table>
        </div>
        <div class="container--edit__button">



        </div>
</form>


<div class="container--modal">
    <div class='modal--add__item'>


        <input type="text" class='input--search' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr>
                        <th style="text-align: center;">Product ID</th>
                        <th style="text-align: center;">Item Name</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Unit</th>
                        <th style="text-align: center;">Location</th>
                        <th style="text-align: center;">Price</th>
                    </tr>
                </thead>
                <tbody class='container--itemlist'>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'footer.php' ?>