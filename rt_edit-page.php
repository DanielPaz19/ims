<?php

include_once 'headerv2.php';
include 'php/rt_edit-inc.php';
?>


<link rel="stylesheet" href="css/rt_edit-style.css">
<script defer src="js/rt_edit-script.js"></script>

<div class="container-sm">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Return-Slip: Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>


        <form action="php/rt_edit-inc.php" method="POST">
            <div class="row">
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="rtId" id="id" class="textId" value="<?php echo str_pad($rtId, 8, 0, STR_PAD_LEFT) ?>" style="width:auto;cursor:not-allowed" readonly>
                        <label for="floatingInput"> RT ID</label>
                    </div>
                </div>
                <div class="col-9">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="rtNo" id="stin_code" value="<?php echo $rtNo ?>">
                        <label for="floatingInput"> Return-Slip No.</label>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" name="rtReason" id="floatingTextarea"><?php echo $rtReason ?></textarea>
                        <label for="floatingTextarea">Reason</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" name="rtNote" id="floatingTextarea"><?php echo $rtNote ?></textarea>
                        <label for="floatingTextarea">Note</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="rtDate" id="stin_code" value="<?php echo $rtDate ?>">
                        <label for="floatingInput"> Return-Slip Date.</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="rtDriver" id="stin_code" value="<?php echo $rtDriver ?>">
                        <label for="floatingInput">Driver</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="rtGuard" id="stin_code" value="<?php echo $rtGuard ?>">
                        <label for="floatingInput">Guard-On-Duty</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="cusId">
                            <option value="<?php echo $cusId ?>"><?php echo $cusName; ?></option>
                            <?php
                            include "config.php";
                            $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name ASC");

                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Customer</label>
                    </div>
                </div>
            </div>
            <div class="button__container--insert_item">
                <div class="container--table">
                    <div class="row">
                        <div class="col">
                            <h5>Product Table</h5>
                        </div>
                        <div class="col"> <button class="edit__button edit__button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Item Name</th>
                        <th>Qty-In</th>
                        <th>Unit</th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody class='table--item'>

                    <?php
                    $limit = 0;

                    if (isset($productId)) {
                        while (count($productId) !== $limit) {
                            if ($productId[$limit] != 0) {
                                # code...
                                echo
                                "<tr>
                 <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
                 <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
                 <td class='td__edit td__edit--qty' >" . $qtyIn[$limit] . "</td>
                 <td class='td__readonly td__readonly--unit' >$unitName[$limit]</td>
                 <td class='td__edit td__edit--delete'>
                 <i class='bi bi-x-circle' style='font-size:22px' title='Delete'></i>
                  </td>
                  <input type='hidden' name='productId[]' value='$productId[$limit]' >
                  <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
                 </tr>
                 ";
                            }


                            $limit++;
                        }
                    }
                    ?>

                    <!-- <tr>
                    <td class='td__readonly td__readonly--productid'>00000001</td>
                    <td class='td__readonly td__readonly--itemname'>Sample Item</td>
                    <td>100.00</td>
                    <td class='td__readonly td__readonly--unit'>pcs</td>
                    <td>100.00</td>
                    <td>1,000.00</td>
                    <td class='td__edit td__edit--delete'>
                        <i class='fa fa-trash-o' style='font-size:26px'></i>
                    </td>
                </tr>
                <tr>
                    <td class='td__readonly td__readonly--productid'>00000002</td>
                    <td class='td__readonly td__readonly--itemname'>Sample Item 2</td>
                    <td>100.00</td>
                    <td class='td__readonly td__readonly--productid'>pcs</td>
                    <td>100.00</td>
                    <td>1,000.00</td>
                    <td class='td__edit td__edit--delete'>
                        <i class='fa fa-trash-o' style='font-size:26px'></i>
                    </td>
                </tr> -->

                </tbody>
            </table>
            <br>
            <div class="pull-right">
                <button class=" edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                <a href="rt_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
            <br>
        </form>
    </div>
</div>








<div class="container--modal">
    <div class='modal--add__item'>

        <a href=""><button onclick="showadditem()" class="button--add__item">New Item</button></a>

        <input type="text" class='input--search' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Location</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody class='container--itemlist'>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>