<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Job-Order Records</title>
    <link rel="icon" href="img/pacclogo.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/pos-page.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        body {
            padding: 10px;
        }

        fieldset {
            padding: 20px;
            font-family: sans-serif;
            border: 5px solid lightgrey;
            height: 97vmax;
        }

        legend {
            letter-spacing: 3px;
            font-weight: bolder;
            color: midnightblue;
            font-size: 24px;
        }

        label {
            color: black;
            font-weight: bold;
        }

        /* 
        th {
            background-color: #A5A4A4;
            color: white;
            border: 2px solid white;

        } */

        /* td {
            border: 1px solid lightgrey;
            background-color: white;
            margin-left: 5px;
        } */

        /* button {
            background-color: midnightblue;
            color: whitesmoke;
            cursor: pointer;
            padding: 5px;
            height: 30px;
            width: 30px;

        } */

        /* input {
            border: 1px solid lightgrey;
            height: 25px;
            text-shadow: aliceblue;
        } */

        div#search {
            position: relative;
            width: 100%;
            left: 0;
        }

        #relative {
            position: relative;
        }

        #item-list {
            position: absolute;
            width: 800px;
            margin: auto;
            z-index: 1;
        }

        ul {
            list-style-type: none;
            margin-top: 0;
            margin-right: 50px;
            margin-left: 50px;
            display: block;
            padding-left: 5px;
            width: 800px;
        }

        li:hover {
            background-color: lightgrey;
        }

        li {
            text-align: left;
            padding: 10px;
            border: 1px solid lightgrey;
            width: 780px;
        }

        li.selected {
            background: lightgrey;
        }

        ul {
            background-color: white;
            border: 1px solid black;
            cursor: pointer;
            width: 100%;
        }

        /* Style for crud-table */
        #crud_table {
            font-size: 13px;
        }

        /* Style for Order ID Input box */
        .newID {
            margin-left: 5px;
            color: red;
        }



        /* 
        input#item-name {
            position: relative;
            width: 430px;
        } */

        .hidden {
            display: none;
        }

        /*   .Incontainer {
        background-color: none;
        padding: 20px;
        box-shadow:  0 0 10px  rgba(0,0,0,0.6);
      -moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
      -o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
        height: 700px;
      }*/

        .inDetails {
            background-color: #EAEAEA;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            color: black;
            height: 100vmax;
        }

        .delete {
            background-color: none;
        }


        .stin-button-save {
            width: 300px;
            height: 40px;
            font-size: 15px;
            letter-spacing: 5px;
            float: right;
            font-weight: initial;
        }

        .jotb td {
            border: none;
            background-color: transparent;
            /* border: 1px solid black; */
            width: 60%;
        }

        .jotb {
            width: 80%;
        }

        .add-button {
            width: 31%;
            letter-spacing: 2px;

        }
    </style>

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
            $(".newStinId").load("../addrecord/orderid/auto-order-id-jo.php");

            //Get latest order ID
            $.get("stinlatest-id.php", function(data) {
                $('.newStinId').html(data);
            });

            //Search Items on Database
            $("#item-name").keyup(function() {
                var query = $(this).val();
                if (query != "") {
                    $.ajax({
                        url: "../addrecord/search.php",
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
                var price = $(".item-price").val();
                // var remarks = $(".item-remarks").val();
                if (addOrder(id)) {
                    $.get(
                        "../addrecord/addrow/add-item-row-jo.php", {
                            id: id,
                            qty: qty,
                            price: price,
                            // remarks: remarks,
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
                                $(".item-price").val(0);
                                // $(".item-remarks").val("");
                                $("li.selected").removeClass("selected");
                            }
                        }
                    );
                    console.log(orders);
                }
            });
        });
    </script>
</head>

<body style="background-color:#B0C4DE">
    <div class="container-sm">
        <!-- <div class="shadow-lg p-2 mb-5 mt-5 bg-blue rounded"> -->
        <div class="container">
            <div id="search">
                <div class="card card-lg border-light-grey mb-3 mt-3 shadow" style="max-width: 100%;">
                    <div class="card-header" style="background-color: midnightblue;color:white;letter-spacing:2px">Job Order: Entering records <i class="bi bi-pencil"></i></div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="item-name" name="item">
                            <label for="floatingInput">Search Item</label>
                            <div id="item-list"></div><!-- Dont Remove this -->
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control item-qty" id="floatingInput" placeholder="Quantity" value="1">
                                    <label for="floatingInput">Quantity</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control item-price" id="floatingInput" placeholder="Quantity" value="0">
                                    <label for="floatingInput">Price</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-floating mb-3">
                                    <button class="btn btn-primary add-button mt-1" style="width: 100%;height:50px"><i class="bi bi-plus-circle"></i> Add</button>
                                </div>
                            </div>
                        </div>
                        <hr><br>
                        <form autocomplete="off" method="GET" action="../addrecord/itemInsert/joInsert.php">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">&nbsp;JO ID : <span class=" newStinId"></span></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="jo_no">
                                            <label for="floatingInput">Job-Order No.</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="floatingInput" name="jo_date">
                                            <label for="floatingInput">Job-Order Date</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="jo_type_id">
                                                <option></option>
                                                <?php
                                                include "../../php/config.php";
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
                                    <div class="col-5">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="customers_id">
                                                <option></option>
                                                <?php
                                                include "../../php/config.php";
                                                $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_company ASC");

                                                while ($data = mysqli_fetch_array($records)) {
                                                    echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_company'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Customer</label>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Add New Customer"><i class="bi bi-person-plus"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="emp_id">
                                                <option></option>
                                                <?php
                                                include "../../php/config.php";
                                                $records = mysqli_query($db, "SELECT * FROM employee_tb ORDER BY emp_name ASC");

                                                while ($data = mysqli_fetch_array($records)) {
                                                    echo "<option value='" . $data['emp_id'] . "'>" . $data['emp_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Prepared by</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating mt-3">
                                            <textarea class="form-control" id="floatingTextarea2" style="height: 100px;" name="jo_remarks"></textarea>
                                            <label for=" floatingTextarea2">Job-Order Remarks</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <br>
                            <div class="table-responsive">
                                <caption>Product Table</caption>
                                <table id="crud_table" class="postb table">
                                    <tr>
                                        <th>Item Description</th>
                                        <th>Qty-Order</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                        <th></th>
                                    </tr>

                                </table>
                            </div>
                            <div>
                                <button class="btn btn-success" name="btnsave"><i class="bi bi-check2-circle"></i> Save Records</button>
                            </div>
                    </div>
                    </form>
                </div>

            </div>
            <?php
            // connect to the database
            include "../../php/config.php";
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }


            // Add item
            if (isset($_GET['addcus'])) {
                // receive all input values from the form
                echo "connect";
                $customers_company = mysqli_real_escape_string($db, $_GET['customers_company']);
                $customers_name = mysqli_real_escape_string($db, $_GET['customers_name']);
                $customers_address = mysqli_real_escape_string($db, $_GET['customers_address']);
                $customers_contact = mysqli_real_escape_string($db, $_GET['customers_contact']);
                $customers_note = mysqli_real_escape_string($db, $_GET['customers_note']);
                $customers_tin = mysqli_real_escape_string($db, $_GET['customers_tin']);
                $tax_type_id = mysqli_real_escape_string($db, $_GET['tax_type_id']);


                $query = "INSERT INTO customers (customers_company,customers_name,customers_address,customers_contact,customers_note,customers_tin,tax_type_id) 
  			  VALUES('$customers_company','$customers_name','$customers_address','$customers_contact','$customers_note','$customers_tin','$tax_type_id')";

                if (mysqli_query($db, $query)) {

                    echo "<script>
      alert('Record Created Successfully!');
      location.href = 'addjo.php';
      </script>";
                } else {
                    echo "<script>alert('Failed to create record !');</script>";
                }
            }
            ?>



            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel"> <i class="bi bi-person-plus"></i> Create New Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="GET">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Company Name" name="customers_company">
                                    <label for="floatingInput">Company Name</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingPassword" placeholder="Contact Person" name="customers_name">
                                    <label for="floatingInput">Contact Person</label>
                                </div>
                                <br>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Company Address" id="floatingTextarea" name="customers_address"></textarea>
                                    <label for="floatingTextarea">Company Address</label>
                                </div><br>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingPassword" placeholder="Contact Info" name="customers_contact">
                                    <label for="floatingPassword">Contact Info</label>
                                    <br>
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingPassword" placeholder="Tin No." name="customers_tin">
                                        <label for="floatingPassword">TIN No.</label>
                                    </div>
                                    <br>
                                    <div class="form-floating">
                                        <select class="form-select" id="sel1" name="tax_type_id">
                                            <?php
                                            include "../php/config.php";
                                            $records = mysqli_query($db, "SELECT * FROM tax_type_tb");

                                            while ($data = mysqli_fetch_array($records)) {
                                                echo "<option value='" . $data['tax_type_id'] . "'>" . $data['tax_type_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="sel1" class="form-label">Tax Type</label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" style="width: 30%;" name="addcus">Save Record</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

</body>

</html>