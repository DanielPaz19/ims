<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<?php include('../main_header_v2.php'); ?>

<div style="padding: 2%;">
  <div class="row">
    <div class="col-5">
      <div style="padding: 2%;background-color:aliceblue">
        <p style="padding: 3%;font-weight:bold;color:#0d6efd">NEW UNIT</p>
        <form method="POST" action="addunit_con.php">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="unit_name" required>
            <label for="floatingInput">Unit Name</label>
          </div>
          <button class="btn btn-success" name="addUnit">Save Unit</button>
        </form>
      </div>
    </div>
    <div class="col-7">
      <div style="padding: 2%;background-color:aliceblue">
        <table class="table table-hover" width="100%">
          <tr style="background-color:#0d6efd;color:white">
            <th>Unit ID</th>
            <th>Unit Name</th>
          </tr>
          <?php
          include('../php/config.php');
          $sql = "SELECT * FROM unit_tb";
          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {
            while ($row = $result->fetch_assoc()) {
              $id = $row["unit_id"];
              $count = $count + 1;
          ?>
              <tr>
                <td><?php echo str_pad($row["unit_id"], 8, 0, STR_PAD_LEFT) ?></td>
                <td><?php echo $row["unit_name"] ?></td>
              </tr>
          <?php }
          } ?>
        </table>
      </div>
    </div>
  </div>
</div>

</html>