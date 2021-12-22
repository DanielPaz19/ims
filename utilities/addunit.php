<?php

// connect to the database
include "../php/config.php";
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_GET['addUnit'])) {
  // receive all input values from the form
  echo "connect";
  $unit_name = mysqli_real_escape_string($db, $_GET['unit_name']);

  $query = "INSERT INTO unit_tb (unit_name) 
          VALUES('$unit_name')";

  if (mysqli_query($db, $query)) {
    echo "<script>alert('New Unit Added')</script>";
    header("location: addunit.php");
  } else {
    echo '<script type="text/javascript"> alert("Error Uploading Data!"); </script>';  // when error occur
  }
}
?>

<html>
<title>Unit</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  body {
    font-family: sans-serif;
    background-color: #B0C4DE;
  }

  .content {
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    margin-bottom: 10px;
    overflow-y: scroll;

  }

  table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid lightgrey;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    margin-bottom: 10px;
  }

  table td {
    border: 1px solid black;
    padding: 5px;
    background-color: white;
  }

  table th {
    text-align: left;
    color: white;
    background-color: midnightblue;
  }

  .label {
    color: midnightblue;
    font-weight: bolder;

  }

  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 60%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  @keyframes animatetop {
    from {
      top: -300px;
      opacity: 0
    }

    to {
      top: 0;
      opacity: 1
    }
  }

  /* The Close Button */
  .close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: red;
    text-decoration: none;
    cursor: pointer;
  }

  .modal-header {
    padding: 2px 16px;
    background-color: midnightblue;
    color: white;
  }

  .modal-body {
    padding: 2px 16px;
  }

  .modal-footer {
    padding: 2px 16px;
    background-color: none;
    color: white;
  }

  .content {
    background-color: #eee;
    height: 100%;
  }

  h3 {
    letter-spacing: 3px;
  }

  button {
    background-color: midnightblue;
    color: white;
    font-size: 15px;
    padding: 10px;
    letter-spacing: 2px;
    cursor: pointer;
  }

  input[type=text] {
    height: 30px;
    width: 240px;
  }
</style>

<body>
  <div class="content">

    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header"><br>
          <span class="close">&times;</span>
          <h3>Unit: Entering Records</h3>
        </div>
        <div class="modal-body">
          <br>
          <fieldset style="border:none;">
            <form method="GET" action="#">
              <label>Unit: </label>
              <input type="text" name="unit_name" required><br><br> <button name="addUnit">Save</button>&nbsp;
            </form>
          </fieldset>
        </div>

      </div>
    </div>

    <button class="butLink" title="Create New Item" id="myBtn">Add Unit</button><br><br>
    <table>
      <tr>
        <th style="padding: 10px;">ID</th>
        <th style="padding: 10px;">Unit</th>
        <th style="text-align: center;">Action</th>
      </tr>

      <?php
      $sql = "SELECT * FROM unit_tb";
      $result = $db->query($sql);
      $count = 0;
      if ($result->num_rows >  0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row["unit_id"];
          $count = $count + 1;
      ?>
          <tr>
            <td style="padding: 10px;"><?php echo $row["unit_id"] ?></td>
            <td style="padding: 10px;"><?php echo $row["unit_name"] ?></td>
            <td style="text-align: center;"> <a href="../delete/unit_delete.php?id=<?php echo $id ?>" onclick="confirmAction()" title="Delete">
                <font color="red"><i class="fa fa-trash-o" style="font-size:26px"></i></font>
              </a>
            </td>

          </tr>
      <?php }
      } ?>
    </table>
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




</body>

</html>