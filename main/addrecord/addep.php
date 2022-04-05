<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- font include -->

    <link rel="stylesheet" href="../../css/font.css">
    <!-- sidebar styles -->
    <link rel="stylesheet" href="../../css/main_style.css">

    <style>
        /* fieldset {
            padding: 20px;
            font-family: sans-serif;
            border: 5px solid lightgrey;

        }

        legend {
            letter-spacing: 3px;
            font-weight: bolder;
            color: midnightblue;
            font-size: 24px;
        } */

        /* label {
            color: black;
            font-weight: bold;
        } */

        /* th {
            background-color: #A5A4A4;
            color: white;
            border: 2px solid white;
        }

        td {

            border: 1px solid lightgrey;
            background-color: white;
            margin-left: 5px;
        } */

        /* 
        button {
            background-color: midnightblue;
            color: whitesmoke;
            cursor: pointer;
            padding: 5px;
        } */

        /* input {
            border: 1px solid lightgrey;
            height: 25px;
            text-shadow: aliceblue;
        } */

        /* div#search {
            position: relative;
            width: 80%;
            left: 0;
        } */

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
            font-size: 12px;
        }

        /* Style for Order ID Input box */
        .newID {
            margin-left: 5px;
            color: red;
        }

        /* .postb {
            border: 1px solid #d3d3d3;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            margin-top: 20px;
        } */

        /* input#item-name {
            position: relative;
            width: 430px;
        } */

        .hidden {
            display: none;
        }

        /* .inDetails {
            background-color: #EAEAEA;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            height: 100%;
            color: black;
        } */

        .delete {
            background-color: none;
        }

        /* 
        .stin-button-save {131231
            height: 40px;
            font-size: 15px;
            letter-spacing: 5px;
            float: right;
            font-weight: initial;
            margin-bottom: 20px;
        } */
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
            $(".newEpId").load("../addrecord/orderid/auto-order-id-ep.php");

            //Get latest order ID
            $.get("stoutlatest-id.php", function(data) {
                $('.newEpId').html(data);
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
                var price = $(".item-price").val();
                var remarks = $(".item-remarks").val();
                if (addOrder(id)) {
                    $.get(
                        "../addrecord/addrow/add-item-row-ep.php", {
                            id: id,
                            qty: qty,
                            price: price,
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
                                $(".item-price").val(0);
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
    <title>Exitpass Adding records</title>
</head>

<body style="background-color:#cce0ff">
    <div class="container-sm">
        <div class="card card-lg border-light-grey mb-3 mt-3 shadow" style="max-width: 100%;">
            <div class="card-header" style="background-color: #0d6efd;color:white;letter-spacing:2px">Exitpass: Entering records <i class="bi bi-pencil"></i>
            </div>
            <div class="card-body">
                <div id="search">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="item-name" name="item">
                                <label for="floatingInput">Search Item</label>
                            </div>
                            <div id="item-list"></div><!-- Dont Remove this -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control item-qty" id="floatingInput" value="1">
                                <label for="floatingInput">Quantity</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control item-price" id="floatingInput" value="0">
                                <label for="floatingInput">Price</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary add-button mt-1" style="width: 100%;height:50px"><i class="bi bi-plus-circle"></i> Add</button>
                        </div>
                    </div>
                    <hr>
                    <form autocomplete="off" method="GET" action="../addrecord/itemInsert/epInsert.php">
                        <div class="row">
                            <div class="col">&nbsp;Exitpass ID : <span class="newEpId"></span></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input class="form-control item-price" id="floatingInput" type="number" name="ep_no" required>
                                    <label for="floatingInput">Exitpass No.</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input class="form-control item-price" id="floatingInput" type="text" name="ep_title">
                                    <label for="floatingInput">Job-Order No. (if Null leave blank)</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating mb-3">
                                    <input class="form-control item-price" id="floatingInput" type="date" name="ep_date" required>
                                    <label for="floatingInput">Exitpass Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea class="form-control" name="ep_remarks" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Exitpass Remarks</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="customers_id">
                                        <option></option>
                                        <?php
                                        include "../../php/config.php";
                                        $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name ASC");

                                        while ($data = mysqli_fetch_array($records)) {
                                            echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Customer Name</label>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-4">
                        <br />
                        <div class="table-responsive">
                            <table id="crud_table" width="100%" class="postb table ">
                                <tr>
                                    <th style="padding: 10px; text-align: left" width="50%">
                                        Item Description
                                    </th>
                                    <th style="padding: 10px; text-align: left" width="10%">
                                        Quantity
                                    </th>
                                    <th style="padding: 10px; text-align: left" width="10%">Price</th>

                                    <th style="padding: 10px; text-align: left" width="10%">
                                        Total Amount
                                    </th>

                                    <th style="padding: 10px; text-align: left" width="10%">
                                        &nbsp;
                                    </th>
                                </tr>
                            </table>
                            <br>
                            <button name="btnsave" class="btn btn-success stin-button-save">&nbsp;Save Record</button> <br> <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>










        <!--Add item for order-->



        <!-- <button name="btnsave" class="stin-button-save">Save Record </button> -->

        <br>

        </form>
    </div>
    </fieldset>
    </fieldset>
    </div>
    </div>
</body>

</html>