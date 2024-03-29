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
SELECT rt_tb.rt_id, rt_tb.rt_no, rt_tb.rt_date, customers.customers_name, user.user_name, rt_tb.closed
FROM rt_tb
LEFT JOIN customers ON customers.customers_id = rt_tb.customers_id
LEFT JOIN user ON user.user_id = rt_tb.user_id
 ";

if ($_POST['query'] != '') {
    $query .= '
  WHERE rt_tb.rt_no LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%" 
  ';
}

$query .= 'ORDER BY rt_tb.rt_id DESC ';

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
    <th width="15%">RT No.</th>
    <th width="40%">Customer</th>
    <th width="10%"><center>Create Date</th>
    <th width="20%"><center>Action</th>
    <th width="10%"><center>Created By</th>
    <th width="10%"><center>Status</th>
    
  </tr>
';
if ($total_data > 0) {
    foreach ($result as $row) {
        $closed = $row["closed"];

        if ($closed == 0) {
            $str = '<font color="green"><i class="fas fa-unlock" style="font-size:24px" title="Transaction Open"></i></font>';
            $disable = ' <a href="rt_edit-page.php?edit&id=' . $row["rt_id"] . '" disabled> <i class="fa fa-edit" style="font-size:26px" title="Edit"></i></a>
        &nbsp;&nbsp;&nbsp;
                  <a href="#" onclick="confirmAction()"><font color="red"><i class="fa fa-trash-o" style="font-size:26px"></i></font></a>
        &nbsp;&nbsp;&nbsp;
                  <a href="commit/rt_commit.php?id=' . $row["rt_id"] . '">
                      <i class="fa fa-check-square-o" style="font-size:26px" title="Commit"></i></a>
        &nbsp;&nbsp;&nbsp;';
        } else {
            $str = '<font color="red"><i class="fas fa-lock" style="font-size:24px" title="Transaction Closed"></i></font>';
            $disable = ' 
        
        <i class="fa fa-edit" style="font-size:26px; color: gray" title="Transaction Already Closed !" ></i>
         &nbsp;&nbsp;&nbsp;
        <i class="fa fa-trash-o" style="font-size:26px; color: gray" title="Transaction Already Closed !"></i>
        &nbsp;&nbsp;&nbsp;
        <i class="fa fa-check-square-o" style="font-size:26px; color: gray"" title="Transaction Already Closed !"></i>
        &nbsp;&nbsp;&nbsp;';
        }
        $dateString = $row['rt_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');

        $output .= '
      <tr>
        <td >' . str_pad($row["rt_id"], 8, 0, STR_PAD_LEFT) . '</td>
        <td>' . $row["rt_no"] . '</td>
        <td>' . $row["customers_name"] . '</td>
        <td style="letter-spacing:1px;text-align:center">' . $date . '</td>
        <td><center>
                 ' . $disable . '
                  <a href="view/viewrt.php?id=' . $row["rt_id"] . '">
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