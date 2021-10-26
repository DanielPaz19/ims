
<?php

include('../php/config.php');

if (isset($_POST['stin_submit']))
{
$id=$_POST['id'];
$stin_code=mysqli_real_escape_string($db, $_POST['stin_code']);
$stin_title=mysqli_real_escape_string($db, $_POST['stin_title']);
$stin_remarks=mysqli_real_escape_string($db, $_POST['stin_remarks']);
$stin_date=mysqli_real_escape_string($db, $_POST['stin_date']);

mysqli_query($db,"UPDATE stin_tb SET stin_code='$stin_code', stin_title='$stin_title' ,stin_remarks='$stin_remarks',stin_date='$stin_date'  WHERE stin_id='$id'");

header("Location:../main/stin_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM stin_tb  WHERE stin_id=".$_GET['id'] );

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['stin_id'];
$stin_code = $row['stin_code'];
$stin_title = $row['stin_title'];
$stin_remarks = $row['stin_remarks'];
$stin_date = $row['stin_date'];



}
else
{
echo "No results!";
}
}

/* TEST CODE*/

  /* TEST CODE END */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
padding: 50px;
}
fieldset {
padding: 30px;
font-family: sans-serif;
border:  5px solid lightgrey;
height: 650px;
}
legend {
letter-spacing: 3px;
font-weight: bolder;
color: midnightblue;
font-size: 24px;
}

.container {
border-radius: 10px;
padding: 50px;
height: 750px;
background-color:#EAEAEA;
box-shadow:  0 0 10px  rgba(0,0,0,0.6);
-moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
-webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
-o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
margin-bottom: 10px;

}


.itemTb {
    border: 3px solid lightgray;
    border-collapse: collapse;
    width: 100%;

}
.itemTb tr:nth-child(even) {background-color: #E7E8F8;}
.itemTb tr:nth-child(odd) {background-color: white;}
.itemTb th {
    border: 1px solid lightgrey;
    text-align: left;
    padding: 10px;
    font-size: 18px;
    color: white;
    background-color: midnightblue;
}

.itemTb td {
    border: 1px solid lightgray;
    padding: 9px;
}

input[type=text] {
  height: 24px;
}

input[type=date] {
  height: 24px;
}


.butLink {
  background-color: midnightblue;
  color: white;
  padding: 7px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  letter-spacing: 3px;
  cursor: pointer;
}


/*.table1 td,th {
border: 1px solid black;
}*/
</style>

</head>
<title>Edit STOCK-IN</title>

<body  style="margin: 0px;" bgcolor="#B0C4DE">
<div class="container">
<fieldset>
<legend>&nbsp;&nbsp;&nbsp;Stock-Inventory IN: Editing Record&nbsp;&nbsp;&nbsp;</legend>
<form autocomplete="off" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<table class="table1">
<tr>
<td><b><font color='midnightblue'>Code:</font></b></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label>
<input type="text" class="form-control" name="stin_code" value="<?php echo $stin_code; ?>" >
</label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td><b><font color='midnightblue'>Title:</font></b></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label>
<input type="text" class="form-control" name="stin_title" value="<?php echo $stin_title; ?>" />
</label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td><b><font color='midnightblue'>Remarks:</font></b></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label>
<input type="text" class="form-control" name="stin_remarks" value="<?php echo $stin_remarks; ?>">
</label></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td><b><font color='midnightblue'>Date:</font></b></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label>
<input type="date" class="form-control" name="stin_date" value="<?php echo $stin_date; ?>">
</label></td>
</tr>

</table>

<br>
<table class="itemTb" >
<tr>
<th style="text-align: left;">ID</th>
<th style="text-align: left;">Item Description</th>
<th style="text-align: left;">On-Hand</th>
<th style="text-align: left;">Qty-In</th>
<th style="text-align: left;">Unit</th>
<th style="text-align: left;">Cost</th>
<th style="text-align: left;">Discount Amount</th>
<th style="text-align: left;">Incomming Qty</th>
<th style="text-align: center;">Action</th>
</tr>

<?php 
   include "../php/config.php";
   $sql = "SELECT product.product_id, product.product_name,product.qty,stin_product.stin_temp_qty,unit_tb.unit_name,product.cost,stin_product.stin_temp_disamount FROM product INNER JOIN stin_product ON stin_product.product_id=product.product_id INNER JOIN stin_tb ON stin_product.stin_id=stin_tb.stin_id INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE stin_tb.stin_id='$id' ORDER BY product.product_id ASC";

      $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  
                 while ($irow = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                      $total=$irow['qty'] + $irow['stin_temp_qty'];
?>

  <tr>
    
    <td style="text-align: left;"><?php echo $irow['product_id']?></td>
    <td style="text-align: left;"><?php echo $irow['product_name']?></td>
    <td style="text-align: left;"><?php echo $irow['qty']?></td>
    <td style="text-align: left;"><?php echo $irow['stin_temp_qty']?></td>
    <td style="text-align: left;"><?php echo $irow['unit_name']?></td>
    <td style="text-align: left;"><?php echo $irow['cost']?></td>
    <td style="text-align: left;"><?php echo $irow['stin_temp_disamount']?></td>
    <td style="text-align: left;"><?php echo $irow['qty'] + $irow['stin_temp_qty']?></td>
   <td>
    <center>
       <a href="../edit/item_edit/stin_itemedit.php?<?php echo 'id=' .$id .'&prodId=' .$irow['product_id'] .'&Tot=' .$total;?>" title="Edit"><i class="fa fa-edit" style="font-size:24px"></i></a> 
       &nbsp;
      <a href="stin_item_delete.php?id=<?php echo $id;?>" title="Remove"><font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font></a>
   </td>
   
   
  </tr>
<?php }}?> 
</table>
<br>
<button class="butLink" name="stin_submit" onclick="alert('Edit Records Successfully !')">Update</button>
</form>
<br>
<a href="../main/stin_main.php"><button class="butLink">Cancel</button></a>
</fieldset>
<!-- EDIT PO END -->
</div>

</html>
