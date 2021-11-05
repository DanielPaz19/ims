<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Stock-Out Records</title>
    <link rel="icon" href="img/pacclogo.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="css/pos-page.css" /> -->
    <style>
        body {
            padding: 50px;
        }

        fieldset {
            padding: 20px;
            font-family: sans-serif;
            border: 5px solid lightgrey;

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

        th {
            background-color: #A5A4A4;
            color: white;
            border: 2px solid white;
        }

        td {

            border: 1px solid lightgrey;
            background-color: white;
            margin-left: 5px;
        }

        button {
            background-color: midnightblue;
            color: whitesmoke;
            cursor: pointer;
            padding: 5px;
        }

        input {
            border: 1px solid lightgrey;
            height: 25px;
            text-shadow: aliceblue;
        }

        div#search {
            position: relative;
            width: 80%;
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
            font-size: 12px;
        }

        /* Style for Order ID Input box */
        .newID {
            margin-left: 5px;
            color: red;
        }

        .postb {
            border: 1px solid #d3d3d3;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            margin-top: 20px;
        }

        input#item-name {
            position: relative;
            width: 430px;
        }

        .hidden {
            display: none;
        }

        .inDetails {
            background-color: #EAEAEA;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            height: 100%;
            color: black;
        }

        .delete {
            background-color: none;
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
</head>

<body bgcolor="#B0C4DE">
    <div class="Incontainer">
        <div class="inDetails">
            <fieldset>
                <legend>&nbsp;&nbsp;&nbsp;Exit Pass: Entering Record&nbsp;&nbsp;&nbsp;</legend>

                <br>
                <div>
                    <!-- Search Bar -->
                    <div class="container">
                        <div id="search">
                            <label>Enter Item:&nbsp;&nbsp;</label>
                            <input type="text" name="item" id="item-name" style="height: 30px;" placeholder=" 🔍 Search item here ......." /> <button class="add-button" title="Add Item"><i class="fa fa-plus"></i></button>
                            <div id="item-list"></div><!-- Dont Remove this -->
                        </div>
                    </div>
                    <br>
                    <!-- input for item qty -->
                    <label>Quantity: &nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input class="item-qty" type="number" placeholder="Quantity" value="1" />

                    <!-- input for discount -->
                    <label>Price: &nbsp;&nbsp;</label>
                    <input class="item-price" type="number" placeholder="Price" value="0" /> <br /><br />

                </div>
                <br><br><br>
                <form autocomplete="off" method="GET" action="../addrecord/itemInsert/epInsert.php">

                    <label style="display: none;">EP ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> <span class="newEpId" style="display: none;"></span><br><br>

                    <label>EP No.: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="number" name="ep_no" placeholder="Exit-Pass-No">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label>Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="ep_title" placeholder="Job-Order-No (If Have)"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label>Date:&nbsp;&nbsp;</label>
                    <input type="date" name="ep_date"><br><br>

                    <label>Remarks:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <textarea name="ep_remarks"></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Customer Name:</label>
                    <select name="customers_id" style="width: 400px; height: 35px; border: 1px solid gray; border-radius: 5px;" required>
                        <option></option>
                        <?php
                        include "../../php/config.php";
                        $records = mysqli_query($db, "SELECT * FROM customers");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
                        }
                        ?>
                    </select>

                    <div>
                        <!--Add item for order-->

                        <br /> <br />
                        <legend style="font-size: 20px;">Item Details</legend>
                        <table id="crud_table" width="100%" class="postb">
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
                        <button name="btnsave"><i class="fa fa-save"></i>&nbsp;Save </button>
                </form>
        </div>
        </fieldset>
        </fieldset>
    </div>
    </div>
</body>

</html>