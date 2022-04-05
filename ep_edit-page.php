<?php

include_once 'headerv2.php';
include 'php/ep_edit-inc.php';
?>
<link rel="stylesheet" href="css/ep_edit-style.css">
<script defer src="js/ep_edit-script.js"></script>


<div class="container-sm">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Exitpass: Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>

        <form action="php/ep_edit-inc.php" method="POST">
            <div class="row">
                <div class="col-4">
                    <div class="form-floating mb-3">
                        <input type="text" id="id" class="form-control" name="epId" value="<?php echo str_pad($epId, 8, 0, STR_PAD_LEFT) ?>" readonly>
                        <label for="floatingInput">Exitpass ID</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="epNo" value="<?php echo $epNo ?>">
                        <label for="floatingInput">Exitpass No.</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="epTitle" value="<?php echo $epTitle ?>">
                        <label for="floatingInput">Job-Order No.</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="epDate" value="<?php echo $epDate ?>">
                        <label for="floatingInput">Exitpass Date</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="customerId">
                            <option value="<?php echo $customerId ?>"><?php echo $customerName; ?></option>
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
                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" id="floatingTextarea" name="epRemarks"><?php echo $epRemarks; ?></textarea>
                        <label for="floatingTextarea">Exitpass Remarks</label>
                    </div>
                </div>
            </div>

            <br>
            <hr>
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
                    <tr style="text-align: left;background-color:#0d6efd;color:white">
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
                    $total = $itemPrice[$limit] * $qtyIn[$limit];

                    if (isset($productId)) {
                        while (count($productId) !== $limit) {
                            if ($productId[$limit] != 0) {
                                $total = $itemPrice[$limit] * $qtyIn[$limit];
                                # code...
                                echo
                                "<tr style='text-align:left;'>
        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
        <td class='td__readonly td__readonly--unit'>$unitName[$limit]</td>
        <td class='td__edit td__edit--cost'>" . number_format($itemPrice[$limit], 2) . "</td>
        <td class='td__compute td__compute--totalcost'>" . number_format($total, 2) . "</td>
        <td class='td__edit td__edit--delete'>
        <i class='bi bi-x-circle' style='font-size:22px' title='Delete'></i>
      </td>
         <input type='hidden' name='productId[]' value='$productId[$limit]' >
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]' class='input__edit input__edit--cost'>
         <input type='hidden' name='itemTotal[]' value='$total' class='input__edit input__edit--total'>
         </tr>
         ";
                            }
                            $limit++;
                        }
                    }

                    ?>

                </tbody>
            </table>
            <div class="pull-right">
                <button class="edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                <a href="ep_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>


            <br>
    </div>
    </form>


    <div class="container--modal">
        <div class='modal--add__item'>
            <a href="#"><button onclick="showadditemEDITV2()" class="button--add__item">New Item</button></a>
            <input type="text" class='input--search' placeholder="Search Item..."><br>
            <span class='close--modal'><i class="fa fa-close"></i></span>
            <div class='table--container'>
                <table class="modal--table__itemlist">
                    <thead>
                        <tr style="text-align: center;">
                            <th>Product ID</th>
                            <th>Item Name</th>
                            <th>Qty-On-Hand</th>
                            <th>Barcode</th>
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