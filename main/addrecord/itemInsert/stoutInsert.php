<?php
    include_once "../../../php/config.php";

    //function for removing comma
    function removeComma($str) {
      $comma = "/,/i";
      if (preg_match($comma, $str)) {
        return str_replace(',', '', $str);
      } else {
        return $str;
      }
    }
        $stoutID = $_GET['stout_id'];
        $productId = $_GET['product-id'];
        $qty = $_GET['qty_order'];
        $cost = $_GET['cost'];
        $disamount = $_GET['disamount'];
        $total = $_GET['total'];
        $stoutCode = $_GET['stout_code'];
        $stoutTitle = $_GET['stout_title'];
        $stoutDate = $_GET['stout_date'];
        $stout_temp_remarks = $_GET['stout_temp_remarks'];
        $emp_id = $_GET['emp_id'];
        $itemdesc = $_GET['itemdesc'];


    if(isset($_GET['btnsave']) && $productId[0] != ""){ //Will not proceed if Products are Empty

        echo "<br>";

        foreach($productId as $x) {
            echo "product id :" .$x ."<br>";
        }

        echo "stout id:" .$stoutID ."<br>" ."<br>";

        $limit = 0;
        while(sizeof($productId) !== $limit) {

            $sql = "INSERT INTO stout_product (product_id, stout_id, stout_temp_qty, stout_temp_cost, stout_temp_disamount, stout_temp_tot)

            VALUES (" .$productId[$limit] ."," .$stoutID ."," .$qty[$limit] ."," .removeComma($cost[$limit]) ."," .removeComma($disamount[$limit]) ."," .removeComma($total[$limit]) .")";

                   
            if (mysqli_query($db, $sql)) {
                echo "New record created successfully ". "<br>". "<br>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>". "<br>" ;
              }

            $limit++;
        }

            $limiter = 0;
             while(sizeof($productId) !== $limiter) {
                $sql = "UPDATE stout_product 
                     SET stout_temp_remarks ='" .$stout_temp_remarks[$limiter]
                     ."' WHERE product_id = " .$productId[$limiter] ." AND stout_id =" .$stoutID;
         
                   

            

            if (mysqli_query($db, $sql)) {
                echo "New record created successfully ". "<br>". "<br>";
              }


               else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>". "<br>" ;
              }

              $limiter++;
          }
         
   

        $sql = "INSERT INTO stout_tb (stout_id,stout_code, stout_title ,stout_date , itemdesc, emp_id)
            VALUES ('$stoutID','$stoutCode','$stoutTitle','$stoutDate','$itemdesc','$emp_id')";

            if (mysqli_query($db, $sql)) {
                // echo "<script>alert('New Record Added')</script>";
                // echo "<script>window.close();</script>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" ;
              }
            
            
              
    } else {

      $url = "pos-main.html?";

      foreach($productId as $urlId){
        $url .= "product_id[]=" .$urlId ."&";
      }
      echo $url;
      // header("location: " .$url); //Go back to main page
    }