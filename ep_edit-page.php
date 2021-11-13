<?php

include_once 'header.php';
include 'php/ep_edit-inc.php';
?>


<link rel="stylesheet" href="css/po_edit-style.css">
<script defer src="js/ep_edit-script.js"></script>

<h1 style="float: left; margin-left: 50px">Exit Pass: Editing Records</h1> <br><br><br>
<hr>
<form action="php/ep_edit-inc.php" method="POST">
    <div class='container--po__details'>

        <span class="po__label">
            EP ID:
        </span>
        <input type="text" name="epId" id="po_id" class="textId" value="<?php echo str_pad($epId, 8, 0, STR_PAD_LEFT) ?>" readonly>

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
        <span class="po__label">
            Remarks:
        </span>
        <textarea name="epRemarks" cols="30" rows="3"><?php echo $epRemarks; ?></textarea> <br>

        <span class="po__label">
            EP No. :
        </span>
        <input type="number" name="epNo" id="po_terms" value="<?php echo $epNo ?>">
        <span class=" po__label">
            EP Title:
        </span>
        <input type="text" name="epTitle" id="po_title" value="<?php echo $epTitle ?>">
        <!-- <span class="po__label">
            Remarks:
        </span>
        <textarea name="epRemarks" cols="30" rows="3"><?php echo $epRemarks; ?></textarea> -->
        <span class="po__label">
            EP Date:
        </span>
        <input type="date" name="epDate" id="po_date" value="<?php echo $epDate ?>">


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
                    <th>Price</th>
                    <th>Total Price</th>
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
        <button class="po__button button--po__update" name='updateep'>Update</button>
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