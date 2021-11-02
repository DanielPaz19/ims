<?php
include 'config.php';


$query = "SELECT * FROM sup_tb 
          WHERE sup_name LIKE '%" . $_GET['q'] . "%' ORDER BY sup_id LIMIT 20";

$output = [];

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
  }
} else {
  echo "No result";
}

echo json_encode($output);
