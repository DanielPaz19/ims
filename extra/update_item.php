<?php

include('config.php');

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$product_name=mysqli_real_escape_string($db, $_POST['product_name']);
$class=mysqli_real_escape_string($db, $_POST['class']);
$unit=mysqli_real_escape_string($db, $_POST['unit']);
$pro_remarks=mysqli_real_escape_string($db, $_POST['pro_remarks']);
$location=mysqli_real_escape_string($db, $_POST['location']);
$barcode=mysqli_real_escape_string($db, $_POST['barcode']);
$price=mysqli_real_escape_string($db, $_POST['price']);
$cost=mysqli_real_escape_string($db, $_POST['cost']);
$dept=mysqli_real_escape_string($db, $_POST['dept']);





mysqli_query($db,"UPDATE product SET product_name='$product_name', class='$class',unit='$unit' ,pro_remarks='$pro_remarks',location='$location' ,barcode='$barcode' ,price='$price',cost='$cost' ,dept='$dept' WHERE product_id='$id'");

header("Location:itemlist.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['product_id'];
$product_name = $row['product_name'];
$class = $row['class'];
$unit = $row['unit'];
$pro_remarks = $row['pro_remarks'];
$location = $row['location'];
$barcode = $row['barcode'];
$price = $row['price'];
$cost = $row['cost'];
$dept = $row['dept'];


}
else
{
echo "No results!";
}
}
?>
