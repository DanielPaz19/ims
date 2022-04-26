<!DOCTYPE html>
<html lang="en">
<?php
include('php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];
  $result = mysqli_query($db, "SELECT * FROM product WHERE product_id=" . $_GET['id']);

  $row = mysqli_fetch_array($result);

  if ($row) {

    $id = $row['product_id'];
    $product_name = $row['product_name'];
    $class = $row['class_id'];
    $unit = $row['unit_id'];
    $pro_remarks = $row['pro_remarks'];
    $loc_id = $row['loc_id'];
    $barcode = $row['barcode'];
    $price = $row['price'];
    $cost = $row['cost'];
    $dept = $row['dept_id'];
  } else {
    echo "No results!";
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table {
      overflow: scroll;
    }
  </style>
  <title>Item History</title>
</head>
<?php include('header_main.php'); ?>

<body>
  <div class="container-sm">
    <a class="back-button" href="itemlist_main.php">
      <p class="mt-3" style="float:right;padding:2%"><i class="bi bi-backspace"></i> Back to Itemlist</p>
    </a>
    <div class="shadow-lg p-5 mb-5 mt-5 bg-rounded" style="background-color: white;border: 5px solid #cce0ff">
      <h3 style="color: #0d6efd;letter-spacing:2px"><i class="bi bi-boxes"></i> Itemlist : Item Movement </h3>
      <hr>
      <div class="row">
        <div class="col-4">
          <h5><?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?></h5>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h5><?php echo $product_name ?></h5>
        </div>
      </div>


      <br>

      <div class="table-responsive">
        <table class="table table-hover" style="height: 100%;">
          <tr>
            <th>Movement ID</th>
            <th>PROCESS</th>
            <th>REFERENCE NO</th>
            <th>IN</th>
            <th>OUT</th>
            <th>BALANCE</th>
            <th style="text-align: center;">Process Date</th>
          </tr> <?php
                include "php/config.php";

                $sql = "SELECT move_product.move_id, move_type.mov_type_name, move_product.move_ref, po_tb.po_code, move_product.in_qty, move_product.out_qty, move_product.bal_qty, move_product.mov_date, move_product.mov_type_id, stout_tb.stout_code, stin_tb.stin_code, ep_tb.ep_no, ol_tb.ol_si, rt_tb.rt_no, pinv_tb.pinv_title, order_tb.order_id, order_tb.dr_number

       FROM move_product 

       INNER JOIN move_type ON move_product.mov_type_id = move_type.mov_type_id

       INNER JOIN product ON product.product_id = move_product.product_id

			 LEFT JOIN po_tb ON move_product.move_ref = po_tb.po_id

			 LEFT JOIN stout_tb ON move_product.move_ref = stout_tb.stout_id

			 LEFT JOIN stin_tb ON move_product.move_ref = stin_tb.stin_id

       LEFT JOIN ep_tb ON move_product.move_ref = ep_tb.ep_id

       LEFT JOIN ol_tb ON move_product.move_ref = ol_tb.ol_id
       LEFT JOIN pinv_tb ON move_product.move_ref = pinv_tb.pinv_id
       LEFT JOIN rt_tb ON move_product.move_ref = rt_tb.rt_id
       LEFT JOIN order_tb ON move_product.move_ref = order_tb.order_id

       WHERE move_product.product_id = '$id'
       ORDER BY move_id ASC";


                $result = $db->query($sql);
                $count = 0;
                if ($result->num_rows >  0) {

                  while ($irow = $result->fetch_assoc()) {
                    $count = $count + 1;
                    $dateString = $irow['mov_date'];
                    $dateTimeObj = date_create($dateString);
                    $date = date_format($dateTimeObj, 'm/d/y');
                ?>
              <tr>
                <td><?php echo str_pad($irow["move_id"], 8, 0, STR_PAD_LEFT) ?></td>
                <td><?php echo $irow['mov_type_name']; ?></td>
                <td><?php

                    switch ($irow['mov_type_id']) {

                      case '1':
                        echo $irow['stin_code'];
                        break;
                      case '2':
                        echo $irow['stout_code'];
                        break;
                      case '3':
                        echo $irow['po_code'];
                        break;
                      case '4':
                        echo 'DR# ' . $irow['dr_number'];
                        break;
                      case '5':
                        echo 'Beginning';
                        break;
                      case '6':
                        echo 'EP# ' . $irow['ep_no'];
                        break;

                      case '7':
                        echo $irow['pinv_title'];
                        break;

                      case '8':
                        echo $irow['ol_si'];
                        break;

                      case '9':
                        echo $irow['rt_no'];
                        break;

                      case '10':
                        echo 'Order No.  ' . $irow['order_id'] . ' , DR#' . $irow['dr_number'];
                        break;

                      default:
                        break;
                    }

                    ?>
                </td>
                <td><?php echo $irow['in_qty']; ?></td>
                <td><?php echo $irow['out_qty']; ?></td>
                <td><?php

                    switch ($irow['mov_type_id']) {

                      case '1':
                        echo $irow['bal_qty'] + $irow['in_qty'];
                        break;
                      case '2':
                        echo $irow['bal_qty'] - $irow['out_qty'];
                        break;
                      case '3':
                        echo $irow['bal_qty'] + $irow['in_qty'];
                        break;

                      case '4':
                        echo $irow['bal_qty'] - $irow['out_qty'];
                        break;

                      case '5':
                        echo $irow['bal_qty'];
                        break;

                      case '6':
                        echo $irow['bal_qty'] - $irow['out_qty'];
                        break;

                      case '7':
                        echo $irow['bal_qty'];
                        break;

                      case '8':
                        echo $irow['bal_qty'] - $irow['out_qty'];
                        break;

                      case '9':
                        echo $irow['bal_qty'] + $irow['in_qty'];
                        break;

                      case '10':
                        echo $irow['bal_qty'] + $irow['in_qty'];
                        break;

                      default:
                        break;
                    }

                    ?>
                </td>
                <td style="font-weight: bolder; letter-spacing:2px;text-align: center;"><?php echo $date; ?></td>


              </tr>
          <?php }
                } ?>
        </table>

        </table>
      </div>
    </div>
  </div>
  <?php include('footer.php'); ?>

</html>