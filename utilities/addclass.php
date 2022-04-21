<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class</title>
  <link rel="stylesheet" href="../source/css/bootstrap.min.css">
  <script src="../source/js/bootstrap.min.js"></script>
</head>
<?php include('../main_header_v2.php'); ?>
<div style="padding:2%;">
  <div class="row">
    <div class="col-3">
      <br>
      <div class="row">
        <div class="col" style="background-color: aliceblue;padding:2%">
          <p style="padding: 3%;font-weight:bold;color:#0d6efd">NEW CLASSIFICATION</p>
          <form method="POST" action="addclass_con.php">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="class_name" required>
              <label for="floatingInput">Class Name</label>
            </div>
            <div class="col mb-3">
              <div class="col"><button type="submit" class="btn btn-success" name="addClass" style="width: 100%;">Save Class</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-9">
      <?php include('../table/class_table.html') ?>
    </div>
  </div>
</div>




</html>







<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
  function myFunction() {
    alert("Add Bank Sucessfully!");
  }
</script>

</html>