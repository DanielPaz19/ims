<?php

include_once 'headerv2.php';
include 'php/stout_edit-inc.php';
?>
<link rel="stylesheet" href="css/stout_edit-style.css">
<script defer src="js/stout_edit-script.js"></script>

<div class="container-sm">
    <div class="shadow-lg p-5 mt-5 bg-body rounded" style="width:100%;border:5px solid #cce0ff">
        <h4 style="font-family:Verdana, Geneva, Tahoma, sans-serifl;letter-spacing:2px">Stock-OUT: Editing Records <i class="bi bi-pencil"></i></h4>
        <hr>



        <form action="php/stout_edit-inc.php" method="POST">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="stoutId" id="id" value="<?php echo str_pad($stoutId, 8, 0, STR_PAD_LEFT) ?>" style="width:auto;cursor:not-allowed" readonly>
                <label for="floatingInput"> Stock-Out ID</label>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="stoutCode" id="stout_code" value="<?php echo $stoutCode ?>">
                        <label for="floatingInput">Stock-Out Code</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="stoutTitle" id="stout_title" value="<?php echo $stoutTitle ?>">
                        <label for="floatingInput">Job-Order No.</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="stoutDate" id="stout_date" value="<?php echo $stoutDate ?>">
                        <label for="floatingInput">Stock-Out Date</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating">
                        <textarea class="form-control" name="stoutRemarks"><?php echo $stoutRemarks ?></textarea>
                        <label for="floatingTextarea">Comments</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="empId">
                            <option value=" <?php echo $empId ?>"><?php echo $empName ?></option>
                            <?php
                            include "../../php/config.php";
                            $records = mysqli_query($db, "SELECT * FROM employee_tb ORDER BY emp_name ASC");

                            while ($data = mysqli_fetch_array($records)) {
                                echo "<option value='" . $data['emp_id'] . "'>" . $data['emp_name'] . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">Prepared By</label>
                    </div>
                </div>
            </div>

            <br>
            <hr>
            <br>
            <div class="button__container--insert_item">
                <div class="container--table">
                    <div class="row">
                        <div class="col">
                            <h5 style="float:left">Product Table</h5>
                        </div>
                        <div class="col"> <button class="edit__button edit__button--insert__item btn btn-primary" style="float: right; margin-bottom:5px"><i class="bi bi-plus-circle"></i> Add Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th style="text-align:left;">Item Name</th>
                            <th>Qty-Out</th>
                            <th>Barcode</th>
                            <th>Item remarks
                            </th>
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
                                    "<tr >
                                        <td class='td__readonly td__readonly--productid'>" . str_pad($productId[$limit], 8, 0, STR_PAD_LEFT) . "</td>
                                        <td class='td__readonly td__readonly--itemname'>$productName[$limit]</td>
                                        <td class='td__edit td__edit--qty'>" . $qtyIn[$limit] . "</td>
                                        <td class='td__readonly td__readonly--barcode'>$barcode[$limit]</td>
                                        <td class='' style='text-align:center;'>
                                        <textarea class='form-control' id='exampleFormControlTextarea1' rows='1.5' id='itemRemarks' name='itemRemarks[]'>$itemRemarks[$limit]</textarea>
                                    </td>

                                        <td class='td__edit td__edit--delete'>
                                            <i class='fa fa-trash-o' style='font-size:26px' title='Remove'></i>
                                        </td>
                                        <input type='hidden' name='productId[]' value='$productId[$limit]' >
                                        <input type='hidden' name='qtyIn[]' value='$qtyIn[$limit]' class='input__edit input__edit--qty'>
                                        <input type='hidden' name='itemCost[]' value='$itemCost[$limit]' class='input__edit input__edit--cost'>
                                        </tr>";
                                }


                                $limit++;
                            }
                        }
                        ?>



                    </tbody>
                </table>
                <div class="pull-right">
                    <button class=" edit__button button--update btn btn-success" name='update'><i class="bi bi-check2-circle"></i> Update Records</button>
                    <a href="stout_main.php"><button type="button" class="btn btn-danger">Cancel</button></a>
                </div>


            </div>




    </div>





    <div class="container--edit__button" style="margin-top:50px;float:right">

    </div>


</div>

</form>


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