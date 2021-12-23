<?php

require 'config.php';

// Load all JO Data
$qryJo = "SELECT * FROM  jo_tb ";
$resultJo = mysqli_query($db, $qryJo);

$output = [];
if (mysqli_num_rows($resultJo) > 0) {
  while ($rowJo = mysqli_fetch_assoc($resultJo)) {

    // Run Select for product array for each jo_id

    $rowJo['items'] = [];
    $output[] = $rowJo;
    // Insert product Id on product Array based on jo_id and push to each output

  }
}

echo json_encode($output);

// Filter JO Data so that only those that are not fully paid will appear