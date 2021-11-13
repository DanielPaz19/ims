<?php

include('../php/config.php');

if (isset($_POST['stin_submit'])) {
	$id = $_POST['id'];
	$stin_code = mysqli_real_escape_string($db, $_POST['stin_code']);
	$stin_title = mysqli_real_escape_string($db, $_POST['stin_title']);
	$stin_remarks = mysqli_real_escape_string($db, $_POST['stin_remarks']);
	$stin_date = mysqli_real_escape_string($db, $_POST['stin_date']);



	mysqli_query($db, "UPDATE stin_tb SET stin_code='$stin_code', stin_title='$stin_title' ,stin_remarks='$stin_remarks',stin_date='$stin_date'  WHERE stin_id='$id'");

	header("Location:http://localhost/pacc3/main/stin_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

	$id = $_GET['id'];
	$result = mysqli_query($db, "SELECT  stin_tb.stin_id ,stin_tb.stin_code, stin_tb.stin_title, stin_tb.stin_remarks, stin_tb.stin_date, employee_tb.emp_name, dept_tb.dept_name
														FROM stin_tb  
														LEFT JOIN employee_tb ON stin_tb.emp_id = employee_tb.emp_id
														LEFT JOIN dept_tb ON employee_tb.dept_id = dept_tb.dept_id
														WHERE stin_id=" . $_GET['id']);

	$row = mysqli_fetch_array($result);

	if ($row) {

		$id = $row['stin_id'];
		$stin_code = $row['stin_code'];
		$stin_title = $row['stin_title'];
		$stin_remarks = $row['stin_remarks'];
		$stin_date = $row['stin_date'];
		$emp_name = $row['emp_name'];
		$dept_name = $row['dept_name'];
	} else {
		echo "No results!";
	}
}

/* TEST CODE*/

/* TEST CODE END */
?>
<html>
<title><?php echo $stin_code; ?></title>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body {
			font-family: sans-serif;
			width: auto;
			padding: 10px;
		}

		.top {

			letter-spacing: 3px;
			line-height: 1%;
			padding-top: 10px;

		}

		.labels {
			margin-left: 40px;
			margin-right: 40px;
		}

		.content {
			margin-left: 40px;
			margin-right: 40px;
		}

		.itemtb td,
		th {
			text-align: left;
			border: 1px solid lightgrey;
			font-size: 15px;
			padding: 5px;

		}

		label,
		th {
			color: midnightblue;
		}


		.itemtb {
			border-collapse: collapse;
		}

		.footer {
			margin-left: 40px;
			margin-right: 40px;
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
			font-size: 15px;
		}

		@media print {
			#printPageButton {
				display: none;
			}
		}
	</style>

</head>


<body style="margin: auto;">
	<div class="top">
		<center>
			<h3 style="color: midnightblue;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h3>
			<h4 style="color: midnightblue;">PRODUCTION TURN-OVER SLIP</h4>
			<hr width="50%">

		</center>
	</div>

	<div class="labels">
		<table width="100%">
			<tr>
				<td style="color: midnightblue;"><b>TON No.:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $stin_code; ?> </td>
				<td style="float: right; color: midnightblue;"><b>Job-Order. :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $stin_title; ?></td>
			</tr>
			<tr>
				<td></td>

			</tr>
		</table>
	</div>
	<br>
	<div class="content">
		<table width="100%" class="itemtb">
			<tr>
				<th>ITEMS</th>
				<th>QUANTITY</th>
				<th>UNIT</th>
			</tr>
			<tr>
				<?php
				include "../php/config.php";
				$sql = "SELECT product.product_name,stin_product.stin_temp_qty,unit_tb.unit_name 
   FROM stin_product 
   LEFT JOIN product ON product.product_id = stin_product.product_id
   LEFT JOIN stin_tb ON stin_product.stin_id=stin_tb.stin_id
   LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE stin_product.stin_id='$id'";

				$result = $db->query($sql);
				$count = 0;
				if ($result->num_rows >  0) {

					while ($irow = $result->fetch_assoc()) {
						$count = $count + 1;
				?>
						<td style="text-align: left; padding-left: 10px;"><?php echo $irow['product_name'] ?></td>
						<td><?php echo $irow['stin_temp_qty'] ?></td>
						<td><?php echo $irow['unit_name'] ?></td>
			</tr>
	<?php }
				} ?>
		</table>
	</div>
	<br><br>
	<div class="footer">
		<table width="100%">
			<tr>
				<td style="text-align:left;"><b>Prepared By:</b>&nbsp;&nbsp;&nbsp;<?php echo $emp_name; ?></td>
				<td style="text-align: center;"><b>Department:</b>&nbsp;&nbsp;&nbsp;<?php echo $dept_name; ?></td>
				<td style="text-align: right;"><b>DATE:</b>&nbsp;&nbsp;&nbsp;<?php echo $stin_date; ?>&nbsp;&nbsp;&nbsp;</td>

			</tr>
		</table>
		<br>
		<button id="printPageButton" onclick="window.print()" class="butLink">Print <i class="fa fa-print"></i></button>
		<a href="../stin_main.php"><button id="printPageButton" class="butLink">Back</button></a>
	</div>
</body>
<script>
	function printpage() {
		//Get the print button and put it into a variable
		var printButton = document.getElementById("printPageButton");
		//Set the print button visibility to 'hidden' 
		printButton.style.visibility = 'hidden';
		//Print the page content
		window.print()
		printButton.style.visibility = 'visible';
	}
</script>

</html>