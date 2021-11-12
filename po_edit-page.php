<?php

include_once 'header.php';
include 'php/po_edit-inc.php';
?>


<link rel="stylesheet" href="css/po_edit-style.css">
<script defer src="js/po_edit-script.js"></script>

<h1>Edit Purchase Order</h1>
<form action="php/po_edit-inc.php" method="POST">
  <div class='container--po__details'>
    <span class="po__label">
      PO ID:
    </span>
    <input type="text" name="poId" id="po_id" class="textId" value="<?php echo str_pad($poId, 8, 0, STR_PAD_LEFT) ?>" readonly>
    <span class="po__label">
      Supplier Name:
    </span>
    <select name="supplierId" id="supplier_name">
      <option value=" <?php echo $supId ?>"><?php echo $supName ?></option>
      <?php include 'php/render-supplier.php' ?>

    </select>
    <span class=" po__label">
      PO Title:
    </span>
    <input type="text" name="poTitle" id="po_title" value="<?php echo $poTitle ?>"><br>
    <span class="po__label">
      Terms:
    </span>
    <input type="text" name="poTerms" id="po_terms" value="<?php echo $poTerms ?>">
    <span class="po__label">
      Remarks:
    </span>
    <input type="text" name="poRemarks" id="po_remarks" value="<?php echo $poRemarks ?>">
    <span class="po__label">
      PO Date:
    </span>
    <input type="date" name="poDate" id="po_date" value="<?php echo $poDate ?>">

    <button class="po__button button--insert__item">Add item</button>
  </div>

  <div class="container--po__table">
    <table class='po__table'>
      <thead>
        <tr>
          <th>Item Code</th>
          <th>Item Name</th>
          <th>Qty-In</th>
          <th>Unit</th>
          <th>Cost</th>
          <th>Total Cost</th>
          <th>%Discount</th>
          <th>Dscnt. Val.</th>
          <th>Sub-total</th>
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
         <td class='td__edit td__edit--qty'>" . number_format($qtyIn[$limit], 2) . "</td>
         <td>$unitName[$limit]</td>
         <td class='td__edit td__edit--cost'>" . number_format($itemCost[$limit], 2) . "</td>
         <td class='td__compute td__compute--totalcost'>" . number_format($itemCost[$limit] * $qtyIn[$limit], 2) . "</td>
         <td class='td__edit td__edit--discpercent'>" . number_format($itemDiscpercent[$limit], 2) . "</td>
         <td class='td__compute td__compute--discount'>" . number_format($itemDisamount[$limit], 2) . "</td>
         <td class='td__compute td__compute--subtotal'>" . number_format($itemTotal[$limit], 2) . "</td>
         <td class='td__edit td__edit--delete'>
            <i class='fa fa-trash-o' style='font-size:26px'></i>
          </td>
          <input type='hidden' name='productId[]' value='$productId[$limit]' >
          <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
          <input type='hidden' name='itemCost[]' value='$itemCost[$limit]' class='input__edit input__edit--cost'>
          <input type='hidden' name='itemDiscpercent[]' value='$itemDiscpercent[$limit]' class='input__edit input__edit--discpercent'>
          <input type='hidden' name='itemDisamount[]' value='$itemDisamount[$limit]' class='input__edit input__edit--discount'>
          <input type='hidden' name='itemTotal[]' value='" . $itemCost[$limit] * $qtyIn[$limit] . "' class='input__edit input__edit--total'>
         </tr>
         ";

          $limit++;
        }
        ?>

      </tbody>
    </table>
  </div>
  <div class="container--po__button">
    <button class="po__button button--po__update" name='updatepo'>Update</button>
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