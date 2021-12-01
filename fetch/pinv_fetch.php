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

$query = "
SELECT pinv_tb.pinv_id, pinv_tb.pinv_title, pinv_tb.pinv_location, employee_tb.emp_name, pinv_tb.pinv_date, user.user_name, pinv_tb.closed
FROM pinv_tb
LEFT JOIN user ON user.user_id = pinv_tb.user_id
LEFT JOIN employee_tb 
ON pinv_tb.emp_id = employee_tb.emp_id ";

if ($_POST['query'] != '') {
    $query .= '
  WHERE pinv_title LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';
}

$query .= 'ORDER BY pinv_id DESC ';

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
<table width="100%">
  <tr>
    <th width="5%">ID</th>
    <th width="15%">Title</th>
    <th width="20%">Location</th>
    <th width="10%">Prepared By</th>
    <th width="10%">Create Date</th>
    <th width="15%"><center>Action</th>
    <th width="10%"><center>Created By</th>
    <th width="5%"><center>Status</th>
    
  </tr>
';
if ($total_data > 0) {
    foreach ($result as $row) {
        $closed = $row["closed"];

        if ($closed == 0) {
            $str = '<font color="green"><i class="fas fa-unlock" style="font-size:24px" title="Transaction Open"></i></font>';
            $disable = ' 
                <a href="commit/pinv_commit.php?id=' . $row["pinv_id"] . '">
                    <i class="fa fa-check-square-o" style="font-size:26px" title="Commit"></i></a>
      &nbsp;&nbsp;&nbsp;';
        } else {
            $str = '<font color="red"><i class="fas fa-lock" style="font-size:24px" title="Transaction Closed"></i></font>';
            $disable = '

      <i class="fa fa-check-square-o" style="font-size:26px; color: gray"" title="Transaction Already Closed !"></i>
      &nbsp;&nbsp;&nbsp;';
        }
        $output .= '
    <tr>
      <td>' . $row["pinv_id"] . '</td>
      <td>' . $row["pinv_title"] . '</td>
      <td>' . $row["pinv_location"] . '</td>
      <td>' . $row["emp_name"] . '</td>
      <td>' . $row["pinv_date"] . '</td>
      <td><center>
               ' . $disable . '
                <a href="view/viewpinv.php?id=' . $row["pinv_id"] . '">
                    <i class="fa fa-eye" style="font-size:26px" title="Details"></i></a>
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
    <td colspan="10" align="center"><font color="red"><b>No Data Found ! </b></font></td>
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
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

        $previous_id = $page_array[$count] - 1;
        if ($previous_id > 0) {
            $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
        } else {
            $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Previous</a>
      </li>
      ';
        }
        $next_id = $page_array[$count] + 1;
        if ($next_id >= $total_links) {
            $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Next</a>
      </li>
        ';
        } else {
            $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
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