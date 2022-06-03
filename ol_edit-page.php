<?php

include_once 'headerv2.php';
include 'php/ol_edit-inc.php';
?>


<link rel="stylesheet" href="css/ol_edit-style.css">
<script defer src="js/ol_edit-script.js"></script>
<div style="padding: 2%;">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff;height:85vh;">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Online Transactions : Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>



        <form action="php/ol_edit-inc.php" method="POST">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="id" name="olId" value="<?php echo str_pad($olId, 8, 0, STR_PAD_LEFT) ?>" style="width:auto" readonly>
                <label for="floatingInput"> Online Trans ID</label>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" name="oltypeId">
                            <option value="<?php echo $oltypeId ?>"><?php echo $olTypeName; ?></option>
                            <?php
                            include "config.php";
                            $records = mysqli_query($db, "SELECT * FROM ol_type ORDER BY ol_type_name ASC");

                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['ol_type_id'] . "'>" . $data['ol_type_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Online Platform</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" name="olTitle" class="form-control" id="floatingInput" value="<?php echo $olTitle ?>">
                        <label for="floatingInput">OR No. </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" name="olSi" class="form-control" id="floatingInput" value="<?php echo $olSi ?>">
                        <label for="floatingInput">SI No. </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" name="olDate" class="form-control" id="floatingInput" value="<?php echo $olDate ?>">
                        <label for="floatingInput">Online Transaction Date </label>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col">
                    <h5>Product Table</h5>
                </div>
                <div class="col"> <button class="edit__button edit__button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
                </div>
            </div>
            <div class="table-responsive" style="height: 45vh;">
                <table class='table table-sm'>
                    <thead>
                        <tr style="text-align: left;">
                            <th style="width: 10%;">&nbsp;&nbsp;Product ID</th>
                            <th style="width: 40%;">&nbsp;&nbsp;Item Name</th>
                            <th style="width: 10%;">&nbsp;&nbsp;Qty</th>
                            <th style="width: 10%;">&nbsp;&nbsp;Unit</th>
                            <th style="width: 10%;">&nbsp;&nbsp;SRP</th>
                            <th style="width: 10%;">&nbsp;&nbsp;Less Fee</th>
                            <th style="width: 10%;">&nbsp;&nbsp;Total Price</th>
                            <th style="width: 10%;">
                            </th>

                        </tr>
                    </thead>
                    <tbody class='table--item'>

                        <?php

                        $limit = 0;
                        $total = $itemPrice[$limit] * $qtyIn[$limit] - $itemFee[$limit];

                        if (isset($productId)) {
                            while (count($productId) !== $limit) {
                                if ($productId[$limit] != 0) {
                                    $total = $itemPrice[$limit] * $qtyIn[$limit] - $itemFee[$limit];
                                    # code...
                                    echo
                                    "<tr style='text-align:left;'>
        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
        <td class='td__readonly td__readonly--unit'>$unitName[$limit]</td>
        <td class='td__edit td__edit--cost'>" . $itemPrice[$limit] . "</td>
        <td class='td__edit td__edit--fee'>" . $itemFee[$limit] . "</td>
        <td class='td__compute td__compute--totalcost'>" . $total . "</td>
        <td class='td__edit td__edit--delete'>
        <i class='fa fa-trash-o' style='font-size:26px'></i>
      </td>
         <input type='hidden' name='productId[]' value='$productId[$limit]' >
         <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
         <input type='hidden' name='itemPrice[]' value='$itemPrice[$limit]' class='input__edit input__edit--cost'>
         <input type='hidden' name='itemFee[]' value='$itemFee[$limit]' class='input__edit input__edit--fee'>
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
            </div>
            <br>
            <div class="container--edit__button">
                <button class="edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                <a href="ol_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
        </form>
    </div>

</div>


<div class="container--modal">
    <div class='modal--add__item'>

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