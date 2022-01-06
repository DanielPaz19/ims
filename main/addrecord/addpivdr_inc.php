<?php

// connect to the database
include "../../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_GET['save'])) {
    // receive all input values from the form
    echo "connect";
    $customer_id = mysqli_real_escape_string($db, $_GET['customers_id']);
    $drNo = mysqli_real_escape_string($db, $_GET['drNo']);
    $siNo = mysqli_real_escape_string($db, $_GET['siNo']);
    $orNo = mysqli_real_escape_string($db, $_GET['orNo']);
    $remarks = mysqli_real_escape_string($db, $_GET['remarks']);
    $date = mysqli_real_escape_string($db, $_GET['date']);


    $query = "INSERT INTO pinvdr_tb(customers_id,pinvdr_drNo,pinvdr_siNo,pinvdr_orNo,pinvdr_remarks,pinvdr_date) 
  			  VALUES('$customer_id','$drNo','$siNo','$orNo','$remarks','$date')";


    if (mysqli_query($db, $query)) {
        $last_id = mysqli_insert_id($db);
    } else {
        echo '<script type="text/javascript"> alert("Error Uploading Data!"); </script>';  // when error occur
    }

    echo "<script>alert('New Record Added')</script>";
    echo "<script>window.close();</script>";
}
