<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Location</title>

</head>

<?php include('../main_header_v2.php'); ?>

<div style="padding:2%">
  <div class="row">
    <div class="col-4">
      <div style="padding: 2%;background-color:aliceblue">
        <p style="padding: 3%;font-weight:bold;color:#0d6efd">NEW LOCATION</p>
        <form method="POST" action="addlocation_con.php">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="loc_name" required">
            <label for="floatingInput">Location</label>
          </div>
          <button name="addLoc" class="btn btn-success mb-3" style="width: 100%;">Save Location</button>
        </form>
      </div>
    </div>
    <div class="col-8">
      <div style="padding: 2%;background-color:aliceblue">
        <?php include('../table/addlocation_table.html') ?>
      </div>
    </div>
  </div>
</div>

</html>