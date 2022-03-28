<?php

include_once 'headerv2.php';
include 'php/jo_edit-inc.php';
?>


<link rel="stylesheet" href="css/jo_edit-style2.css">
<script defer src="js/jo_edit-script.js"></script>


<div class="container-sm">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Job-Order Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>

        <form action="php/jo_edit-inc.php" method="POST">
            <!-- <a href="jo_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:midnightblue;" title="Exit"></i></a> -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="id" name="joId" value="<?php echo str_pad($joId, 8, 0, STR_PAD_LEFT) ?>" style="width:auto" readonly>
                <label for="floatingInput"> Job-Order ID</label>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="joNo" value="<?php echo $joNo ?>">
                        <label for="floatingInput">Job-Order No.</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="joDate" id="po_date" value="<?php echo $joDate ?>">
                        <label for="floatingInput">Job-Order Date</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="jo_type_id">
                            <option value="<?php echo $jo_type_id ?>"><?php echo $jo_type_name; ?></option>
                            <?php
                            include "config.php";
                            $records = mysqli_query($db, "SELECT * FROM jo_type ORDER BY jo_type_id ASC");

                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['jo_type_id'] . "'>" . $data['jo_type_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Job-Order Type</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="customerId" style="height:73px">
                            <option value="<?php echo $customerId ?>"><?php echo $customerName; ?></option>
                            <?php
                            include "config.php";
                            $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_company ASC");

                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_company'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Customer</label>
                    </div>
                </div>


                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" name="jo_remarks" id="floatingTextarea2" style="height: auto"><?php echo $remarks ?></textarea>
                        <label for="floatingTextarea2">Job-Order Remarks</label>
                    </div>
                </div>
            </div>
            <br>
            <hr> <br>


            <div class="button__container--insert_item">

                <div class="container--table">
                    <div class="row">
                        <div class="col">
                            <h5>Product Table</h5>
                        </div>
                        <div class="col"> <button class="edit__button edit__button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="text-align: left;">
                                    <th>&nbsp;&nbsp;Product ID</th>
                                    <th>&nbsp;&nbsp;Item Name</th>
                                    <th>&nbsp;&nbsp;Qty</th>
                                    <th>&nbsp;&nbsp;Unit</th>
                                    <th>&nbsp;&nbsp;Price</th>
                                    <th>&nbsp;&nbsp;Total Price</th>
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
                                            "<tr style='text-align:left;'>
        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
        <td class='td__readonly td__readonly--unit'>$unitName[$limit]</td>
        <td class='td__edit td__edit--cost'>" . number_format($itemPrice[$limit], 2) . "</td>
        <td class='td__compute td__compute--totalcost'>" . number_format($itemPrice[$limit] * $qtyIn[$limit], 2) . "</td>
        <td class='td__edit td__edit--delete'>
        <i class='bi bi-x-circle' style='font-size:22px' title='Delete'></i>
      </td>
         <input type='hidden' name='productId[]' value='$productId[$limit]' >
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]' class='input__edit input__edit--cost'>
         </tr>
         ";
                                        }
                                        $limit++;
                                    }
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container--edit__button">
                    <button class="edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                    <a href="jo_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
        </form>
        <br>
    </div>

</div>



<div class="container--modal">

    <div class='modal--add__item'>

        <input type="text" class='input--search form-control' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container table-responsive'>

            <table class="modal--table__itemlist table">
                <thead>
                    <tr>
                        <th style="text-align: center;">Product ID</th>
                        <th style="text-align: left;">Item Name</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Unit</th>
                        <th style="text-align: center;">Location</th>
                        <th style="text-align: center;">Price</th>
                    </tr>
                </thead>
                <tbody class='container--itemlist'>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once 'footer.php' ?>