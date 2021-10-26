<?php
// connect to the database
include "config.php";
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_POST['stin_add'])) {
  // receive all input values from the form
  echo "connect";
  $stin_code = mysqli_real_escape_string($db, $_POST['stin_code']);
  $stin_title = mysqli_real_escape_string($db, $_POST['stin_title']);
  $stin_remarks = mysqli_real_escape_string($db, $_POST['stin_remarks']);
  $stin_date = mysqli_real_escape_string($db, $_POST['stin_date']);

  $query = "INSERT INTO stin_tb (stin_code,stin_title,stin_remarks,stin_date) 
		  VALUES('$stin_code','$stin_title','$stin_remarks','$stin_date')";


  if (mysqli_query($db, $query)) {


    echo 'Data Inserted Successfully!';
  } else {
    echo 'Error Uploading Data!';
  }

  header('location: stin.php');
}
