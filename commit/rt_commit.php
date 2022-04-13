<?php
include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT rt_tb.rt_id,rt_tb.rt_no, customers.customers_name,rt_tb.rt_date
   FROM rt_tb
   LEFT JOIN customers ON customers.customers_id = rt_tb.customers_id
    WHERE rt_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['rt_id'];
        $rt_no = $row['rt_no'];
        $customers_name = $row['customers_name'];
        $dateString = $row['rt_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
    } else {
        echo "No results!";
    }
}
?>

<?php include('../headerv2.php') ?>

<div style="padding: 2%;">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Return-Slip : Commiting Records <i class="bi bi-pencil"></i></h4>
        <hr>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo str_pad($id, 8, 0, STR_PAD_LEFT) ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">RT ID</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $rt_no ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Return-Slip No.</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $date ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Return-Slip Date</label>
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
        <div class="">
            <form method="GET" action="../commit/que/rt_commit_que.php">
                <input type="hidden" name="rt_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name='mov_date' class='date'>
                <table class="table" width="100%">
                    <tr style="text-align: left;background-color:#0d6efd;color:white">
                        <th width="10%">Product ID</th>
                        <th width="35%">Item Name</th>
                        <th width="10%">Qty-On-Hand</th>
                        <th width="10%">Qty-In</th>
                        <th width="5%">Unit</th>
                        <th width="10%">Incomming Qty</th>
                    </tr>

                    <?php
                    include "../php/config.php";
                    $sql = "SELECT rt_tb.rt_id, product.product_id,product.product_name,product.qty,rt_product.rt_qty,unit_tb.unit_name,rt_product.rt_qtyTot
                    FROM rt_product 
                    LEFT JOIN product ON product.product_id = rt_product.product_id
                    LEFT JOIN rt_tb ON rt_product.rt_id=rt_tb.rt_id
                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
                    WHERE rt_product.rt_id='$id'";

                    $result = $db->query($sql);
                    $count = 0;
                    if ($result->num_rows >  0) {

                        while ($irow = $result->fetch_assoc()) {
                            $rtTotal =  $irow["qty"] + $irow["rt_qty"];
                    ?>
                            <tr>
                                <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT); ?></td>
                                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                                <td><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>
                                <td contenteditable="false">
                                    <font color="red"><input type="number" name="in_qty[]" value="<?php echo $irow['rt_qty'] ?>" style="border: none"></font>
                                </td>
                                <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
                                <td><input type="number" style="border: none" name="rt_qtyTot[]" value="<?php echo $rtTotal ?>" contenteditable="false"></td>

                            </tr>
                            <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                    <?php }
                    } ?>

                    </center>
                </table>
                <br>
                <div class="row pull-right">
                    <div class="col">
                        <button type="submit" name="submit" class="btn btn-success">Commit Records</button>
                        <a href="../rt_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>
                </div>





            </form>
        </div>
    </div>
</div>





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