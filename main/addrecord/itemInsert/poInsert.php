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
        $poId = $_GET['po_id'];
        $productId = $_GET['product-id'];
        $qty = $_GET['qty_order'];
        $cost = $_GET['cost'];
        $disamount = $_GET['disamount'];
        $total = $_GET['total'];
        $poCode = $_GET['po_code'];
        $poTitle = $_GET['po_title'];
        $poDate = $_GET['po_date'];
        $poRemarks = $_GET['po_remarks'];
        $poTerms = $_GET['po_terms'];
        $supId = $_GET['sup_id'];


    if(isset($_GET['btnsave']) && $productId[0] != ""){ //Will not proceed if Products are Empty

        echo "<br>";

        foreach($productId as $x) {
            echo "product id :" .$x ."<br>";
        }

        echo "PO ID:" .$poId ."<br>" ."<br>";

        $limit = 0;
        while(sizeof($productId) !== $limit) {

            $sql = "INSERT INTO po_product (product_id, po_id, item_qtyorder,item_cost,item_disamount,po_temp_tot)
            VALUES (" .$productId[$limit] ."," .$poId ."," .$qty[$limit] ."," .removeComma($cost[$limit]) ."," .removeComma($disamount[$limit]) ."," .removeComma($total[$limit]) .")";

            if (mysqli_query($db, $sql)) {
                echo "New record created successfully ". "<br>". "<br>";
              } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>". "<br>" ;
              }

            $limit++;
        }

        $sql = "INSERT INTO po_tb (po_id,po_code, po_title ,po_date ,po_remarks, po_terms, sup_id)
            VALUES ('$poId','$poCode','$poTitle','$poDate','$poRemarks','$poTerms','$supId')";

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