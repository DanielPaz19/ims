<?php

include('../php/config.php');

if (isset($_POST['stout_submit'])) {
	$id = $_POST['id'];
	$stout_code = mysqli_real_escape_string($db, $_POST['stout_code']);
	$stout_title = mysqli_real_escape_string($db, $_POST['stout_title']);
	$stout_remarks = mysqli_real_escape_string($db, $_POST['stout_remarks']);
	$stout_date = mysqli_real_escape_string($db, $_POST['stout_date']);



	mysqli_query($db, "UPDATE stout_tb SET stout_code='$stout_code', stout_title='$stout_title' ,stout_remarks='$stout_remarks',stout_date='$stout_date'  WHERE stout_id='$id'");

	header("Location:stin.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

	$id = $_GET['id'];
	$result = mysqli_query($db, "SELECT  stout_tb.stout_id ,stout_tb.stout_code, stout_tb.stout_title, stout_tb.stout_remarks, stout_tb.itemdesc, stout_tb.stout_date, stout_tb.stout_remarks, employee_tb.emp_name, dept_tb.dept_name
														FROM stout_tb  
														LEFT JOIN employee_tb ON stout_tb.emp_id = employee_tb.emp_id
														LEFT JOIN dept_tb ON employee_tb.dept_id = dept_tb.dept_id
														WHERE stout_id=" . $_GET['id']);

	$row = mysqli_fetch_array($result);

	if ($row) {

		$id = $row['stout_id'];
		$stout_code = $row['stout_code'];
		$stout_title = $row['stout_title'];
		$stout_remarks = $row['stout_remarks'];
		$emp_name = $row['emp_name'];
		$dept_name = $row['dept_name'];
		$itemdesc = $row['itemdesc'];
		$dateString = $row['stout_date'];
		$dateTimeObj = date_create($dateString);
		$date = date_format($dateTimeObj, 'm/d/y');
	} else {
		echo "No results!";
	}
}

/* TEST CODE*/

/* TEST CODE END */
?>
<html>
<title><?php echo $stout_code; ?></title>

<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/viewpoV2.css" type="text/css" media="print">
	<link rel="stylesheet" href="../css/viewpoV2.css" type="text/css">
	<style>
		body {
			font-family: sans-serif;
			margin: none;
			padding: 50px;
		}

		.top {

			letter-spacing: 3px;
			line-height: 1%;
			padding-top: 10px;

		}


		.itemtb th {
			text-align: left;
			border: 1px solid lightgrey;
			padding: 5px;
		}

		.itemtb th {
			color: midnightblue;
		}

		label,
		th {
			color: midnightblue;
		}


		.itemtb2 th {
			text-align: left;
			border: 1px solid lightgrey;
			padding: 5px;
		}

		.itemtb2 th {
			color: midnightblue;
		}



		.content {
			width: 100%;
			position: relative;
			/* border: 1px solid black; */
		}

		.footertb td {
			padding: 10px;
		}


		@media print {
			#printPageButton {
				display: none;

			}

		}

		.itemtb {
			position: absolute;
			border-collapse: collapse;
			/* border: 1px solid black; */
			width: 60%;

		}



		.itemtb2 {
			position: absolute;
			border-collapse: collapse;
			/* border: 1px solid lightgray; */
			width: auto;
			margin-left: 60%;
			align-content: right;
		}

		.itemtb tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		.itemtb2 textarea {
			border: none;
			resize: none;
			font-size: 16px;
		}

		.button {
			margin-left: 80%;
			margin-top: -8%;
			position: absolute;
		}

		.textarea {
			display: block;
			width: 31%;
			overflow: hidden;
			resize: both;
			border: none;
			resize: none;

		}

		.itemtb td {
			padding: 3px;
		}
	</style>

</head>


<body>
	<div class="print-area">
		<page id="print" size="A4">
			<div class="top">
				<center>
					<h3 style="color: midnightblue;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h3>
					<h4 style="color: midnightblue;">REQUISITION SLIP</h4>
					<hr width="50%">
					<br>
				</center>
			</div>

			<div class="labels">
				<table width="100%">
					<tr>
						<td><b>Job-Order.:</b>&nbsp;&nbsp;<?php echo $stout_title; ?></td>
						<td width="40%"></td>
						<td><b>RS No. :</b>&nbsp;&nbsp;<?php echo $stout_code; ?></td>
					</tr>
					<tr>
						<td><b>Item Description:</b>&nbsp;&nbsp;<?php echo $itemdesc; ?></td>
						<td width="40%"></td>
						<td><b>Date:</b>&nbsp;&nbsp;<?php echo $date; ?></td>
					</tr>
				</table>
			</div>

			<br>

			<div class="content">
				<table class="itemtb">
					<tr>
						<th>QTY</th>
						<th>MATERIAL USE</th>

					</tr>
					<?php
					$sql = "SELECT product.product_name,stout_product.stout_temp_qty,unit_tb.unit_name, stout_product.stout_temp_remarks 
			   FROM stout_product 
			   LEFT JOIN product ON product.product_id = stout_product.product_id
			   LEFT JOIN stout_tb ON stout_product.stout_id=stout_tb.stout_id
			   LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE stout_product.stout_id='$id'";

					$result = $db->query($sql);
					$count = 0;
					if ($result->num_rows >  0) {

						while ($irow = $result->fetch_assoc()) {
							$count = $count + 1;
							$text = $irow['stout_temp_remarks'];
							$newtext = wordwrap($text, 50, "<br />", false);
					?>
							<tr>
								<td style=" padding-left: 10px; vertical-align:top"><?php echo $irow['stout_temp_qty'] ?><?php echo $irow['unit_name'] ?></td>
								<td><?php echo $irow['product_name'] ?><br>
									<p style="font-size:smaller;line: height 2px;"> <?php echo $irow['stout_temp_remarks'] ?></p>
								</td>
								</td>
							</tr>
					<?php }
					}

					?>
				</table>
				<table class="itemtb2">
					<tr>
						<th style="border: 1px solid lightgrey;">Remarks</th>
					</tr>
					<tr>
						<td><textarea cols="30" rows="10"><?php echo $stout_remarks ?></textarea></td>
					</tr>
				</table>
			</div>


			<div class="button">

			</div>
		</page>
	</div>
</body>

<button class="noprint" onclick="window.print()">PRINT</button>




</html>