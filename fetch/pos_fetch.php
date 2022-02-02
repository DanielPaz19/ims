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
$qry = str_replace(' ', '%', $_POST['query']);
$query = "
SELECT order_tb.order_id, customers.customers_name, order_tb.pos_date, jo_tb.jo_no, jo_tb.jo_date, user.user_name
FROM order_tb
LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
LEFT JOIN jo_tb ON jo_tb.jo_id = order_tb.jo_id
LEFT JOIN user ON user.user_id = order_tb.user_id
WHERE customers.customers_name LIKE '%$qry%' OR order_tb.order_id LIKE '%$qry%' OR jo_tb.jo_no LIKE '%$qry%' ORDER BY order_tb.order_id DESC

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
<table width="100%">
  <tr style="text-align:left;">
    <th>Order ID</th>
    <th>Customer</th>
    <th>POS Date</th>
    <th>JO No.</th>
    <th>JO Date</th>
    <th><center>Created By</center></th>
    <th><center>Action</center></th>
    
  </tr>
';
if ($total_data > 0) {
    foreach ($result as $row) {
        $dateString = $row['pos_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
        $dateString2 = $row['jo_date'];
        $dateTimeObj2 = date_create($dateString2);
        $date2 = date_format($dateTimeObj2, 'm/d/y');



        $output .= '
    <tr>
      <td>' . str_pad($row["order_id"], 8, 0, STR_PAD_LEFT) . '</td>
      <td>' . $row["customers_name"] . '</td>
      <td>' . $date . '</td>
      <td style="letter-spacing:1px;text-align:left">' . $row["jo_no"] . '</td>
      <td style="letter-spacing:1px;text-align:left">' . $date2 . '</td>
 
      <td style="letter-spacing:1px;text-align:center">' . $row["user_name"] . '</td> 
      <td style="letter-spacing:1px;text-align:center"><a href="view/pos_report-view.php?id=' . $row["order_id"] . '"><button>View Records</button></a></td>
      
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