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
		$emp_name = $row['emp_name'];
		$dept_name = $row['dept_name'];
		$dateString = $row['stin_date'];
		$dateTimeObj = date_create($dateString);
		$date = date_format($dateTimeObj, 'F d, Y');
	} else {
		echo "No results!";
	}
}
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
				<h2>PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</h2>
				<h3>PRODUCTION TURN-OVER SLIP</h3>
				<hr>
			</center>
		</div>
		<div class="row">
			<div class="col-4">
				<label for="">STIN ID :</label> <?php echo str_pad($id, 8, 0, STR_PAD_LEFT); ?>
			</div>
			<div class="col-4">
				<label for="">TON No.:</label> <?php echo $stin_code; ?>
			</div>
			<div class="col-4">
				<label for="">Job Order No. :</label> <?php echo $stin_title; ?>
			</div>
		</div>
		<div class="row">


			<div class="col">
				<label for="">Prepared By:</label> <?php echo $emp_name; ?>
			</div>
			<div class="col">
				<label for="">Department:</label> <?php echo $dept_name; ?>
			</div>
			<div class="col"><label for="">TON Date:</label> <?php echo $date; ?> </div>
		</div>
		<br>
		<div class="table-responsive">
			<table class="table">
				<tr style="text-align: left;">
					<th>ITEMS</th>
					<th>QUANTITY</th>
					<th>Item Remarks</th>
				</tr>
				<?php
				include "../php/config.php";
				$sql = "SELECT product.product_name,stin_product.stin_temp_qty,unit_tb.unit_name,stin_product.stin_temp_remarks
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
						<td><?php echo $irow['stin_temp_qty'] ?> <?php echo $irow['unit_name'] ?></td>
						<td><?php echo $irow['stin_temp_remarks'] ?></td>
						</tr>
				<?php }
				} ?>
				<tr>
					<td><label style="font-weight: bold;"> Remarks :</label> <?php echo $stin_remarks ?></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col">
			<button class="btn btn-primary" id="doPrint">Print Record</button>
			<a href="../stin_main.php"><button class="btn btn-danger"> Cancel</button></a>
		</div>
	</div>
</div>
</table>


<script>
	document.getElementById("doPrint").addEventListener("click", function() {
		var printContents = document.getElementById('printDiv').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	});
</script>