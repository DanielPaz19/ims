<?php

//Check closed value if 1 or 0
//- Select query for stin_tb

if (isset($_GET['return'])) {

	include "php/config.php";

	$bal_qty = $_GET['bal_qty'];
	$in_qty = $_GET['in_qty'];
	$productId = $_GET['product_id'];
	$order_id = $_GET['order_id'];
	$mov_date = $_GET['mov_date'];
    $user_id = $_GET['user_id'];
    $reason_id = $_GET['reason_id'];
    $reason_remarks = $_GET['reason_remarks'];
    $return_total = $_GET['return_total'];
    $return_price = $_GET['return_price'];
    $joId = $_GET['joId'];


	// $sql = "SELECT closed FROM stin_tb WHERE order_id = " . $_GET['order_id'];
	// $result = mysqli_query($db, $sql);

	// if (mysqli_num_rows($result) > 0) {
	// 	// output data of each row
	// 	while ($row = mysqli_fetch_assoc($result)) {
	// 		$closed = $row['closed'];
	// 	}
	// } else {
	// 	echo "0 results";
	// }


	// if ($closed == 0) {
	// 	foreach ($_GET['stin_temp_tot'] as $stin_temp_tot) {
	// 		$total[] = $stin_temp_tot;
	// 	}

		foreach ($_GET['product_id'] as $product_id) {
			$pro_id[] = $product_id;
		}

		//update database by number of row in stin_commit or number of product ID

        $sql = "INSERT INTO return_tb (order_id,user_id,reason_id,reason_remarks) 
        VALUES ('$order_id','$user_id','$reason_id','$reason_remarks')";
		mysqli_query($db, $sql);

    }
		$sql = "UPDATE order_tb SET order_status_id = 4 WHERE order_id = " . $_GET['order_id'];
		mysqli_query($db, $sql);

        $sql = "UPDATE jo_tb SET jo_status_id = 2 WHERE jo_id = " .$joId;
		mysqli_query($db, $sql);

		$limit = 0;
        $total[] = $return_total;
		while ($limit != count($pro_id)) {

            $sql = "INSERT INTO return_product (product_id,return_qty,return_total,return_price) 
            VALUES ('$pro_id[$limit]','$in_qty[$limit]','$return_total[$limit]','$return_price[$limit]')";
            mysqli_query($db, $sql);


			$sql = "UPDATE product SET qty = " . $return_total[$limit] . " WHERE product_id=" . $pro_id[$limit];

			mysqli_query($db, $sql);

			$limit += 1;
		}

		$limit = 0;
		while (sizeof($productId) !== $limit) {

			$sql = "INSERT INTO move_product (product_id,bal_qty,in_qty,mov_type_id,move_ref,mov_date)
            VALUES (" . $productId[$limit] . "," . $bal_qty[$limit] . "," . $in_qty[$limit] . ", 10 " . "," . $order_id . ",'" . $mov_date . "')";
			if (mysqli_query($db, $sql)) {
				
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($db) . "<br>" . "<br>";
			}

			$limit++;
		}
	// } else {
	// 	$status = "Transaction Closed, Viewing Purpose Only !";
	// 	echo "<script> alert('" . $status . "')</script>";
	// }
	header("location: pos-utilities.php");

