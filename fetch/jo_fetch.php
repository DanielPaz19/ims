<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<?php

$connect = new PDO("mysql:host=localhost; dbname=inventorymanagement", "root", "");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/

$limit = '10';
$page = 1;
if ($_POST['page'] > 1) {
    $start = (($_POST['page'] - 1) * $limit);
    $page = $_POST['page'];
} else {
    $start = 0;
}

$query = "
SELECT jo_tb.jo_id, jo_tb.jo_no, customers.customers_name, employee_tb.emp_name, jo_tb.jo_date, jo_tb.closed, user.user_name, jo_tb.jo_type_id, jo_type.jo_type_name, jo_tb.jo_status_id,customers_company
FROM jo_tb
LEFT JOIN customers ON customers.customers_id = jo_tb.customers_id
LEFT JOIN user ON user.user_id = jo_tb.user_id
LEFT JOIN employee_tb ON employee_tb.emp_id = jo_tb.emp_id
LEFT JOIN jo_type ON jo_type.jo_type_id = jo_tb.jo_type_id
LEFT JOIN jo_status ON jo_status.jo_status_id = jo_tb.jo_status_id

 ";

if ($_POST['query'] != '') {
    $query .= "
  WHERE customers_name LIKE '%" . $_POST['query'] . "%' OR jo_no LIKE '%" . $_POST['query'] . "%' 
  ";
}

$query .= 'ORDER BY jo_id DESC ';

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
<table class="table table-hover table-sm" width="100%" style="cursor:pointer;">
  <tr style="background-color:#0d6efd;color:white">
    <th width="10%"">JO ID</th>
    <th width="10%">Job-Order No. </th>
    <th width="30%">Customer</th>
    <th width="10%">Prepared By</th>
    <th width="10%"><center>Create Date</th>
    <th width="15%"><center>Action</th>
    <th width="10%"><center>Created By</th>
    <th width="5%"><center>Status</th>
    
  </tr>
';
if ($total_data > 0) {
    foreach ($result as $row) {
        $closed = $row["jo_status_id"];

        if ($closed == 1) {
            $str = '<font color="green"><i class="bi bi-check-circle" style="font-size:24px" title="Normal"></i></font>';
            $disable = '<a href="../ims/jo_edit-page.php?editJo&id=' . $row["jo_id"] . '&joTypeId=' . $row['jo_type_id'] . '&joTypeName=' . $row['jo_type_name'] . '" disabled> <button class="btn btn-success" title="Edit"><i class="bi bi-pencil-fill"></i></button></a>
   
      <button class="btn btn-danger" title="Delete" style="cursor:not-allowed"><i class="bi bi-trash3-fill"></i></button></a>
               
      &nbsp;&nbsp;&nbsp;';
        } else {
            $str = '<font color="red"><i class="bi bi-x-circle" style="font-size:24px" title="Canceled"></i></font>';
            $disable = ' 
      
      <i class="fa fa-edit" style="font-size:26px; color: gray" title="Job Order already canceled !" ></i>
       &nbsp;&nbsp;&nbsp;
      <i class="fa fa-trash-o" style="font-size:26px; color: gray" title="Job Order already canceled !"></i>
      &nbsp;&nbsp;&nbsp;
      
';
        }
        $dateString = $row['jo_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
        $output .= '
    <tr>
      <td>' . str_pad($row["jo_id"], 8, 0, STR_PAD_LEFT) . '</td>
      <td>' . $row["jo_no"] . '</td>
      <td>' . $row["customers_company"] . '</td>
      <td>' . $row["emp_name"] . '</td>
      <td style="letter-spacing:1px;text-align:center">' . $date . '</td>
      <td><center>
               ' . $disable . '
               
                    
      </center>
               
      </td>
      <td><center>' . $row["user_name"] . '</center></td>
      <td><center>' . $str . '</center></td>
      
    </tr>
    ';
    }
} else {
    $output .= '
  <tr>
    <td colspan="10" align="center"><div class="alert alert-danger" role="alert">
    No Records found !
   </div></td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<label style="float:right; color:gray;">Total Records - ' . $total_data . '</label>
<br />
<div align="center">
<nav aria-label="Page navigation example">
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
            $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">&laquo;</a></li>';
        } else {
            $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">&laquo;</a>
      </li>
      ';
        }
        $next_id = $page_array[$count] + 1;
        if ($next_id >= $total_links) {
            $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">&raquo;</a>
      </li>
        ';
        } else {
            $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">&raquo;</a></li>';
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
  </nav>
</div>
';

echo $output;

?>

<script>
    function confirmAction() {
        let confirmAction = confirm("Are you sure you want to delete?");
        if (confirmAction) {
            alert("Deleted item successfully!!!");
        } else {

            alert("Action canceled");
        }
    }

    function confirmUpdate() {
        let confirmUpdate = confirm("Are you sure you want to CONFIRM record?\n \nNote: Double Check Input Records");
        if (confirmUpdate) {
            alert("CONFIRM Record successfully!");
        } else {

            alert("Action Canceled");
        }
    }
</script>