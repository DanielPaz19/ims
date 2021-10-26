
<?php
// connect to the database
include "../php/config.php";
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


// Add item
if (isset($_GET['addcus'])) {
  // receive all input values from the form
  echo "connect";
  $customers_company=mysqli_real_escape_string($db, $_GET['customers_company']);
  $customers_name=mysqli_real_escape_string($db, $_GET['customers_name']);
  $customers_address=mysqli_real_escape_string($db, $_GET['customers_address']);
  $customers_contact=mysqli_real_escape_string($db, $_GET['customers_contact']);
  $customers_note=mysqli_real_escape_string($db, $_GET['customers_note']);


    $query = "INSERT INTO customers (customers_company,customers_name,customers_address,customers_contact,customers_note) 
  			  VALUES('$customers_company','$customers_name','$customers_address','$customers_contact','$customers_note')";

      if(mysqli_query($db, $query))
      {

      echo "<script>alert('Successfully stored');</script>";
				
    }
    else{
        echo"<script>alert('Something wrong!!!');</script>";
    }
  	
  	header('location: bo_customer.php');
  
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
	font-family: sans-serif;
	background-color: #B0C4DE;
}

.content {
	padding: 30px;
	    box-shadow:  0 0 10px  rgba(0,0,0,0.6);
      -moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
    margin-bottom: 10px;

}
table {
	border-collapse: collapse;
	width: 100%;
	border: 1px solid lightgrey;
	    box-shadow:  0 0 10px  rgba(0,0,0,0.6);
      -moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
    margin-bottom: 10px;
}

table td {
	border: 1px solid black;
	padding: 10px;
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
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
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

.modal-body {padding: 2px 16px;}

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
	width: 50vh;
}

</style>
<div class="content">


	<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header"><br>
      <span class="close">&times;</span>
      <h3>Customer: Entering Records</h3>
    </div>
    <div class="modal-body">
  <br>
<fieldset style="border:none;">
		<form METHOD="GET" action="#" autocomplete="off">
				<label class="label">Company:</label><br>
					<input type="text" name="customers_company" required><br><br>
				<label class="label">Name:</label><br>
					<input type="text" name="customers_name" required><br><br>
				<label class="label">Address:</label><br>
					<input type="text" name="customers_address"><br><br>
				<label class="label">Contact No. :</label><br>
					<input type="text" name="customers_contact"><br><br>
						<button type="submit"  onclick="myFunction()" name="addcus" class="button">Save</button>
			</form>
		</fieldset>

    </div>
  </div>
</div>

<?php include ('../table/customer_table.html')?>

