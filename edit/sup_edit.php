<?php

include('../php/config.php');

if (isset($_POST['sup_submit'])) {
  $id = $_POST['id'];
  $sup_name = mysqli_real_escape_string($db, $_POST['sup_name']);
  $sup_conper = mysqli_real_escape_string($db, $_POST['sup_conper']);
  $sup_tel = mysqli_real_escape_string($db, $_POST['sup_tel']);
  $sup_address = mysqli_real_escape_string($db, $_POST['sup_address']);
  $sup_email = mysqli_real_escape_string($db, $_POST['sup_email']);
  $sup_tin = mysqli_real_escape_string($db, $_POST['sup_tin']);
  $tax_type_id = mysqli_real_escape_string($db, $_POST['tax_type_id']);




  mysqli_query($db, "UPDATE sup_tb SET sup_name='$sup_name', sup_conper='$sup_conper' ,sup_tel='$sup_tel' ,sup_address='$sup_address' ,sup_email='$sup_email', sup_tin='$sup_tin', tax_type_id='$tax_type_id' WHERE sup_id='$id'");


  echo
  '<script>
alert("Successfully updated!");
location.href = "sup_edit.php?id=' . $id . '";
</script>';
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];
  $result = mysqli_query($db, "SELECT * FROM sup_tb INNER JOIN tax_type_tb ON tax_type_tb.tax_type_id = sup_tb.tax_type_id WHERE sup_id=" . $_GET['id']);

  $row = mysqli_fetch_array($result);

  if ($row) {

    $id = $row['sup_id'];
    $sup_name = $row['sup_name'];
    $sup_conper = $row['sup_conper'];
    $sup_tel = $row['sup_tel'];
    $sup_address = $row['sup_address'];
    $sup_email = $row['sup_email'];
    $sup_tin = $row['sup_tin'];
    $tax_type_id = $row['tax_type_id'];
    $tax_type_name = $row['tax_type_name'];
  } else {
    echo "No results!";
  }
}
?>



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier: Editing Records </title>
</head>
<?php include('../main_header_v2.php'); ?>

<div class="container-sm mt-2">
  <a class="back-button" href="../sup_main.php">
    <p class="mt-3" style="float:right;padding:2%"><i class="bi bi-backspace"></i> Back to Supplier</p>
  </a>
  <div class="shadow-lg p-5 mb-5 bg-rounded" style="background-color: white;border: 5px solid #cce0ff">
    <h3 style="color: #0d6efd;"><i class="bi bi-people-fill"></i> Supplier: Editing Records</h3>
    <hr>
    <form method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_name" value="<?php echo $sup_name; ?>">
            <label for="floatingInput">Supplier Name</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_conper" value="<?php echo $sup_conper; ?>">
            <label for="floatingInput">Contact Person</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_tel" value="<?php echo $sup_tel; ?>">
            <label for="floatingInput">Telephone</label>
          </div>
        </div>
        <div class="col-9">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_address" value="<?php echo $sup_address; ?>">
            <label for="floatingInput">Address</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="sup_email" value="<?php echo $sup_email; ?>">
            <label for="floatingInput">Email</label>
          </div>
        </div>
        <div class="col-5">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_tin" value="<?php echo $sup_tin; ?>">
            <label for="floatingInput">Tin No.</label>
          </div>
        </div>
        <div class="col-4">
          <div class="form-floating  mb-3">
            <select class="form-select" id="sel1" name="tax_type_id">
              <option value="<?php echo $tax_type_id ?>"><?php echo $tax_type_name; ?></option>
              <?php
              include "php/config.php";
              $records = mysqli_query($db, "SELECT * FROM tax_type_tb");

              while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['tax_type_id'] . "'>" . $data['tax_type_name'] . "</option>";
              }
              ?>
            </select>
            <label for="sel1" class="form-label">Tax Type</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <button type="submit" class="btn btn-success" name="sup_submit">Update Record</button>
        </div>
      </div>
    </form>
  </div>
</div>