<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee</title>
</head>

<?php include('../main_header_v2.php'); ?>

<div style="padding: 2%;">
  <div class="row">
    <div class="col-4">
      <div style="padding: 2%;background-color:aliceblue">
        <form method="POST" action="addemployee_con.php">
          <p style="padding: 3%;font-weight:bold;color:#0d6efd">New Employee</p>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="emp_name" required>
            <label for="floatingInput">Employee Name</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dept_id">
              <option></option>
              <?php
              include "../php/config.php";
              $records = mysqli_query($db, "SELECT * FROM dept_tb ");

              while ($data = mysqli_fetch_array($records)) {
                echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
              }
              ?>
            </select>
            <label for="floatingSelect">Department</label>
          </div>
          <button name="addEmployee" class="btn btn-success mb-3" style="width: 100%;">Save Employee</button>
        </form>
      </div>
    </div>
    <div class="col-8">
      <div style="padding: 2%;background-color:aliceblue">
        <?php include('../table/emp_table.html') ?>
      </div>
    </div>
  </div>
</div>

</html>