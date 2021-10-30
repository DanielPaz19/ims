<?php

//Check closed value if 1 or 0
  //- Select query for stout_tb

if (isset($_GET['submit'])){

include "../../php/config.php"; 

  $bal_qty = $_GET['bal_qty'];
  $out_qty = $_GET['out_qty'];
  $productId = $_GET['product_id'];
  $stout_id = $_GET['stout_id'];
  $mov_date = $_GET['mov_date'];


  $sql = "SELECT closed FROM stout_tb WHERE stout_id = " .$_GET['stout_id'];
  $result = mysqli_query($db, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $closed = $row['closed'];
    }
  } else {
    echo "0 results";
  }


  if ($closed == 0) {
    foreach ($_GET['stout_temp_tot'] as $stout_temp_tot) {
      $total[] = $stout_temp_tot;
    }

    foreach ($_GET['product_id'] as $product_id) {
      $pro_id[] = $product_id;
    }

    //update database by number of row in stout_commit or number of product ID
    
    $sql = "UPDATE stout_tb SET closed = 1 WHERE stout_id = " .$_GET['stout_id'];
    mysqli_query($db, $sql);

    $limit = 0;
    while($limit != count($pro_id)){
      

      $sql = "UPDATE product SET qty = " .$total[$limit] ." WHERE product_id=" .$pro_id[$limit];

      mysqli_query($db, $sql);
     
      $limit += 1;

    }

       $limit = 0;
        while(sizeof($productId) !== $limit) {

    $sql = "INSERT INTO move_product (product_id,bal_qty,out_qty,mov_type_id,move_ref,mov_date)
            VALUES (" .$productId[$limit] ."," .$bal_qty[$limit] ."," .$out_qty[$limit] .", 2 " ."," .$stout_id .",'" .$mov_date ."')";
            if (mysqli_query($db, $sql)) {
                echo "New record created successfully ". "<br>". "<br>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>". "<br>" ;
              }

            $limit++;
        }
  

  } else {
    $status = "Transaction Closed, Viewing Purpose Only !";
    echo "<script> alert('" .$status ."')</script>";
  }
   header("location: ../../stout_main.php");
}
