<?php

require 'config.php';

$suppResult = mysqli_query(
  $db,
  "SELECT sup_tb.sup_name, sup_tb.sup_id
  FROM sup_tb ORDER BY sup_name"
);

$output = "";

if (mysqli_num_rows($suppResult) > 0) {
  while ($row = mysqli_fetch_assoc($suppResult)) {
    $output .= "<option value='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
  }
}

echo $output;
