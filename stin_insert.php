<?php
//insert.php
include "config.php";
if(isset($_POST["stin_temp_itemname"]))
{
 $product_id = $_POST["product_id"];
 $stin_temp_itemname = $_POST["stin_temp_itemname"];
 $stin_temp_qty = $_POST["stin_temp_qty"];
 $stin_temp_unit = $_POST["stin_temp_unit"];
 $stin_temp_cost = $_POST["stin_temp_cost"];
 $stin_temp_disamount = $_POST["stin_temp_disamount"];
 $stin_code = $_POST["stin_code"];

 $query = '';
 for($count = 0; $count<count($stin_temp_itemname); $count++)
 {
  $product_id_clean = mysqli_real_escape_string($db, $product_id[$count]);
  $stin_temp_itemname_clean = mysqli_real_escape_string($db, $stin_temp_itemname[$count]);
  $stin_temp_qty_clean = mysqli_real_escape_string($db, $stin_temp_qty[$count]);
  $stin_temp_unit_clean = mysqli_real_escape_string($db, $stin_temp_unit[$count]);
  $stin_temp_cost_clean = mysqli_real_escape_string($db, $stin_temp_cost[$count]);
  $stin_temp_disamount_clean = mysqli_real_escape_string($db, $stin_temp_disamount[$count]);
  $stin_code_clean = mysqli_real_escape_string($db, $stin_code[$count]);

  if($product_id_clean != '' && $stin_temp_itemname_clean != '' && $stin_temp_unit_clean != '' && $stin_temp_cost_clean != '' && $stin_temp_disamount_clean != '' && $stin_code_clean != '')
  {
   $query .= '
   INSERT INTO stin_temp_tb(product_id,stin_temp_itemname,stin_temp_qty, stin_temp_unit, stin_temp_cost, stin_temp_disamount,stin_code) 
   VALUES("'.$product_id_clean.'","'.$stin_temp_itemname_clean.'", "'.$stin_temp_qty_clean.'","'.$stin_temp_unit_clean.'", "'.$stin_temp_cost_clean.'", "'.$stin_temp_disamount_clean.'", "'.$stin_code_clean.'"); 
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($db, $query))
  {
   echo 'Item Data Inserted';
  }
  else
  {
   echo 'Error';
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>