<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT ep_tb.ep_id, ep_tb.ep_no, ep_tb.ep_title, ep_tb.ep_remarks, ep_tb.ep_date, customers.customers_name
                                 FROM ep_tb
                                 LEFT JOIN customers ON ep_tb.customers_id = customers.customers_id
                                WHERE ep_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['ep_id'];
        $ep_no = $row['ep_no'];
        $ep_title = $row['ep_title'];
        $ep_remarks = $row['ep_remarks'];
        $dateString = $row['ep_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
        $customers_name = $row['customers_name'];
    } else {
        echo "No results!";
    }
}


?>

<?php include('../headerv2.php') ?>
<div style="padding:3%">
    <div class="shadow p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Exitpass : Commiting Records <i class="bi bi-pencil"></i></h4>
        <hr>
        <div class="row">
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Exitpass ID</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ep_no ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Exitpass No</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ep_title ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Job-Order No.</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $date ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Exitpass Date</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $customers_name ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Customer</label>
                </div>
            </div>
        </div>
        <form method="GET" action="../commit/que/ep_commit_que.php">
            <input type="hidden" name="ep_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name='mov_date' class='date'>
            <table class="table item-details">
                <tr>
                    <th width="10%">Product ID</th>
                    <th width="35%">Item Name</th>
                    <th width="10%">Beg. Qty</th>
                    <th width="10%">Qty Out</th>
                    <th width="5%">Unit</th>
                    <th width="10%">Incomming Qty</th>
                    <th width="10%">Price</th>
                    <th width="10%">SubTotal Price</th>
                </tr>

                <?php
                $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.price, ep_product.ep_qty, ep_product.ep_price, ep_product.ep_qty_tot
                    FROM product 
                    LEFT JOIN ep_product ON product.product_id = ep_product.product_id
                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE ep_product.ep_id='$id' ";

                $result = $db->query($sql);
                $count = 0;
                if ($result->num_rows >  0) {

                    while ($irow = $result->fetch_assoc()) {
                        $count = $count + 1;
                ?>
                        <tr>
                            <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT); ?></td>
                            <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                            <td><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;width:100px" readonly></td>
                            <td contenteditable="false">
                                <font color="red"><input type="number" name="out_qty[]" value="<?php echo $irow['ep_qty'] ?>" style="border: none;width:100px"></font>
                            </td>
                            <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
                            <td>
                                <input type="number" name="ep_qty_tot[]" style="border: none" value="<?php echo $irow["qty"] - $irow["ep_qty"]; ?>" contenteditable="false">
                            </td>
                            <td contenteditable="false"><?php echo $irow['ep_price'] ?></td>
                            <td class="ep_totPrice"><input type="number" style="border: none" value="<?php echo $irow["ep_qty"] * $irow["ep_price"]; ?>" contenteditable="false"></td>

                        </tr>
                        <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                <?php }
                } ?>

                </center>
            </table>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Commit Records</button>
            <a href="../stout_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
        </form>
    </div>
</div>




<!-- Items Details -->


<script type="text/javascript">
    function PrintPage() {
        window.print();
    }

    function HideBorder(id) {
        var myInput = document.getElementById(id).style;
        myInput.borderStyle = "none";
    }
</script>
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

<script>
    function confirmCancel() {
        let confirmUpdate = confirm("Are you sure you want to cancel ?");
        if (confirmUpdate) {
            alert("Nothing Changes");
        } else {

            alert("Action Canceled");
        }
    }
</script>

</html>