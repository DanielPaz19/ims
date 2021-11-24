<?php

include_once 'header.php';
include 'php/ep_edit-inc.php';
?>


<link rel="stylesheet" href="css/ep_edit-style.css">
<script defer src="js/ep_edit-script.js"></script>

<h1 style="float: left; margin-left: 50px">Exit Pass: Editing Records</h1> <br><br><br>
<hr>
<form action="php/ep_edit-inc.php" method="POST">
    <div class='container--details'>
        <span class="po__label">
            EP ID:
        </span>
        <input type="text" name="epId" id="id" class="textId" value="<?php echo str_pad($epId, 8, 0, STR_PAD_LEFT) ?>" readonly>
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
        </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="po__label">
            Remarks:
        </span>
        <textarea name="epRemarks" cols="30" rows="1"><?php echo $epRemarks; ?></textarea> <br>

        <span class="po__label">
            EP No. :
        </span>&nbsp;&nbsp;
        <input type="number" name="epNo" id="po_terms" value="<?php echo $epNo ?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <span class=" po__label">
            EP Title:
        </span>
        <input type="text" name="epTitle" id="po_title" value="<?php echo $epTitle ?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- <span class="po__label">
            Remarks:
        </span>
        <textarea name="epRemarks" cols="30" rows="3"><?php echo $epRemarks; ?></textarea> -->
        <span class="po__label">
            EP Date:
        </span>
        <input type="date" name="epDate" id="po_date" value="<?php echo $epDate ?>">


    </div>

    <div class="button__container--insert_item">
        <button class="edit__button edit__button--insert__item" style="float: right; margin-top:10px;margin-right:10px;margin-bottom:10px;">Add item</button>
        <div class="container--table">
            <table class='table'>
                <thead>
                    <tr style="text-align: left;">
                        <th>&nbsp;&nbsp;Item Code</th>
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
        <td class='td__edit td__edit--qty'>" . number_format($qtyIn[$limit], 2) . "</td>
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

            <button class="edit__button button--update" name='update'>Update</button>
            <button class="edit__button button--cancelupdate" name='cancelupdate'>Cancel</button>

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
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class='container--itemlist'>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'footer.php' ?>