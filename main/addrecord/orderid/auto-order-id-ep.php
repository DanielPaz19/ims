<?php

include '../../../php/config.php';
$query = "SELECT ep_id FROM ep_tb ORDER BY ep_id DESC LIMIT 1";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $newOrderId = $row['ep_id'] + 1;
        echo "<input style='border:none; font-weight:bolder; color:grey;' name='ep_id' value='" . $newOrderId . "'>";
    }
} else {
    echo "No result.";
}
