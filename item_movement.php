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
<html>
<title>Item History</title>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: sans-serif;
      background-color: #B0C4DE;
      padding: 30px;
    }


    .content {

      padding: 100px;
      background-color: #EAEAEA;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      height: 1000px;


    }



    .top {

      letter-spacing: 3px;
      line-height: 1%;
      padding-top: 10px;

    }

    .labels {
      margin-left: 40px;
      margin-right: 40px;
    }


    .itemtb {
      border-collapse: collapse;
      width: 100%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
    }


    .itemtb th {
      background-color: midnightblue;
      color: white;
      text-align: left;
      padding: 10px;
      border: 1px solid lightgrey;
    }


    .itemtb td {
      text-align: left;
      border: 1px solid grey;
      font-size: 15px;
      padding: 7px;

    }

    tr:nth-child(even) {
      background-color: #C0C0C0;
    }


    .footer {
      margin-left: 40px;
      margin-right: 40px;
    }
  </style>


</head>


<body>
  <a href="itemlist_main.php" style="float:right; margin-right: 50px; margin-top: 50px;"><i class="fa fa-close" style="font-size:24px"></i></a>
  <div class="content">
    <h1 style="letter-spacing: 3px;">ITEM MOVEMENT : <?php echo $product_name; ?></h1>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <table width="50%" class="itemTb">
      <tr>
        <th>ID</th>
        <th>PROCESS</th>
        <th>REFERENCE NO</th>
        <th>IN</th>
        <th>OUT</th>
        <th>BALANCE</th>
        <th>Process Date</th>
      </tr>
      <?php
      include "php/config.php";

      $sql = "SELECT move_product.move_id, move_type.mov_type_name, move_product.move_ref, po_tb.po_code, move_product.in_qty, move_product.out_qty, move_product.bal_qty, move_product.mov_date, move_product.mov_type_id, stout_tb.stout_code, stin_tb.stin_code

       FROM move_product 

       INNER JOIN move_type ON move_product.mov_type_id = move_type.mov_type_id

       INNER JOIN product ON product.product_id = move_product.product_id

			 LEFT JOIN po_tb ON move_product.move_ref = po_tb.po_id

			 LEFT JOIN stout_tb ON move_product.move_ref = stout_tb.stout_id

			 LEFT JOIN stin_tb ON move_product.move_ref = stin_tb.stin_id

       WHERE move_product.product_id = '$id'
       ORDER BY move_id ASC";


      $result = $db->query($sql);
      $count = 0;
      if ($result->num_rows >  0) {

        while ($irow = $result->fetch_assoc()) {
          $count = $count + 1;
      ?>
          <tr>
            <td><?php echo $irow['move_id']; ?></td>
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
                    echo 'pos';
                    break;
                  case '5':
                    echo 'Beginning';
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


                  default:
                    break;
                }

                ?>
            </td>
            <td><?php echo $irow['mov_date']; ?></td>
          </tr>
      <?php }
      } ?>
    </table>

  </div>
</body>


</html>