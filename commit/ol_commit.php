<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];

    $result = mysqli_query($db, "SELECT ol_tb.ol_id, ol_tb.ol_title, ol_tb.ol_date, ol_type.ol_type_name, ol_tb.ol_si
                                 FROM ol_tb
                                 LEFT JOIN ol_type ON ol_type.ol_type_id = ol_tb.ol_type_id
                                WHERE ol_id=" . $_GET['id']);


    $row = mysqli_fetch_array($result);

    if ($row) {
        $id = $row['ol_id'];
        $ol_title = $row['ol_title'];
        $ol_si = $row['ol_si'];
        $dateString = $row['ol_date'];
        $dateTimeObj = date_create($dateString);
        $date = date_format($dateTimeObj, 'm/d/y');
        $ol_type_name = $row['ol_type_name'];
    } else {
        echo "No results!";
    }
}


?>

<?php include('../headerv2.php') ?>


<div style="padding: 2%;">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff;height:82vh">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px"><?php echo $ol_type_name ?> : Commiting Records <i class="bi bi-pencil"></i></h4>
        <hr>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ol_type_name; ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Online Platform</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ol_title; ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">OR No.</label>
                </div>
            </div>


            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ol_si; ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">SI No.</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $date; ?>" style="cursor:not-allowed" readonly>
                    <label for="floatingInput">Online Transaction Date</label>
                </div>
            </div>

        </div>

        <br>
        <hr>
        <br>


        <form method="GET" action="../commit/que/ol_commit_que.php">
            <input type="hidden" name="ol_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name='mov_date' class='date'>
            <div class="row">
                <div class="col">Product Table</div>
            </div>
            <div class="table-responsive" style="height:40vh;overflow-y:scroll">
                <table class="item-details table">
                    <tr>
                        <th width="10%">Product ID</th>
                        <th width="30%">Item Name</th>
                        <th width="10%">Beg. Qty</th>
                        <th width="10%">Qty Out</th>
                        <th width="5%">Unit</th>
                        <th width="10%">Incomming Qty</th>
                        <th width="10%">SRP</th>
                        <th width="10%">Less Amount</th>
                        <th width="10%">SubTotal Price</th>
                    </tr>

                    <?php
                    $sql = "SELECT product.product_id, product.product_name, product.qty, unit_tb.unit_name, product.price, ol_product.ol_qty, ol_product.ol_price, ol_product.ol_priceTot, ol_product.ol_fee
                    FROM product 
                    LEFT JOIN ol_product ON product.product_id = ol_product.product_id
                    LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE ol_product.ol_id='$id' ";

                    $result = $db->query($sql);
                    $count = 0;
                    if ($result->num_rows >  0) {

                        while ($irow = $result->fetch_assoc()) {
                            $count = $count + 1;
                    ?>
                            <tr>
                                <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT); ?></td>
                                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                                <td><input type="text" name="bal_qty[]" value="<?php echo $irow['qty'] ?>" style="border: none;" readonly></td>
                                <td contenteditable="false">
                                    <font color="red"><input type="number" name="out_qty[]" value="<?php echo $irow['ol_qty'] ?>" style="border: none;"></font>
                                </td>
                                <td contenteditable="false"><?php echo $irow['unit_name'] ?></td>
                                <td>
                                    <input type="number" name="ol_priceTot[]" style="background-color:transparent;border:none" value="<?php echo $irow["qty"] - $irow["ol_qty"]; ?>" contenteditable="false">
                                </td>
                                <td contenteditable="false"><?php echo $irow['ol_price'] ?></td>
                                <td contenteditable="false"><?php echo $irow['ol_fee'] ?></td>
                                <td class="ep_totPrice"><input type="number" style="border: none" value="<?php echo $irow["ol_priceTot"]  ?>" contenteditable="false"></td>
                            </tr>
                            <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
                    <?php }
                    } ?>

                    </center>
                </table>
            </div>
            <br>
            <input type="submit" name="submit" value="Commit" class="btn btn-primary" onclick="confirmUpdate()">
            <a href="../ol_main.php"> <button type="button" class="btn btn-danger"> Cancel</button></a>
        </form>
        </fieldset>
    </div>
    </body>

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