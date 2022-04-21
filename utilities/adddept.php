<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Department</title>
  <link rel="stylesheet" href="../source/css/bootstrap.min.css">
  <script src="../source/js/bootstrap.min.js"></script>
</head>
<?php include('../main_header_v2.php'); ?>


<div style="padding:2%">

  <div class="row">
    <div class="col-4">
      <div style="padding: 2%;background-color:aliceblue">
        <form method="GET" action="adddept_con.php">
          <p style="padding: 3%;font-weight:bold;color:#0d6efd">NEW DEPARTMENT</p>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="dept_name" required>
            <label for="floatingInput">Department</label>
          </div>
          <button class="btn btn-success" name="addDept">Save Department</button>
        </form>
      </div>
    </div>
    <div class="col-8">
      <div style="padding: 2%;background-color:aliceblue">
        <table class="table table-hover table-sm" width="100%" style="cursor:pointer;">
          <tr style="background-color:#0d6efd;color:white">
            <th style="padding: 10px;">Department ID</th>
            <th style="padding: 10px;">Department Name</th>
          </tr>
          <?php
          include('../php/config.php');
          $sql = "SELECT * FROM dept_tb";
          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {
            while ($row = $result->fetch_assoc()) {
              $count = $count + 1;
          ?>
              <tr>
                <td style="padding: 10px;"><?php echo str_pad($row["dept_id"], 8, 0, STR_PAD_LEFT) ?></td>
                <td style="padding: 10px;"><?php echo $row["dept_name"] ?></td>
              </tr>
          <?php }
          } ?>
        </table>
      </div>
    </div>
  </div>

</div>


</html>