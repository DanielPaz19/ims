<?php

// connect to the database
include "../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Add item
if (isset($_GET['addDept'])) {
    // receive all input values from the form
    echo "connect";
    $dept_name = mysqli_real_escape_string($db, $_GET['dept_name']);

    $query = "INSERT INTO dept_tb (dept_name) 
          VALUES('$dept_name')";

    if (mysqli_query($db, $query)) {
        echo "<script>alert('New Record Added')</script>";
        echo "<script>window.close();</script>";
    } else {
        echo '<script type="text/javascript"> alert("Error Uploading Data!"); </script>';  // when error occur
    }
}
