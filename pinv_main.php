<?php include('header.php');
include('navbar.php');

if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>
<?php include('php/config.php'); ?>
<link rel="stylesheet" href="css/pinv-style.css" media="print">
<link rel="stylesheet" href="css/pinv-style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    function printDiv() {
        var divContents = document.getElementById("print-area").innerHTML;
        var a = window.open('', '', 'height=1000, width=1300');
        a.document.write(divContents);
        a.document.close();
        a.print();
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    //Jquery codes
    $(document).ready(function() {
        const orders = []; // array for all the product id in the table

        //function that check the product id to be added
        //return true if has duplicate and false if no duplicate
        const checkDuplicate = (productId) => {
            //Check the value of product id
            if ($("#product" + productId).length == 0) {
                console.log("No duplicate");
                return 0;
            } else {
                alert("Item already exist");
                return 1;
            }
        };

        const addOrder = (productId) => {
            console.log(`Product ID: ${productId}`);
            //Check orders if empty
            if (orders.length == 0) {
                orders.push(productId);
                return true;
            } else if (checkDuplicate(productId)) {
                //Clear Item on click
                $("#item-name").click(function() {
                    $(this).val("");
                });
            } else {
                orders.push(productId);
                return true;
            }
        };

        //Delete button for table rows
        $("#crud_table").on("click", ".delete", function() {
            $(this).closest("tr").remove();
        });

        // //Auto incrementing Order-ID
        $(".newPinvId").load("auto-order-id-pinv.php");

        //Get latest order ID
        $.get("stoutlatest-id.php", function(data) {
            $('.newPinvId').html(data);
        });

        //Search Items on Database
        $("#item-name").keyup(function() {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: "search.php",
                    method: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $("#item-list").fadeIn();
                        $("#item-list").html(data);
                    },
                });
            } else {
                $("#item-list").fadeOut();
            }
        });

        //Choose data on mouse click
        $(document).on("click", "li", function() {
            $(this).addClass("selected"); //add selected class on clicked list
            $("li").each(function(i) {
                var elementText = $(".selected")
                    .clone()
                    .children()
                    .remove()
                    .end()
                    .text();
                $("#item-name").val(elementText); //retain value to input box
            }); //function for getting only the parent text

            $("#item-list").fadeOut(); // close the item list suggestion
        });

        //Adds table row based on INPUT VALUE//
        $(".add-button").click(function() {
            var id = $("li.selected p").text(); //gets the value id
            var qty = $(".item-qty").val();
            var discount = $(".item-discount").val();
            var remarks = $(".item-remarks").val();
            if (addOrder(id)) {
                $.get(
                    "../addrecord/addrow/add-item-row-stout.php", {
                        id: id,
                        qty: qty,
                        discount: discount,
                        remarks: remarks,
                    },
                    function(data, status) {
                        var noResult = "0 results";

                        if (data == noResult) {
                            alert("No ID matches.");

                            //Clear Item on click
                            $("#item-name").click(function() {
                                $(this).val("");
                            });
                        } else {
                            //add table row with data
                            $(".postb").append(data);

                            //clear form
                            $("#item-name").val("");
                            $(".item-qty").val(1);
                            $(".item-discount").val(0);
                            $(".item-remarks").val("");
                            $("li.selected").removeClass("selected");
                        }
                    }
                );
                console.log(orders);
            }
        });
    });
</script>

<center>
    <form method="POST">
        <div class="form-inline">
            <label>Choose Location:</label>
            <select name="loc_id">
                <option>-- Select Location --</option>
                <?php
                include "php/config.php";
                $records = mysqli_query($db, "SELECT * FROM loc_tb");

                while ($data = mysqli_fetch_array($records)) {
                    echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                }
                ?>
            </select> <br> <br>
            <button name="filter">Generate</button> &nbsp;
            <button name="reset">Reset</button>&nbsp;
            <br>
    </form> <br>

    <button style="width: 50%;" class="noprint" onclick="window.print()">Print</button> <br><br>
    <a href="pinv_main2.php"><button style="width: 50%;" class="noprint">Cancel</button></a>
    <br><br>

    </div>

    <br />

    <page id="print" size="A4">
        <div class="itemlist">

        </div>
        <table class="pinv-tb" id="table-id">
            <thead>
                <th style="width: 10%;">Product ID</th>
                <th style="width: 40%;">Name</th>
                <th style="width: 10%;">Unit</th>
                <th style="width: 10%;">Location</th>
                <th style="width: 10%;">Stock No.</th>
                <th style="width: 5%;">PhyQty</th>
            </thead>
            <thead>
                <?php
                require 'php/config.php';
                if (isset($_POST['filter'])) {

                    $loc_id = $_POST['loc_id'];
                    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode, product.product_type_id, pinv_product.pinv_qty
                    FROM pinv_product
                    LEFT JOIN pinv_tb ON pinv_tb.pinv_id = pinv_product.pinv_id
                    LEFT JOIN product ON product.product_id = pinv_product.product_id
                    LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                    LEFT JOIN product_type ON product_type.product_type_id = product.product_type_id
                    WHERE product.loc_id = '$loc_id' AND product.product_type_id = 1");
                    while ($fetch = mysqli_fetch_array($query)) {
                        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);

                        echo "<tr>
                  <td>" . $prodId . "</td>
                  <td>"  . $fetch['product_name'] . "</td>
                  <td>"  . $fetch['unit_name'] . "</td>
                  <td>" . $fetch['loc_name'] . "</td>
                  <td>" . $fetch['barcode'] . "</td>
                  <td>"  . $fetch['pinv_qty'] .  "</td></tr>";
                    }
                } else if (isset($_POST['reset'])) {
                    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode, pinv_product.pinv_qty
                        FROM pinv_product
                        LEFT JOIN pinv_tb ON pinv_tb.pinv_id = pinv_product.pinv_id
                        LEFT JOIN product ON product.product_id = pinv_product.product_id
                        LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id ");
                    while ($fetch = mysqli_fetch_array($query)) {
                        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);
                        echo "<tr><td>" . $prodId . "</td><td>" . $fetch['product_name'] . "</td><td>" . $fetch['unit_name'] . " </td><td>"  . $fetch['loc_name'] . "</td><td>" . $fetch['barcode'] . "</td><td>"  . "<input type='number' name='user_count'  style='width:100%;background-color:transparent'>" . "</td></tr>";
                    }
                } else {
                    $query = mysqli_query($db, "SELECT product.product_id, product.product_name, loc_tb.loc_id, loc_tb.loc_name, product.qty, unit_tb.unit_name, product.barcode, pinv_product.pinv_qty
                    FROM pinv_product
                    LEFT JOIN pinv_tb ON pinv_tb.pinv_id = pinv_product.pinv_id
                    LEFT JOIN product ON product.product_id = pinv_product.product_id
                    LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                    LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id ");
                    while ($fetch = mysqli_fetch_array($query)) {
                        $prodId = str_pad($fetch['product_id'], 8, 0, STR_PAD_LEFT);
                        echo "<tr><td>" . $prodId . "</td><td>" . $fetch['product_name'] . "</td><td>"  . $fetch['qty'] . "</td><td>" . $fetch['unit_name'] . " </td><td>"  . $fetch['loc_name'] . "</td><td>" . $fetch['barcode'] . "</td><td>"  . "<input type='number' name='user_count'  style='width:100%'>" . "</td></tr>";
                    }
                }
                ?>
            </thead>
        </table>
    </page>
    </div>



    </form>