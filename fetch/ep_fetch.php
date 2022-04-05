<?php

$connect = new PDO("mysql:host=localhost; dbname=inventorymanagement", "root", "@Dmin898");

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
$qry = str_replace(' ', '%', $_POST['query']);
$query = "
SELECT ep_tb.ep_id, ep_tb.ep_no, ep_tb.ep_title, ep_tb.ep_date, customers.customers_name, ep_tb.closed, user.user_name, customers.customers_id
FROM ep_tb
LEFT JOIN customers ON customers.customers_id = ep_tb.customers_id
LEFT JOIN user ON user.user_id = ep_tb.user_id
WHERE ep_tb.ep_no LIKE '%$qry%' OR ep_tb.ep_title LIKE '%$qry%' OR customers.customers_name LIKE '%$qry%' ORDER BY ep_tb.ep_id DESC
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
<table class="table table-hover" width="100%">
<tr style="background-color:#0d6efd;color:white">
    <th>EP ID</th>
    <th>EP No.</th>
    <th>Title</th>
    <th>Customer</th>
    <th><center>Date</th>
    <th><center>Action</th>
    <th><center>Created By</th>
    <th><center>Status</th>
    
  </tr>
';
if ($total_data > 0) {
    foreach ($result as $row) {
        $closed = $row["closed"];
        $dateString = $row['ep_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');


        if ($closed == 0) {
            $str = '<p style="color:green;font-weight:bold;font-size:25px"><i class="bi bi-unlock-fill"></i></p>';
            $disable = ' 

                <a href="../ims/ep_edit-page.php?editEp&id=' . $row["ep_id"] . '" disabled> <button class="btn btn-success" title="Edit"><i class="bi bi-pencil-fill"></i></button></a> 

                <a href="commit/ep_commit.php?id=' . $row["ep_id"] . '">
                <button class="btn btn-primary" title="Commit Record"><i class="bi bi-check2-circle"></i></button></a>

                <a href="delete/ep_delete.php?id=' . $row["ep_id"] . '" onclick="confirmAction()"><font color="red"><button class="btn btn-danger" title="Delete"><i class="bi bi-trash3-fill"></i></button></a>
 
                
     ';
        } else {
            $str = '<p style="color:red;font-weight:bold;font-size:25px"><i class="bi bi-lock-fill"></i></p>';
            $disable = ' 
            <button class="btn" title="Edit" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-pencil-fill" ></i></button>
            <button class="btn" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-check2-circle"></i></button>
             <button class="btn" title="Delete" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-trash3-fill"></i></button>';
        }
        $output .= '
    <tr>
      <td>' . str_pad($row["ep_id"], 8, 0, STR_PAD_LEFT) . '</td>
      <td>' . $row["ep_no"] . '</td>
      <td>' . $row["ep_title"] . '</td>
      <td>' . $row["customers_name"] . '</td>
      <td style="letter-spacing:1px;text-align:center">' . $date . '</td>
      <td><center>
               ' . $disable . '
                <a href="view/viewep2.php?id=' . $row["ep_id"] . '&epNo=' . $row["ep_no"] . '">
                <button class="btn btn-info" title="Details" style=""><i class="bi bi-eye-fill" style="color:white"></i></button></a>
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
<label class="tableLabel" style="float:right; color:gray;">Total Records - ' . $total_data . '</label>
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