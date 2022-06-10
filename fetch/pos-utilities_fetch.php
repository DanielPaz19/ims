<?php

$connect = new PDO("mysql:host=localhost; dbname=inventorymanagement", "root", "");


$limit = '10';
$page = 1;
if ($_POST['page'] > 1) {
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
} else {
  $start = 0;
}
$qry = str_replace(' ', '%', $_POST['query']);
$query = "
SELECT order_tb.order_id, customers.customers_name, order_tb.dr_number,order_tb.pos_date,order_status.order_status_name, order_tb.jo_id,order_status.order_status_id,customers.tax_type_id
                FROM order_tb
                LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
                LEFT JOIN order_status ON order_status.order_status_id = order_tb.order_status_id
                WHERE customers.customers_name LIKE '%$qry%' OR order_tb.dr_number LIKE '%$qry%'
                ORDER BY order_tb.order_id DESC

                
";


$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$statement = $connect->prepare($query);
$statement->execute();
$total_data = $statement->rowCount();

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();

$output = '
<br>
<table id="datatable-buttons" class="table table-hover table-bordered table-striped">
<tr>
<th>Order ID</th>
<th>DR NO.</th>
<th>Customer</th>
<th><center>Date</center></th>
<th><center>Status</center></th>

<th><center>Action</center></th>

</tr>
';

if ($total_data > 0) {
  foreach ($result as $irow) {
    $dateString = $irow['pos_date'];
    $dateTimeObj = date_create($dateString);
    $date = date_format($dateTimeObj, 'm/d/y');
    $stsId = $irow['order_status_id'];
    if ($stsId == 1) {
      $str = '<div style="padding:4px" class="alert alert-primary" role="alert">
      <i class="bi bi-hourglass-split"></i> Pending
    </div>';
    }
    if ($stsId == 2) {
      $str = '<div style="padding:4px" class="alert alert-primary" role="alert">
      Releasing
    </div>';
    }
    if ($stsId == 3) {
      $str = '<div style="padding:4px" class="alert alert-success" role="alert">
      <i class="bi bi-check2-circle"></i> Completed
    </div>';
    }
    if ($stsId == 4) {
      $str = '<div style="padding:4px" class="alert alert-danger" role="alert">
      <i class="bi bi-x-circle"></i> Canceled
    </div>';
    }

    $output .= '
    <tr >
      <td style="margin-bottom:0">' . str_pad($irow['order_id'], 8, 0, STR_PAD_LEFT) . '</td>
      <td style="margin-bottom:0">' . $irow['dr_number'] . '</td>
      <td style="margin-bottom:0">' . $irow['customers_name'] . '</td>
      
      <td><center>' . $date . '</center></td>

      <td><center>   ' . $str . ' </center></td>
      <td>
<center>
<a href="view/viewdr2.php?id=' . $irow["order_id"] . '&joId=' . $irow['jo_id'] . '">
<button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-printer"></i> Re-Print DR</button></a>


<a href="view/viewsi2.php?id=' . $irow["order_id"] . '&joId=' . $irow['jo_id'] . '&taxId=' . $irow['tax_type_id'] . '">
<button type="button" class="btn  btn-outline-primary btn-sm"><i class="bi bi-receipt"></i> Sales Invoice</button></a>

<a href="#">
<button type="button" class="btn  btn-outline-info btn-sm">Generate OR</button></a>

<a href="pos-utilities_return.php?id=' . $irow["order_id"] . '&joId=' . $irow['jo_id'] . '">
<button type="button" class="btn  btn-outline-danger btn-sm"><i class="bi bi-box-arrow-in-down"></i> Return Item</button></a>


      </td>
     
      
    </tr>
    ';
  }
} else {
  $output .= '
  <tr>
    <td colspan="12" align="center"><div class="alert alert-danger" role="alert">No Record Found !</div></td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<label class="tableLabel" style="color:midnightblue; letter-spacing:1px">Total Records Found - ' . $total_data . '</label>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($total_data / $limit);
$previous_link = '';
$next_link = '';
$page_link = '';
$page_array = [];


//echo $total_links;

if ($total_links > 4) {
  if ($page < 5) {
    for ($count = 1; $count <= 5; $count++) {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  } else {
    $end_limit = $total_links - 5;
    if ($page > $end_limit) {
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $end_limit; $count <= $total_links; $count++) {
        $page_array[] = $count;
      }
    } else {
      $page_array[] = 1;
      $page_array[] = '...';
      for ($count = $page - 1; $count <= $page + 1; $count++) {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
} else {
  for ($count = 1; $count <= $total_links; $count++) {
    $page_array[] = $count;
  }
}

for ($count = 0; $count < count($page_array); $count++) {

  if ($page == $page_array[$count]) {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only"></span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if ($previous_id > 0) {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '"><i class="bi bi-arrow-left-square"></i></a></li>';
    } else {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#"><i class="bi bi-arrow-left-square"></i></a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if ($next_id >= $total_links) {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#"><i class="bi bi-arrow-right-square"></i></a>
      </li>
        ';
    } else {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '"><i class="bi bi-arrow-right-square"></i></a></li>';
    }
  } else {
    if ($page_array[$count] == '...') {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    } else {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
<br />
';

echo $output;
