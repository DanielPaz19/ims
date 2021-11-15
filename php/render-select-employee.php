<?php

require 'config.php';

$empResult = mysqli_query(
  $db,
  "SELECT employee_tb.emp_id, employee_tb.emp_name
  FROM employee_tb ORDER BY emp_name"
);

$output = "";

if (mysqli_num_rows($empResult) > 0) {
  while ($row = mysqli_fetch_assoc($empResult)) {
    $output .= "<option value='" . $row['emp_id'] . "'>" . $row['emp_name'] . "</option>";
  }
}

echo $output;
