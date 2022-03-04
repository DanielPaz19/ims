<?php

include('../php/config.php');

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$customers_name=mysqli_real_escape_string($db, $_POST['customers_name']);
$customers_company=mysqli_real_escape_string($db, $_POST['customers_company']);
$customers_address=mysqli_real_escape_string($db, $_POST['customers_address']);
$customers_contact=mysqli_real_escape_string($db, $_POST['customers_contact']);
$customers_note=mysqli_real_escape_string($db, $_POST['customers_note']);
$customers_tin=mysqli_real_escape_string($db, $_POST['customers_tin']);


mysqli_query($db,"UPDATE customers 
                  SET customers_name='$customers_name', customers_company='$customers_company', customers_address='$customers_address', customers_contact='$customers_contact', customers_note='$customers_note', customers_tin='$customers_tin' 
                  WHERE customers_id='$id'");

echo "<script>alert('Record updated sucessfully !!')";
header("Location:../utilities/bo_customer.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM customers WHERE customers_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['customers_id'];
$customers_name = $row['customers_name'];
$customers_company = $row['customers_company'];
$customers_address = $row['customers_address'];
$customers_contact = $row['customers_contact'];
$customers_note = $row['customers_note'];
$customers_tin = $row['customers_tin'];



}
else
{
echo "No results!";
}
}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
.con-form{
font-family: Arial, Helvetica, sans-serif;
border: 1px;
color: midnightblue;
}
.butLink {

  background-color: #6495ed;
  border-radius: 4px;
  color: white;
  padding: 7px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.center {
  margin: auto;
  margin-top: 50px;
  width: 50%;
  border: 3px solid midnightblue;
  padding: 30px;
  border-radius: 5px;
}

</style>



<title>Edit Item</title>
<body>
<div class = "con-form">
<div class="center">
<h2><font color="midnightblue">Edit Records</font></h2>

<form action="" method="post" action="pos-customer-edit.php">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<table border="0">

<tr>
<td width="179"><b><font color='midnightblue'>Name<em>*</em></font></b></td>
<td width="80%"><label>
<input type="text" class="form-control"  size="80%" name="customers_name" value="<?php echo $customers_name; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='midnightblue'>Company<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control"  size="80%" name="customers_company" value="<?php echo $customers_company; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='midnightblue'>Address<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control"  size="80%" name="customers_address" value="<?php echo $customers_address; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='midnightblue'>Contact no.<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control" size="80%" name="customers_contact" value="<?php echo $customers_contact; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='midnightblue'>Contact Note<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control" size="80%" name="customers_note" value="<?php echo $customers_note; ?>" />
</label></td>
</tr>
<tr>
<td width="179"><b><font color='midnightblue'>Contact Tin<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control" size="80%" name="customers_tin" value="<?php echo $customers_tin; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><input type="submit" class="butLink" name="submit" value="Update" ></td>
<td><label>
<input type=button onClick="parent.location='../utilities/bo_customer.php'" class="butLink"
value='Back'>
</label></td>
</tr>
</table>
</form>
</div>
</div>
</body>



</html>
