
<?php

include('../php/config.php');

if (isset($_POST['po_submit']))
{
$id=$_POST['id'];
$po_code=mysqli_real_escape_string($db, $_POST['po_code']);
$po_title=mysqli_real_escape_string($db, $_POST['po_title']);
$po_date=mysqli_real_escape_string($db, $_POST['po_date']);
$po_remarks=mysqli_real_escape_string($db, $_POST['po_remarks']);
$sup_id=mysqli_real_escape_string($db, $_POST['sup_id']);


mysqli_query($db,"UPDATE po_tb SET po_code='$po_code', po_title='$po_title' ,po_date='$po_date',po_remarks='$po_remarks',sup_id='$sup_id'  WHERE po_id='$id'");

header("Location:po.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT po_tb.po_id, po_tb.po_code, po_tb.po_title, po_tb.po_date, po_tb.po_remarks, po_tb.po_terms, sup_tb.sup_name
                            FROM po_tb 
                            INNER JOIN sup_tb ON po_tb.sup_id = sup_tb.sup_id
                            WHERE po_id=".$_GET['id'] );

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['po_id'];
$po_code = $row['po_code'];
$po_title = $row['po_title'];
$po_date = $row['po_date'];
$po_remarks = $row['po_remarks'];
$sup_name = $row['sup_name'];



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
<title>Edit Purchase Order</title>

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

<body  style="margin: 0px;" bgcolor="#B0C4DE">
<div class="container">
<a href="../main/po_main.php">  <i class="fa fa-close" style="font-size:24px; color: red; float: right;"></i></a>
<br>
<fieldset>
<legend>&nbsp;&nbsp;&nbsp;Purchase Order: Editing Record&nbsp;&nbsp;&nbsp;</legend>
<form autocomplete="off" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<table>
<tr>
<td width="5%"><b><font color='midnightblue'>Code<em>:</em></font></b></td>
<td><label>
<input type="text"  class="form-control" name="po_code" value="<?php echo $po_code; ?>" />
</label></td>
<td>&nbsp</td>

<td width="5%"><b><font color='midnightblue'>Title<em>:</em></font></b></td>
<td><label>
<input type="text" class="form-control" name="po_title" value="<?php echo $po_title; ?>" />
</label></td>
<td>&nbsp</td>

<td width="5%"><b><font color='midnightblue'>Remarks </font></b></td>
<td><label>
<input type="text" class="form-control" name="po_remarks" value="<?php echo $po_remarks; ?>">
</label></td>
<td>&nbsp</td>

<td width="5%"><b><font color='midnightblue'>Date<em>*</em></font></b></td>
<td><label>
<input type="date" class="form-control" name="po_date" value="<?php echo $po_date; ?>">
</label></td>
</tr>

<td><b><font color='midnightblue'>Supplier<em>:</em></font></b></td>
<td><label>
<input type="text" class="form-control" width="30%" name="sup_id" value="<?php echo $sup_name; ?>">
</label></td>
</tr>
</table>

<br>
<table class="itemTb" >
<tr>
<th>Item Description</th>
<th>On-Hand</th>
<th>Qty PO</th>
<th>Unit</th>
<th>Cost</th>
<th>Total Cost</th>
<th>Discount Amount</th>
<th>Action</th>
</tr>

<?php 

   $sql = "SELECT product.product_name, product.qty, po_product.item_qtyorder, unit_tb.unit_name, product.cost, po_product.po_temp_tot, po_product.item_disamount, product.product_id
           FROM product
           INNER JOIN po_product 
           ON product.product_id = po_product.product_id
           INNER JOIN unit_tb
           ON product.unit_id = unit_tb.unit_id
           WHERE po_product.po_id='$id'";

      $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  
                 while ($irow = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
?>

  <tr>
    

    <td ><?php echo $irow['product_name']?></td>
    <td ><?php echo $irow['qty']?></td>
    <td ><?php echo $irow['item_qtyorder']?></td>
    <td ><?php echo $irow['unit_name']?></td>
    <td ><?php echo $irow['cost']?></td>
    <td ><?php echo $irow['po_temp_tot']?></td>
    <td ><?php echo $irow['item_disamount']?></td>
 <td>
    <center>
       <a href="../edit/item_edit/po_itemedit.php?<?php echo 'id=' .$id .'&prodId=' .$irow['product_id'] .'&Tot=' .$irow['po_temp_tot'] ;?>"> <i class='fas fa-edit' style="font-size:17px" title="Edit"></i></a>
       &nbsp; 
       <a href="po_itemdelete.php?id=<?php echo $irow['temp_id'];?>"><font color="red"><i class='fas fa-trash-alt' style="font-size:17px" title="Remove"></i></font></a>
     </center>
   </td>
   
   
  </tr>
<?php }}?> 
</table>
<br>
<input type="submit" class="butLink" name="po_submit" value="Edit Records" onclick="alert('Edit Records Successfully !')">
</form>
</fieldset>
<!-- EDIT PO END -->


</html>
