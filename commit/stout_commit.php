<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];

  $result = mysqli_query($db, "SELECT stout_tb.stout_id,stout_tb.stout_code,stout_tb.stout_title,stout_tb.stout_date,employee_tb.emp_name 
  FROM stout_tb 
  LEFT JOIN employee_tb ON stout_tb.emp_id = employee_tb.emp_id
  WHERE stout_id=" . $_GET['id']);


  $row = mysqli_fetch_array($result);

  if ($row) {
    $id = $row['stout_id'];
    $stout_code = $row['stout_code'];
    $stout_title = $row['stout_title'];
    $emp_name = $row['emp_name'];
    $dateString = $row['stout_date'];
    $dateTimeObj = date_create($dateString);
    $date = date_format($dateTimeObj, 'm/d/y');
  } else {
    echo "No results!";
  }
}


?>
<?php include('../headerv2.php') ?>
<div class="container-sm">
  <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Stock-Out : Commiting Records <i class="bi bi-pencil"></i></h4>
    <hr>


    <div class="row">
      <div class="col-3">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-Out ID</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $stout_code ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-Out Code</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $stout_title ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Job-Order No.</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $emp_name ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Requested By</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $date ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-Out Date</label>
        </div>
      </div>
    </div>
    <form method="GET" action="../commit/que/stout_commit_que.php">
      <input type="hidden" name="stout_id" value="<?php echo $_GET['id'] ?>">
      <input type="hidden" name='mov_date' class='date'>
      <table class="table item-details">
        <tr>
          <th width="5%">Product ID</th>
          <th width="5%">Qty-Out</th>
          <th width="5%">Unit</th>
          <th width="40%">Item Name</th>
          <th width="20%">Item Remarks</th>
          <th width="10%">Barcode</th>
          <th width="10%" style="display: none;">Qty-On-Hand</th>
          <th width="10%" style="display: none;">Cost</th>
          <th width="10%" style="display: none;">Discount Amount</th>
          <th width="10%">Incomming Qty</th>
        </tr>

        <?php
        $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.cost, stout_product.stout_temp_qty, stout_product.stout_temp_disamount, product.barcode, stout_product.stout_temp_remarks
          FROM product 
          LEFT JOIN stout_product ON product.product_id = stout_product.product_id
          LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
          WHERE stout_product.stout_id='$id' ";

        $result = $db->query($sql);
        $count = 0;
        if ($result->num_rows >  0) {

          while ($irow = $result->fetch_assoc()) {

        ?>
            <tr>
              <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT); ?></td>
              <td contenteditable="false">
                <font color="red"><input type="number" name="out_qty[]" value="<?php echo $irow['stout_temp_qty'] ?>" style="border: none;" readonly></font>
              </td>
              <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
              <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
              <td contenteditable="false"><?php echo $irow['stout_temp_remarks'] ?></td>
              <td contenteditable="false">
                <?php
                if ($irow['barcode'] == "") {
                  echo "N/A";
                } else {
                  echo $irow['barcode'];
                }
                ?></td>
              <td style="display: none;"><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>


              <td contenteditable="false" style="display: none;"><?php echo $irow['cost'] ?></td>
              <td contenteditable="false" style="display: none;"><?php echo $irow['stout_temp_disamount'] ?></td>
              <td class="stout_temp_tot"><input type="number" name="stout_temp_tot[]" style="border: none" value="<?php echo $irow["qty"] - $irow["stout_temp_qty"]; ?>" readonly></td>

            </tr>
            <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
        <?php }
        } ?>

        </center>
      </table>
      <br>

      <button type="submit" name="submit" class="btn btn-primary">Commit Records</button>
      <a href="../stout_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
    </form>
  </div>



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