<?php

include_once 'headerv2.php';
include 'php/po_edit-inc.php';
?>

<link rel="stylesheet" href="css/po_edit-style.css">
<script defer src="js/po_edit-script.js"></script>

<div style="padding: 2%;">
  <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
    <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Purchase-Order: Editing Records <i class="bi bi-pencil"></i></h4>
    <hr>
    <form action="php/po_edit-inc.php" method="POST">
      <div class="row">
        <div class="col-4">
          <div class="form-floating mb-3">
            <input type="text" id="po_id" class="form-control" name="poId" value="<?php echo str_pad($poId, 8, 0, STR_PAD_LEFT) ?>" readonly>
            <label for="floatingInput">Purchase-Order ID</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="poCode" value="<?php echo $poCode ?>">
            <label for="floatingInput">Purchase-Order Code</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="poTitle" value="<?php echo $poTitle ?>">
            <label for="floatingInput">Purchase-Order Title</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="poTerms" value="<?php echo $poTerms ?>">
            <label for="floatingInput">Purchase-Order Terms</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="refNum" value="<?php echo $refNum ?>">
            <label for="floatingInput">Reference No.</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" name="poDate" value="<?php echo $poDate ?>">
            <label for="floatingInput">Purchase-Order Date</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating">
            <textarea class="form-control" id="floatingTextarea" name="poRemarks"><?php echo $poRemarks ?></textarea>
            <label for="floatingTextarea">Purchase-Order Remarks</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="supplierId">
              <option value="<?php echo $supId ?>"><?php echo $supName; ?></option>
              <?php
              include "config.php";
              $records = mysqli_query($db, "SELECT * FROM sup_tb ORDER BY sup_name ASC");

              while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['sup_id'] . "'>" . $data['sup_name'] . "</option>";
              }
              ?>
            </select>
            <label for="floatingSelect">Supplier</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="po_type_id">
              <option value=" <?php echo $po_type_id ?>"><?php echo $po_type_name ?></option>
              <?php
              include "config.php";
              $records = mysqli_query($db, "SELECT * FROM po_type ORDER BY po_type_id ASC");

              while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['po_type_id'] . "'>" . $data['po_type_name'] . "</option>";
              }
              ?>
            </select>
            <label for="floatingSelect">Purchase-Order Type</label>
          </div>
        </div>
      </div>
      <br>
      <hr>
      <div class="button__container--insert_item">
        <!-- <button class="po__button button--insert__item">Add item</button> -->
      </div>

      <div class="container--po__table">

        <div class="row">
          <div class="col">
            <h5>Product Table</h5>
          </div>
          <div class="col"> <button class="po__button button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
          </div>
        </div>
        <table class='po__table table'>
          <thead>
            <tr style="text-align: left;background-color:#0d6efd;color:white">
              <th>Product ID</th>
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
          <tbody class=' po__table--item'>

            <?php
            $limit = 0;

            if (isset($productId)) {
              while (count($productId) !== $limit) {
                if ($productId[$limit] != 0) {
                  echo
                  "<tr>
             <td class='td__readonly td__readonly--productid'>$productId[$limit]</td>
             <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
             <td class='td__edit td__edit--qty'>" . number_format($qtyIn[$limit], 2) . "</td>
             <td >$unitName[$limit]</td>
             <td class='td__edit td__edit--cost'>" . number_format($itemCost[$limit], 2) . "</td>
             <td class='td__compute td__compute--totalcost'>" . number_format($itemCost[$limit] * $qtyIn[$limit], 2) . "</td>
             <td class='td__edit td__edit--discpercent'>" . number_format($itemDiscpercent[$limit], 2) . "</td>
             <td class='td__compute td__compute--discount'>" . number_format($itemDisamount[$limit], 2) . "</td>
             <td class='td__compute td__compute--subtotal'>" . number_format($itemTotal[$limit], 2) . "</td>
             <td class='td__edit td__edit--delete'>
             <i class='bi bi-x-circle' style='font-size:22px' title='Delete'></i>
              </td>
              <input type='hidden' name='productId[]' value='$productId[$limit]' >
              <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
              <input type='hidden' name='itemCost[]' value='$itemCost[$limit]' class='input__edit input__edit--cost'>
              <input type='hidden' name='itemDiscpercent[]' value='$itemDiscpercent[$limit]' class='input__edit input__edit--discpercent'>
              <input type='hidden' name='itemDisamount[]' value='$itemDisamount[$limit]' class='input__edit input__edit--discount'>
              <input type='hidden' name='itemTotal[]' value='" . $itemCost[$limit] * $qtyIn[$limit] . "' class='input__edit input__edit--total'>
             </tr>
             ";
                }

                $limit++;
              }
            }
            ?>

          </tbody>
        </table>

        <div class="pull-right">
          <button class="po__button button--po__update btn btn-success" name='updatepo'><i class="bi bi-check2-circle"></i> Update Records</button>
          <a href="po_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
        </div>
    </form>
    <br>
  </div>
</div>



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