<?php

include_once 'header.php';
include 'php/ol_edit-inc.php';
?>


<link rel="stylesheet" href="css/ep_edit-style.css">
<script defer src="js/ol_edit-script.js"></script>

<h1 style="float: left; margin-left: 50px">Online Transactions: Editing Records</h1> <br><br><br>
<hr>
<form action="php/ol_edit-inc.php" method="POST">
    <div class='container--details'>
        <a href="ol_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:midnightblue;" title="Exit"></i></a>
        <span class="po__label">
            OL ID:
        </span>
        <input type="text" name="olId" id="id" class="textId" value="<?php echo str_pad($olId, 8, 0, STR_PAD_LEFT) ?>" readonly>
        <br>
        <span class="po__label">
            Sales type:
        </span>
        <select name="oltypeId" style="width: 180px;">
            <option value="<?php echo $oltypeId ?>"><?php echo $olTypeName; ?></option>
            <?php
            include "config.php";
            $records = mysqli_query($db, "SELECT * FROM ol_type ORDER BY ol_type_name ASC");

            while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['ol_type_id'] . "'>" . $data['ol_type_name'] . "</option>";
            }
            ?>
        </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <span class=" po__label">
            OL Title:
        </span>
        <input type="text" name="olTitle" id="po_title" value="<?php echo $olTitle ?>">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- <span class="po__label">
            Remarks:
        </span>
        <textarea name="epRemarks" cols="30" rows="3"><?php echo $epRemarks; ?></textarea> -->
        <span class="po__label">
            OL Date:
        </span>
        <input type="date" name="olDate" id="po_date" value="<?php echo $olDate ?>">


    </div>

    <div class="button__container--insert_item">

        <div class="container--table">
            <button class="edit__button edit__button--insert__item" style="float: left; margin-bottom:5px;"><i class="fa fa-plus"></i>&nbsp;Add item</button>
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
                    $total = $itemPrice[$limit] * $qtyIn[$limit];

                    if (isset($productId)) {
                        while (count($productId) !== $limit) {
                            if ($productId[$limit] != 0) {
                                $total = $itemPrice[$limit] * $qtyIn[$limit];
                                # code...
                                echo
                                "<tr style='text-align:left;'>
        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
        <td class='td__readonly td__readonly--unit'>$unitName[$limit]</td>
        <td class='td__edit td__edit--cost'>" . number_format($itemPrice[$limit], 2) . "</td>
        <td class='td__compute td__compute--totalcost'>" . number_format($total, 2) . "</td>
        <td class='td__edit td__edit--delete'>
        <i class='fa fa-trash-o' style='font-size:26px'></i>
      </td>
         <input type='hidden' name='productId[]' value='$productId[$limit]' >
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]' class='input__edit input__edit--cost'>
         <input type='hidden' name='itemTotal[]' value='$total' class='input__edit input__edit--total'>
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
        <span class='close--modal'><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr style="text-align: center;">
                        <th>Product ID</th>
                        <th>Item Name</th>
                        <th>Qty-On-Hand</th>
                        <th>Barcode</th>
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