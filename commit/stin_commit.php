<?php
include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];

  $result = mysqli_query($db, "SELECT stin_tb.stin_id,stin_tb.stin_code,stin_tb.stin_title,stin_tb.stin_date, employee_tb.emp_name
   FROM stin_tb
   LEFT JOIN employee_tb On employee_tb.emp_id = stin_tb.emp_id
    WHERE stin_id=" . $_GET['id']);


  $row = mysqli_fetch_array($result);

  if ($row) {
    $id = $row['stin_id'];
    $stin_code = $row['stin_code'];
    $stin_title = $row['stin_title'];
    $dateString = $row['stin_date'];
    $emp_name = $row['emp_name'];
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
    <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Stock-In : Commiting Records <i class="bi bi-pencil"></i></h4>
    <hr>
    <div class="row">
      <div class="col-3">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-In ID</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $stin_code ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-In Code</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $stin_title ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Job-Order No.</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $emp_name ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Prepared By</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" value="<?php echo $date ?>" style="cursor:not-allowed" readonly>
          <label for="floatingInput">Stock-In Date</label>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <form method="GET" action="../commit/que/stin_commit_que.php">
        <input type="hidden" name="stin_id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name="mov_date" class="date">
        <table class="table">
          <tr style="text-align: left;background-color:#0d6efd;color:white">
            <th width="10%">ID</th>
            <th width="55%">Item Name</th>
            <th width="10%">Barcode</th>
            <th width="10%">On-Hand</th>
            <th width="10%">Qty-In</th>
            <th width="5%">Unit</th>
            <th width="10%">Incomming Qty</th>
          </tr>
          <?php
          include "../php/config.php";
          $sql = "SELECT stin_tb.stin_id, product.product_id,product.product_name,product.qty,stin_product.stin_temp_qty,unit_tb.unit_name,product.cost,
          stin_product.stin_temp_disamount, product.barcode
          FROM stin_product 
          LEFT JOIN product ON product.product_id = stin_product.product_id
          LEFT JOIN stin_tb ON stin_product.stin_id=stin_tb.stin_id
          LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
          WHERE stin_product.stin_id='$id'";

          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {

            while ($irow = $result->fetch_assoc()) {

          ?>
              <tr>
                <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT); ?></td>
                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                <td contenteditable="false">
                  <?php
                  if ($irow['barcode'] == "") {
                    echo "N/A";
                  } else {
                    echo $irow['barcode'];
                  }
                  ?></td>
                <td style="text-align: right;"><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;width:100%" readonly></td>
                <td contenteditable=" false">
                  <font color="red"><input type="number" name="in_qty[]" value="<?php echo $irow['stin_temp_qty'] ?>" style="border: none;text-align:left:100%"></font>
                </td>
                <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
                <td class="stin_temp_tot"><input type="number" style="border: none" name="stin_temp_tot[]" value="<?php echo $irow["qty"] + $irow["stin_temp_qty"]; ?>" contenteditable="false"></td>

              </tr>
              <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
          <?php }
          } ?>

        </table>

    </div>
    <div class="row pull-right">
      <div class="col">
        <button type="submit" name="submit" class="btn btn-success">Commit Records</button>
        <a href="../stin_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
      </div>
    </div>

    </form>
  </div>
</div>

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
<?php include('../footer.php') ?>