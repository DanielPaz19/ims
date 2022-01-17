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
SELECT product.product_id, product.product_name, class_tb.class_name, product.qty, unit_tb.unit_name, unit_tb.unit_id, product.pro_remarks, loc_tb.loc_name,loc_tb.loc_id, product.barcode, product.price, product.cost, dept_tb.dept_name, dept_tb.dept_id, class_tb.class_id, product_type.product_type_name, product_type.product_type_id
FROM product
LEFT JOIN class_tb ON product.class_id = class_tb.class_id
LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
LEFT JOIN loc_tb ON product.loc_id = loc_tb.loc_id
LEFT JOIN dept_tb ON product.dept_id = dept_tb.dept_id
LEFT JOIN product_type ON product.product_type_id = product_type.product_type_id
WHERE product.product_id LIKE '%$qry%' OR product.barcode LIKE '%$qry%'  OR product.product_name LIKE '%$qry%'
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
<table width="100%" class="itemlist" id="hover">
  <tr>
    <th width="10%">Prod. ID</th>
    <th width="30%">Item</th>
    <th width="10%">Class</th>
    <th width="2.5%">Quantity</th>
    <th width="2.5%">Unit</th>
    <th width="10%">Remarks</th>
    <th width="5%">Location</th>
    <th width="5%">Barcode</th>
    <th width="5%">Price</th>
    <th width="5%">Cost</th>
    <th width="5%">Department</th>
    <th style="text-align: center;" width="10%">Action</th>
  </tr>
';
if ($total_data > 0) {
  foreach ($result as $row) {
    $output .= '
    <tr>
      <td>' . str_pad($row['product_id'], 8, 0, STR_PAD_LEFT) . '</td>
      <td>' . $row["product_name"] . '</td>
      <td>' . $row["class_name"] . '</td>
      <td>' . $row["qty"] . '</td>
      <td>' . $row["unit_name"] . '</td>
      <td>' . $row["pro_remarks"] . '</td>
      <td>' . $row["loc_name"] . '</td>
      <td>' . $row["barcode"] . '</td>
      <td>' . $row["price"] . '</td>
      <td>' . $row["cost"] . '</td>
      <td>' . $row["dept_name"] . '</td>
      <td>
<center>
      <a href="edit/itemlist_edit.php?id=' . $row["product_id"] . "&class=" . $row["class_id"] . "&className=" . $row["class_name"] . "&unitId=" . $row["unit_id"] . "&unit=" . $row["unit_name"] . "&dept=" . $row["dept_name"] . "&deptId=" . $row["dept_id"] . "&loc=" . $row["loc_name"] . "&locId=" . $row["loc_id"] . "&proRemarks=" . $row["pro_remarks"] . "&price=" . $row["price"] . "&cost=" . $row["cost"] . "&barcode=" . $row["barcode"] . "&typeId=" . $row["product_type_id"] . "&typeName=" . $row["product_type_name"] . '" title="Edit Item"><i class="fa fa-edit" style="font-size:25px"></i></a>
      &nbsp;
      <a href="item_movement.php?id=' . $row["product_id"] . '" title="View History"><i class="fa fa-history" style="font-size:25px"></i></a>
      &nbsp;
    
</center>
      </td>
    </tr>
    ';
  }
} else {
  $output .= '
  <tr>
    <td colspan="12" align="center"><font color="red"><b><i>RECORD NOT FOUND&nbsp;<i style="color: red;" class="fas fa-exclamation-circle"></i></i></b></font></td>
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
      <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if ($previous_id > 0) {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '"><i class="fa fa-angle-double-left"></i></a></li>';
    } else {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if ($next_id >= $total_links) {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a>
      </li>
        ';
    } else {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '"><i class="fa fa-angle-double-right"></i></a></li>';
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
