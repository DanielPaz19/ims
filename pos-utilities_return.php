<?php
session_start();
include('php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT order_tb.order_id, customers.customers_name, order_tb.pos_date, jo_tb.jo_no, jo_tb.jo_date, user.user_name,order_tb.dr_number,reason_tb.reason_name,reason_tb.reason_id,user.user_id,jo_tb.jo_id
    FROM order_tb
    LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
    LEFT JOIN jo_tb ON jo_tb.jo_id = order_tb.jo_id
    LEFT JOIN reason_tb ON reason_tb.reason_id = order_tb.reason_id
    LEFT JOIN user ON user.user_id = order_tb.user_id
    WHERE order_tb.order_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['order_id'];
        $customerName = $row['customers_name'];
        $joNo = $row['jo_no']; 
        $joId = $row['jo_id'];
        $dateString = $row['pos_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'F d, Y');
        $dateString2 = $row['jo_date'];
        $dateTimeObj2 = date_create($dateString2);
        $date2 = date_format($dateTimeObj2, 'F d, Y');
        $drNo = $row['dr_number'];
        $reasonId = $row['reason_id'];
        $reasonName = $row['reason_name'];
        $user_id = $row['user_id'];
    } else {
        echo "No results!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/bootstrap.min.css">
    <script src="source/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../img/pacclogo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Item Return</title>

</head>
<body style="background-color: #e8e8e8;">
<br><br><br>

<div class="container shadow p-3 mb-5 bg-body rounded">
    <h3 style="letter-spacing: 5px;">Item Return <i class="bi bi-box-arrow-in-down"></i></h3>
    <hr>
    <form action="pos-utilities_con.php" method="GET">
        <input type="hidden" name="order_id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        <input type="hidden" name="joId" value="<?php echo $_GET['joId']?>">

        <input type="hidden" name='mov_date' class='date'>

        <div class="row">
            <div class="col-3">
                <div class="form-floating mt-1">
                    <input type="text" class="form-control" id="email"  value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?> "readonly>
                    <label for="text">Transaction ID</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mt-1">
                    <input type="text" class="form-control" id="email"  value="<?php echo $drNo?>" readonly>
                    <label for="text">DR No.</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mt-1">
                    <input type="text" class="form-control" id="email"  value="<?php echo $joNo?>" readonly>
                    <label for="text">Job Order No.</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mt-1">
                    <input type="text" class="form-control" id="email"  value="<?php echo $date?>" readonly>
                    <label for="text">POS Date</label>
                </div>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-12">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" disabled>
                    <option selected><?php echo $customerName?></option>
                    </select>
                    <label for="floatingSelect">Customer</label>
                </div>
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-6">
                <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="reason_id" required>
                            <option class="select__option--class" value="<?php echo $reasonId; ?>"><?php echo $reasonName; ?></option>
                            <?php
                            include "php/config.php";
                            $records = mysqli_query($db, "SELECT * FROM reason_tb ORDER BY reason_name ASC");
                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['reason_id'] . "'>" . $data['reason_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Select Reason</label>
                    </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="" id="floatingTextarea" name="reason_remarks" required></textarea>
                    <label for="floatingTextarea">Remarks</label>
                </div>
            </div>
        </div>
        <hr>
        <div class="container mt-3">         
                    <table class="table">
                    <tr style="text-align: left;">
                        <th>Product ID</th>
                        <th>Item Description</th>
                        <th>Qty-Order</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Subtotal</th>

                    </tr>
                    <?php
                    $sql = "SELECT product.product_id, product.product_name, order_product.pos_temp_qty, unit_tb.unit_name, order_product.pos_temp_price, product.qty
                        FROM order_product
                        LEFT JOIN product ON product.product_id = order_product.product_id
                        LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
                    
                        WHERE order_product.order_id='$id'  ";

                    $result = $db->query($sql);
                    $count = 0;

                    if ($result->num_rows >  0) {

                        while ($irow = $result->fetch_assoc()) {
                            $count = $count + 1;
                            $total[] = $irow["pos_temp_qty"] * $irow["pos_temp_price"];

                    ?>
                        <tr>
                            <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT) ?></td>
                            <td><?php echo $irow["product_name"] ?></td>
                            <td><input type="number" name="in_qty[]" value="<?php echo $irow['pos_temp_qty'] ?>" style="border: none"></td>
                            <td><?php echo $irow["unit_name"] ?></td>
                            <td><input type="text" name="return_price[]" value="<?php echo $irow['pos_temp_price'] ?>" style="border: none;" readonly></td>
                            <td><?php echo number_format($irow["pos_temp_qty"] * $irow["pos_temp_price"], 2)  ?></td>
                            <td><input type="hidden" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>
                            <td><input type="hidden" style="border: none" name="return_total[]" value="<?php echo $irow["qty"] + $irow["pos_temp_qty"]; ?>" contenteditable="false"></td>
                        </tr>
                            <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                    <?php }
                    } ?>
                </table>
                <table style="float: right;">
                    <tr style="text-align: left;"> 
                        <?php

                        $limit = 0;
                        $subTot = 0;
                        $disTot = 0;

                        while ($limit != count($total)) {
                        $subTot += $total[$limit];
                        // $disTot += $totaldisamount[$limit];
                        $limit += 1;
                        }

                        $grandTot = $subTot - $disTot;

                        ?>
                            <td colspan="6">
                                <label for=""> <b>Grand Total: </b> &emsp;</label><b><?php echo number_format($grandTot, 2)  ?></b>
                            </td>
                            <td>
                               
                            </td>
                        </tr>
                </table>
                
                <br><hr>

                    <div class="row">
                        <div class="col-10">
                        <button type="submit" class="btn btn-outline-success" style="float: left;" name="return"><i class="bi bi-box-arrow-in-down"></i> Return Item</button>
                        </div>
                        <div class="col-2" >
                        <a href="pos-utilities.php"> <button type="button" class="btn btn-outline-danger" style="float: right;"><i class="bi bi-x-lg"></i> Cancel</button></a>
                        </div>
                    </div>
                  
                    <br>
    </form>
</div>
</div>


</body>
</html>
<script>
  //date
  document.querySelector('.date').value = new Date().toISOString();

  function confirmUpdate() {
    let confirmUpdate = confirm("Are you sure you want to Commit record?\n \nNote: Double Check Input Records");
    if (confirmUpdate) {
      alert("Update Record Database Successfully!");
    } else {

      alert("Action Canceled");
    }
  }
</script>