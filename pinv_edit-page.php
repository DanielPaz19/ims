<?php

include_once 'headerv2.php';
include 'php/pinv_edit-inc.php';
?>


<link rel="stylesheet" href="css/pinv_edit-style.css">
<script defer src="js/pinv_edit-script.js"></script>

<div class="container-sm">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff;">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Physical Inventory: Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>
        <form action="php/pinv_edit-inc.php" method="POST">
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="id" name="pinvId" value="<?php echo str_pad($pinvId, 8, 0, STR_PAD_LEFT) ?>" style="width:auto" readonly>
                        <label for="floatingInput">PINV ID</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="pinvTitle" value="<?php echo $pinvTitle ?>">
                        <label for="floatingInput">PINV Title</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="employeeId">
                            <option value=" <?php echo $empId ?>"><?php echo $empName ?></option>

                            <?php include 'php/render-select-employee.php' ?>
                        </select>
                        <label for="floatingSelect">Prepared By</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="pinvDate" value="<?php echo $pinvDate ?>">
                        <label for="floatingInput">PINV Date</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <h5>Product Table</h5>
                </div>
                <div class="col"> <button class="edit__button edit__button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
                </div>
            </div>

            <table class='table'>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Item Name</th>
                        <th>PINV-Count</th>
                        <th>Location</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class='table--item'>
                    <?php
                    $records = mysqli_query($db, "SELECT * FROM loc_tb");
                    $output = '';
                    while ($data = mysqli_fetch_array($records)) {
                        $idLoc = $data['loc_id'];
                        $nameLoc = $data['loc_name'];
                        $output .= "<option value='$idLoc'>$nameLoc</option>";
                    }
                    $limit = 0;

                    if (isset($productId)) {
                        while (count($productId) !== $limit) {
                            if ($productId[$limit] != 0) {
                                # code...
                                echo
                                "<tr >
                 <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
                 <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
                 <td class='td__edit td__edit--qty' >" . $qtyIn[$limit] . "</td>
                 <td class='td__readonly td__readonly--location'>
                 <select name='locId[]' class='form-control'>
                 <option value='$locId[$limit]'>$locationName[$limit]</option>$output
                 </select>
                 </td>
              

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
            <div class="container--edit__button pull-right">
                <button class="edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                <a href="pinv_main2.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </div>
        </form>
        <br>
    </div>
</div>







<div class="container--modal">
    <div class='modal--add__item'>

        <a href=""><button onclick="showadditemEDITV2()" class="button--add__item">New Item</button></a>

        <input type="text" class='input--search' placeholder="Search Item..."><br>
        <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
        <div class='table--container'>
            <table class="modal--table__itemlist">
                <thead>
                    <tr>
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