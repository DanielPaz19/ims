
<?php

include('../php/config.php');

if (isset($_POST['stout_submit']))
{
$id=$_POST['id'];
$stout_code=mysqli_real_escape_string($db, $_POST['stout_code']);
$stout_title=mysqli_real_escape_string($db, $_POST['stout_title']);
$stout_date=mysqli_real_escape_string($db, $_POST['stout_date']);



mysqli_query($db,"UPDATE stout_tb SET stout_code='$stout_code', stout_title='$stout_title',stout_date='$stout_date'  WHERE stout_id='$id'");
header("Location:../main/stout_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM stout_tb  WHERE stout_id=".$_GET['id'] );

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['stout_id'];
$stout_code = $row['stout_code'];
$stout_title = $row['stout_title'];
$stout_remarks = $row['stout_remarks'];
$stout_date = $row['stout_date'];



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

<!-- EDIT PO -->
<div class = "item_list">
<title>Edit STOCK-OUT</title>

<body  style="margin: 0px;" bgcolor="#B0C4DE">

<div class="container">
    <a href="../main/stout_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:red"></i></a><br>
<fieldset>
<legend>&nbsp;&nbsp;&nbsp;Stock-Inventory OUT: Editing Record&nbsp;&nbsp;&nbsp;</legend>
<form autocomplete="off" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<table>

<tr>
<td width="5%"><b><font color='midnightblue'>Code:</font></b></td>
<td><label>
<input type="text" class="form-control" name="stout_code" value="<?php echo $stout_code; ?>" >
</label></td>
<td>&nbsp</td>

<td width="5%"><b><font color='midnightblue'>Title:</font></b></td>
<td><label>
<input type="text" class="form-control" name="stout_title" value="<?php echo $stout_title; ?>" />
</label></td>
<td>&nbsp</td>


<td width="5%"><b><font color='midnightblue'>Date:</font></b></td>
<td><label>
<input type="date" class="form-control" name="stout_date" value="<?php echo $stout_date; ?>">
</label></td>
</tr>

</table>

<br>
<table class="itemTb" >
  <tr>
    <th>ID</th>
    <th>Item Description</th>
    <th>On-Hand</th>
    <th>Qty-OUT</th>
    <th>Unit</th>
    <th>Cost</th>
    <th>Discount Amount</th>
    <th style="text-align: center;">Action</th>
  </tr>

<?php 
   include "../php/config.php"; 

   $sql = "SELECT product.product_id,product.product_name, product.qty, stout_product.stout_temp_qty, unit_tb.unit_name, product.cost, stout_product.stout_temp_disamount
           FROM product
           INNER JOIN stout_product
           ON product.product_id = stout_product.product_id
           INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id
           WHERE stout_product.stout_id='$id' ORDER BY product.product_id ASC";

      $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  
                 while ($irow = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
?>

  <tr>
    <td><?php echo $irow['product_id']?></td>
    <td ><?php echo $irow['product_name']?></td>
    <td ><?php echo $irow['qty']?></td>
    <td ><?php echo $irow['stout_temp_qty']?></td>
    <td ><?php echo $irow['unit_name']?></td>
    <td ><?php echo $irow['cost']?></td>
    <td ><?php echo $irow['stout_temp_disamount']?></td>
   <td>
    <center>
       <a href="../edit/item_edit/stout_itemedit.php?<?php echo 'id=' .$id .'&prodId=' .$irow['product_id'] ;?>"> <i class='fas fa-edit' style="font-size:17px" title="Edit"></i></a> 
       &nbsp;
      <a href="stout_item_delete.php?id=<?php echo $id;?>"><font color="red"><i class='fas fa-trash-alt' style="font-size:17px" title="Remove"></i></font></a>

     </center>
   </td>
   
   
  </tr>
<?php }}?> 
</table>
<br>
<button class="butLink" name="stout_submit" onclick="alert('Edit Records Successfully !')">Update</button>
</form>
<br>
</fieldset>
<!-- EDIT PO END -->

</html>
