<?php

include '../../../php/config.php';
$query = "SELECT jo_id FROM jo_tb ORDER BY jo_id DESC LIMIT 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $newOrderId = $row['jo_id'] + 1;
        echo "<input style='border:none; font-weight:bolder; color:grey;' name='jo_id' value='" . $newOrderId . "' readonly>";
    }
} else {
    echo "No result.";
}