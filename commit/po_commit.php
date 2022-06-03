<?php
include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];

  $result = mysqli_query($db, "SELECT po_tb.po_code, po_tb.po_title, po_tb.po_date, po_tb.po_remarks, sup_tb.sup_id, po_tb.po_id, sup_tb.sup_name, sup_tb.sup_address, po_tb.po_terms, sup_tb.sup_tin, po_type.po_type_name
  FROM sup_tb 
  LEFT JOIN po_tb ON sup_tb.sup_id = po_tb.sup_id  
  LEFT JOIN po_type ON po_type.po_type_id = po_tb.po_type_id

  WHERE po_tb.po_id=" . $_GET['id']);


  $row = mysqli_fetch_array($result);

  if ($row) {
    $id = $row['po_id'];
    $po_code = $row['po_code'];
    $dateString = $row['po_date'];
    $dateTimeObj = date_create($dateString);
    $date = date_format($dateTimeObj, 'm/d/y');
    $po_title = $row['po_title'];
    $po_remarks = $row['po_remarks'];
    $sup_name = $row['sup_name'];
    $sup_address = $row['sup_address'];
    $sup_tin = $row['sup_tin'];
    $po_terms = $row['po_terms'];
    $po_type = $row['po_type_name'];
  } else {
    echo "No results!";
  }
}


?>
<?php include('../headerv2.php') ?>


<!-- VIEW PO END -->
<div style="padding: 2%;">
  <div class="shadow p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Purchase-Order : Commiting Records <i class="bi bi-pencil"></i></h4>
    <hr>
    <div class="row">
      <div class="row">
        <div class="col-4">
          <div class="form-floating mb-3">
            <input type="text" id="id" class="form-control" name="poId" value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?>" readonly>
            <label for="floatingInput">Purchase-Order ID</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $po_code ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Purchase-Order Code</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $po_title ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Purchase-Order Title</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $po_terms ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Purchase-Order Terms</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $date ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Purchase-Order Date</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating">
            <textarea class="form-control" id="floatingTextarea" style="cursor:not-allowed" readonly><?php echo $po_remarks ?></textarea>
            <label for="floatingTextarea">Purchase-Order Remarks</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $sup_name ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Supplier</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" value="<?php echo $po_type ?>" style="cursor:not-allowed" readonly>
            <label for="floatingInput">Purchase-Order Type</label>
          </div>
        </div>
      </div>
      <br>
      <hr>
      <br>
      <form method="GET" action="../commit/que/po_commit_que.php">
        <input type="hidden" name="po_id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name='mov_date' class='date'>
        <div class="row">
          <div class="col-7"></div>
          <div class="col-5">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" name="rec_date" required>
              <label for="floatingInput">Recieving Date</label>
            </div>
          </div>
        </div>
        <table class="table">
          <tr>
            <th width="10%">Product ID</th>
            <th width="30%">Item Name</th>
            <th width="10%">Beg. Qty</th>
            <th width="10%">Qty-Recieved</th>
            <th width="10%">Qty-Order</th>
            <th width="3%">Unit</th>
            <th width="10%">Cost</th>
            <th width="10%">Total Cost</th>
            <th width="10%">Discount Amount</th>
            <th width="10%">Incomming-Qty</th>
          </tr>
          <?php
          $sql = "SELECT po_product.po_id, product.product_id ,product.product_name, product.qty, po_product.item_qtyorder, unit_tb.unit_name, product.cost, po_product.item_disamount 
                                  FROM product
                                  LEFT JOIN po_product
                                  ON product.product_id = po_product.product_id
                                  LEFT JOIN unit_tb
                                  ON product.unit_id = unit_tb.unit_id
                                  WHERE po_product.po_id = '$id' ";

          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {

            while ($irow = $result->fetch_assoc()) {
              $count = $count + 1;
          ?>
              <tr>

                <td contenteditable="false"><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT) ?></td>
                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                <td><input type="number" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;width:100px" readonly></td>
                <td contenteditable="false"><input style="border:none;width:100px;text-align:right" type="number" name="in_qty[]" value="<?php echo $irow['item_qtyorder'] ?>" readonly></td>
                <td contenteditable="true"><?php echo $irow['item_qtyorder'] ?></td>
                <td contenteditable="true"><?php echo $irow['unit_name'] ?></td>
                <td contenteditable="true"><?php echo $irow['cost'] ?></td>
                <td class="item_totcost"><input type="number" name="item_totcost[]" style="border: none;width:100px;" value="<?php echo $irow["item_qtyorder"] * $irow["cost"]; ?>" contenteditable="false"></td>
                <td contenteditable="true"><?php echo $irow['item_disamount'] ?></td>
                <td class="po_temp_tot"><input type="number" name="po_temp_tot[]" style="border: none;" value="<?php echo $irow["qty"] + $irow["item_qtyorder"]; ?>" contenteditable="false"></td>
              </tr>
              <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
          <?php }
          } ?>

        </table>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Commit Records</button>
        <a href="../po_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
      </form>


    </div>
  </div>


  <!-- Items Details -->


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