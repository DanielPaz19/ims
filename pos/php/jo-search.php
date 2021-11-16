<?php

if (isset($_POST['joSearch'])) {
  require 'config.php';

  $joSearch = $_POST['joSearch'];

  $joResult = mysqli_query($db, "SELECT jo_tb.jo_id, jo_tb.jo_no, jo_tb.customers_id, customers.customers_name , jo_tb.jo_date 
FROM jo_tb 
LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id 
WHERE jo_no LIKE '%$joSearch%'
ORDER BY jo_no");

  $output = [];


  if (mysqli_num_rows($joResult) > 0) {
    while ($row = mysqli_fetch_assoc($joResult)) {
      $output[] = $row;
    }
  }

  echo json_encode($output);
}



// $q = $_GET['q'];

// $query = "SELECT * FROM customers WHERE customers_name LIKE '%$q%' ORDER BY customers_id LIMIT 20";

// $output = [];

// $result = mysqli_query($db, $query);
// if (mysqli_num_rows($result) > 0) {
//   while ($row = mysqli_fetch_assoc($result)) {
//     $output[] = $row;
//   }
// } else {
//   echo "No result";
// }

// echo json_encode($output);
