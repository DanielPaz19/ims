<?php
//insert.php
include "config.php";
if(isset($_POST["stout_temp_itemname"]))
{
 $product_id = $_POST["product_id"];
 $stout_temp_itemname = $_POST["stout_temp_itemname"];
 $stout_temp_qty = $_POST["stout_temp_qty"];
 $stout_temp_unit = $_POST["stout_temp_unit"];
 $stout_temp_cost = $_POST["stout_temp_cost"];
 $stout_temp_disamount = $_POST["stout_temp_disamount"];
 $stout_code = $_POST["stout_code"];
 $query = '';
 for($count = 0; $count<count($stout_temp_itemname); $count++)
 {
  $product_id_clean = mysqli_real_escape_string($db, $product_id[$count]);
  $stout_temp_itemname_clean = mysqli_real_escape_string($db, $stout_temp_itemname[$count]);
  $stout_temp_qty_clean = mysqli_real_escape_string($db, $stout_temp_qty[$count]);
  $stout_temp_unit_clean = mysqli_real_escape_string($db, $stout_temp_unit[$count]);
  $stout_temp_cost_clean = mysqli_real_escape_string($db, $stout_temp_cost[$count]);
  $stout_temp_disamount_clean = mysqli_real_escape_string($db, $stout_temp_disamount[$count]);
  $stout_code_clean = mysqli_real_escape_string($db, $stout_code[$count]);
  if($product_id_clean != '' && $stout_temp_itemname_clean != '' && $stout_temp_qty_clean != '' && $stout_temp_unit_clean != '' && $stout_temp_cost_clean != '' && $stout_temp_disamount_clean != '' && $stout_code_clean != '')
  {
   $query .= '
   INSERT INTO stout_temp_tb(product_id, stout_temp_itemname, stout_temp_qty, stout_temp_unit, stout_temp_cost, stout_temp_disamount,stout_code) 
   VALUES("'.$product_id_clean.'","'.$stout_temp_itemname_clean.'","'.$stout_temp_qty_clean.'", "'.$stout_temp_unit_clean.'", "'.$stout_temp_cost_clean.'", "'.$stout_temp_disamount_clean.'", "'.$stout_code_clean.'"); 
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