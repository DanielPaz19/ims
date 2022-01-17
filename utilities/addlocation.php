<?php

// connect to the database
include "../php/config.php";
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_GET['addLoc'])) {
  // receive all input values from the form
  echo "connect";
  $loc_name = mysqli_real_escape_string($db, $_GET['loc_name']);

  $query = "INSERT INTO loc_tb (loc_name) 
          VALUES('$loc_name')";

  if (mysqli_query($db, $query)) {
    echo "<script>alert('New Location Added')</script>";
    header("location: addlocation.php");
  } else {
    echo '<script type="text/javascript"> alert("Error Uploading Data!"); </script>';  // when error occur
  }
}
?>

<html>
<title>Location</title>
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
    border: 1px solid lightgray;
    padding: 5px;
    background-color: white;
  }

  table th {
    text-align: left;
    color: black;
    /* background-color: midnightblue; */
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
    width: 50%;
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

  #myInput {
    background-image: url('../img/searchiconv2.png');
    /* Add a search icon to input */
    background-position: 10px 9px;
    /* Position the search icon */
    background-repeat: no-repeat;
    /* Do not repeat the icon image */
    width: 100%;
    /* Full-width */
    font-size: 16px;
    /* Increase font-size */
    padding: 12px 20px 12px 40px;
    /* Add some padding */
    border: 1px solid #ddd;
    /* Add a grey border */
    margin-bottom: 12px;
    /* Add some space below the input */
  }

  #myTable {
    border-collapse: collapse;
    /* Collapse borders */
    width: 100%;
    /* Full-width */
    border: 1px solid #ddd;
    /* Add a grey border */
    font-size: 18px;
    /* Increase font-size */
  }

  #myTable th,
  #myTable td {
    text-align: left;
    /* Left-align text */
    padding: 12px;
    /* Add padding */
  }

  #myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd;
  }

  #myTable tr.header,
  #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
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
          <h3>Location: Entering Records</h3>
        </div>
        <div class="modal-body">
          <br>
          <fieldset style="border:none;">
            <form method="GET" action="#">
              <label>Location: </label>
              <input type="text" name="loc_name" required><br><br> <button name="addLoc">Save</button>&nbsp;
            </form>
          </fieldset>
        </div>

      </div>
    </div>


    <button class="butLink" title="Create New Item" id="myBtn">Add New Location</button>
    <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Location.." style="float: right; height:40px;width: 50%;"> -->
    <br><br>

    <table id="myTable">
      <tr class="header">
        <th style="padding: 10px;">Location ID</th>
        <th style="padding: 10px;">Location</th>
        <th style="text-align: center;">Action</th>
      </tr>

      <?php
      $sql = "SELECT * FROM loc_tb";
      $result = $db->query($sql);
      $count = 0;
      if ($result->num_rows >  0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row["loc_id"];
          $count = $count + 1;
      ?>
          <tr>
            <td style=" padding: 10px;"><?php echo str_pad($row["loc_id"], 8, 0, STR_PAD_LEFT) ?></td>
            <td style="padding: 10px;"><?php echo $row["loc_name"] ?></td>
            <td style="text-align: center;"> <a href="../delete/location_delete.php?id=<?php echo $id ?>" onclick="confirmAction()" title="Delete">
                <font color="red"><i class="fa fa-trash-o" style="font-size:26px"></i></font>
              </a>
            </td>

          </tr>
      <?php }
      } ?>
    </table>
    <script>
      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
    </script>
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