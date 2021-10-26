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
        $stinId = $_GET['stin_id'];
        $productId = $_GET['product-id'];
        $qty = $_GET['qty_order'];
        $cost = $_GET['cost'];
        $disamount = $_GET['disamount'];
        $total = $_GET['total'];
        $stinCode = $_GET['stin_code'];
        $stinTitle = $_GET['stin_title'];
        $stinDate = $_GET['stin_date'];
        $stinRemarks = $_GET['stin_remarks'];
        $emp_id = $_GET['emp_id'];


    if(isset($_GET['btnsave']) && $productId[0] != ""){ //Will not proceed if Products are Empty

        echo "<br>";

        foreach($productId as $x) {
            echo "product id :" .$x ."<br>";
        }

        echo "stin id:" .$stinId ."<br>" ."<br>";

        $limit = 0;
        while(sizeof($productId) !== $limit) {

            $sql = "INSERT INTO stin_product (product_id,stin_id, stin_temp_qty,stin_temp_cost,stin_temp_disamount,stin_temp_tot)
            VALUES (" .$productId[$limit] ."," .$stinId ."," .$qty[$limit] ."," .removeComma($cost[$limit]) ."," .removeComma($disamount[$limit]) ."," .removeComma($total[$limit]) .")";

            if (mysqli_query($db, $sql)) {
                echo "New record created successfully ". "<br>". "<br>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>". "<br>" ;
              }

            $limit++;
        }

        $sql = "INSERT INTO stin_tb (stin_id,stin_code, stin_title ,stin_date ,stin_remarks, emp_id)
            VALUES ('$stinId','$stinCode','$stinTitle','$stinDate','$stinRemarks','$emp_id')";

            if (mysqli_query($db, $sql)) {
                echo "<script>alert('New Record Added')</script>";
                echo "<script>window.close();</script>";
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