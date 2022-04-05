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

<?php include('../headerv2.php') ?>
<style>
	label {
		font-weight: bold;
	}
</style>
<div class="container-sm">
	<div class="shadow-lg p-5 mt-5 bg-body rounded printPage" style="width:100%;border:5px solid #cce0ff" id="printDiv">
		<div class="top">
			<center>
				<h3 style="letter-spacing: 3px;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h3>
				<h5 style="letter-spacing: 2px;">REQUISITION SLIP</h5>
				<hr style="width: 80%;">
			</center>
		</div>
		<div class="row">
			<div class="col">
				<label for="">Job-Order No.:</label> <?php echo $stout_title; ?>
			</div>
			<div class="col" style="text-align: right;">
				<label for="">RS No.:</label> <?php echo $stout_code; ?>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<label for="">Item Description:</label> <?php echo $itemdesc; ?>
			</div>
			<div class="col" style="text-align: right;">
				<label for="">RS Date:</label> <?php echo $date; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-9">
				<br>
				<table class="table">
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
								<td style=" padding-left: 10px; vertical-align:top"><?php echo $irow['stout_temp_qty'] ?><?php echo $irow['unit_name'] ?>
								</td>
								<td><?php echo $irow['product_name'] ?><br>
									<p style="font-size:smaller;line-height: 15px;">
										<?php
										$search = array(',');
										$replace = array('<br />', '');
										echo $irow['stout_temp_remarks'] = str_replace($search, $replace, $irow['stout_temp_remarks']);
										?>

									</p>
								</td>
							</tr>
					<?php }
					}

					?>
				</table>
			</div>
			<div class="col-3"><br>
				<table class="table table-borderless">
					<tr>
						<th>Remarks</th>
					</tr>
					<tr>
						<td>
							<?php
							$search = array(',', ':');
							$replace = array('<br />', '');
							echo $stout_remarks = str_replace($search, $replace, $stout_remarks);
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>

	</div>
	<br>
	<div class="col">
		<button class="btn btn-primary" id="doPrint">Print Record</button>
		<a href="../stout_main.php"><button class="btn btn-danger"> Cancel</button></a>
	</div>
</div>
<br>

</div>








<script>
	document.getElementById("doPrint").addEventListener("click", function() {
		var printContents = document.getElementById('printDiv').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	});
</script>