<?php

include('config.php');

if (isset($_GET['submit']))
{
$id=$_GET['id'];
$payment_name=mysqli_real_escape_string($db, $_GET['payment_name']);

mysqli_query($db,"UPDATE payments SET payment_name='$payment_name' WHERE payment_id='$id'");

header("Location:bo_payments.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM payments WHERE payment_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['payment_id'];
$payment_name = $row['payment_name'];

}
else
{
echo "No results!";
}
}
?>

<form autocomplete="off"  method="GET" action="">
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		<table>
			<tr>
			<td ><b><font color='midnightblue'>Payment Name<em>*</em></font></b></td>
			<td ><label>
			<input type="text"  size="80%" name="payment_name" value="<?php echo $payment_name; ?>" />
			</label></td>
			</tr>
		</table>
