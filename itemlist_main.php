<?php include('header.php');

if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>
<?php include('php/config.php'); ?>



<style>
    table#hover {
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);

        width: 100%;
    }

    #hover tr {
        background-color: white;
        border-top: 1px solid #fff;
    }

    #hover tr:hover {
        background-color: #DCDCDC;
        color: midnightblue;
    }

    #hover th {
        background-color: midnightblue;
    }

    #hover th,
    #hover td {
        padding: 8px 18px;
    }

    #hover td:hover {
        cursor: pointer;
    }

    .tableLabel {
        font-weight: bold;
        float: right;
        color: lightgray;
    }

    /* .content-area {
        border-radius: 5px;
        width: fit-content;
        height: fit-content;
        padding: 20px;
        background-color: #EAEAEA;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        margin-bottom: 10px;
    } */

    .con-form {
        font-family: Arial, Helvetica, sans-serif;
        border: 1px;
        padding: 10px;
        background-color: none;
        vertical-align: top;
        color: midnightblue;
    }

    .butLink {
        background-color: midnightblue;
        color: white;
        padding: 7px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 3px;
        cursor: pointer;
        width: 150px;
        height: 50px;
    }

    .butLink:hover {
        font-size: 25px;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        font-family: sans-serif;
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        height: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: lightblue;
        color: white;
        display: none;
    }

    .modal-body {
        width: auto;
        background-color: #eee;
        padding: 30px;

    }

    .modal-footer {
        align-content: center;
        padding: 2px 16px;
        background-color: midnightblue;
        color: white;
    }

    label {
        color: black
    }

    a {
        color: midnightblue;
        text-decoration: none;
    }

    .itemlist {
        border-collapse: collapse;
        padding-bottom: 10px;
    }

    .itemlist th {
        border: 2px solid lightgrey;
        text-align: left;
        padding: 10px;
        font-size: 18px;
        color: white;
        background-color: midnightblue;
    }

    .itemlist td {
        border: 1px solid lightgray;
        padding: 10px;
    }

    em {
        color: red;

    }

    .button {
        background-color: midnightblue;
        color: white;
        padding: 7px 12px;
        letter-spacing: 3px;
    }

    .button:hover {
        background-color: green;
        color: white;
        cursor: pointer;
    }

    .buttonClose {
        background-color: midnightblue;
        color: white;
        padding: 7px 12px;
        letter-spacing: 3px;


    }

    .buttonClose:hover {
        background-color: red;
        color: white;

        cursor: pointer;
    }

    .buttons {
        float: right;
    }

    /*select {
  
  border-radius: 0.25em;
  padding: 0.25em 0.5em;
  font-size: 1.25rem;
  cursor: pointer;
  line-height: 1.1;
  background-color: #fff;
}*/

    /* SUPPLIER LIST STYLE */

    .input__container {
        position: relative;
    }

    .list__container {
        opacity: 0;
        z-index: -1;
        position: absolute;
        background-color: #fefefe;
        transition: all 0.1s;
    }

    .list__container--supplier {
        width: 80%;
    }

    .list__container--class {
        width: 50%;
    }


    .list {
        list-style-type: none;
        padding-left: 10px;
        cursor: pointer;
    }

    .list li:hover {
        background-color: lightgrey;
    }

    .active__list {
        opacity: 1;
        z-index: 1;
    }
</style>



<div class="con-form">
    <div class="content-area">
        <fieldset style="border: none;">
            <legend>
                <h2 style="letter-spacing: 6px;">
                    <font color="midnightblue">
                        <center>ITEMLIST
                    </font>
                </h2>
            </legend>
            <hr style=" border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">

            <?php include('table/itemlist_table.php') ?>
    </div>



    </fieldset>
</div>
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h2>Create New Item</h2>
        </div>
        <div class="modal-body">
            <span class="close">&times;</span>
            <fieldset style="border:none">
                <legend style="font-weight: bolder; letter-spacing: 6px;">
                    <h2>ITEMLIST : ENTERING RECORD</h2>
                </legend>
                <hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                <form method="GET" autocomplete="off" action="php/connect/itemlist_additem_con.php">

                    <table width="100%">
                        <tr>
                            <th style="text-align: left;" width="30%">Item Description&nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;" width="30%">Item Type&nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;" width="40%"></th>

                        </tr>
                        <tr>
                            <td> <input type="text" name="product_name" style=" width:460px;border: 1px solid gray; height: 36px; border-radius: 5px;" required tabindex="1"></td>
                            <td colspan="4" class='input__container' style="display: none;"><input type="hidden" name="sup_id" class="container--supplier__id"><input name="sup_name" style="width:500px; height: 35px; border: 1px solid gray; border-radius: 5px;" class="input__search--supplier modal__trigger--supplier" tabindex="-1">
                                <div class="list__container--supplier list__container">
                                    <ul class="list list--supplier">

                                    </ul>

                                </div>
                            </td>
                            <td style="text-align: left;">
                                <select name="product_type_id" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required>
                                    <option></option>
                                    <?php
                                    include "config.php";
                                    $records = mysqli_query($db, "SELECT * FROM product_type ORDER BY product_type_id ASC");

                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['product_type_id'] . "'>" . $data['product_type_name'] . "</option>";
                                    }
                                    ?>
                                </select>

                            </td>
                        </tr>
                    </table>
                    <br>
                    <table width="100%">
                        <tr>
                            <th style="text-align: left;">Quantity &nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;">Unit &nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;">Barcode</th>

                        </tr>
                        <tr>
                            <td><input class='next__tab' tabindex="2" required="number" type="number" name="qty" onchange="setDecimal" min="0" max="9999999999" step="0.0000001" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required></td>
                            <td>
                                <select name="unit_id" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required>
                                    <option></option>
                                    <?php

                                    $records = mysqli_query($db, "SELECT * FROM unit_tb ORDER BY unit_name ASC");

                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['unit_id'] . "'>" . $data['unit_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="barcode" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;"></td>

                        </tr>
                    </table>
                    <br>
                    <tr>
                        <table width="100%">
                            <th style="text-align: left;">Class &nbsp; <i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;">Department &nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                            <th style="text-align: left;">Location &nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></th>
                    </tr>
                    <tr>
                        <td class='input__container'>
                            <input type="hidden" name="class_id" class="container--class__id">
                            <input name="class_name" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required class="input__search--class">
                            <div class="list__container--class list__container">
                                <ul class="list list--class">

                                </ul>

                            </div>
                        </td>
                        <td><select name=" dept_id" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required>
                                <option></option>
                                <?php

                                $records = mysqli_query($db, "SELECT * FROM dept_tb");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td><select name="loc_id" id="select-state" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" required>
                                <option value=""></option>
                                <?php

                                $records = mysqli_query($db, "SELECT * FROM loc_tb");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <script>
                                $(document).ready(function() {
                                    $('select').selectize({
                                        sortField: 'text'
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                    </table>
                    <br>
                    <table width="100%">
                        <tr>
                            <th style="text-align: left;">Price</th>
                            <th style="text-align: left;">Cost</th>
                            <th style="text-align: left;">Remarks</th>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" onchange="setTwoNumberDecimal" min="0" max="9999999" step="any" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;"></td>
                            <td><input type="number" name="cost" onchange="setTwoNumberDecimal" min="0" max="9999999" step="any" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;"></td>
                            <td><input type="text" name="pro_remarks" style="width: 250px; height: 35px; border: 1px solid gray; border-radius: 5px;" value=""></td>
                        </tr>
                    </table>
                    <br>
                    <hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
                    <p style="float: left;"><i>Fill out form with </i>&nbsp;<i style="color: red;" class='fas fa-exclamation-circle'></i></p><br>

                    <div class="buttons">
                        <button type="submit" class="button" name="add">Save</button>
                    </div>
                </form>


            </fieldset>

        </div>
    </div>
</div>




<!-- Scripts Starts here -->


<script>
    function setDecimal(event) {
        this.value = parseFloat(this.value).toFixed(13);
    }
</script>
<script>
    $(document).ready(function() {

        $('#hover tr').click(function() {
            var href = $(this).find("a").attr("href");
            if (href) {
                window.location = href;
            }
        });

    });
</script>

<script>
    'use strict';


    const selectedData = {}

    // Supplier Searching
    const inputSearchSupplier = document.querySelector('.input__search--supplier');
    const containerSupplierList = document.querySelector('.list__container--supplier');
    const supplierList = document.querySelector('.list--supplier');
    const containerSupplierId = document.querySelector('.container--supplier__id');

    // Class Searching
    const inputSearchClass = document.querySelector('.input__search--class');
    const containerClassList = document.querySelector('.list__container--class');
    const classList = document.querySelector('.list--class');
    const containerClassId = document.querySelector('.container--class__id');




    // Get the modal
    const modal = document.getElementById("myModal");

    // Get the button that opens the modal
    const btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // Select Supplier
    const selectSupplier = function(e) {
        const target = e.target.closest('li');
        selectedData.supId = target.dataset.supid;
        selectedData.supName = target.dataset.supname;
        inputSearchSupplier.value = target.textContent;
        containerSupplierId.value = selectedData.supId;
    };

    // Select Class
    const selectClass = function(e) {
        const target = e.target.closest('li');
        selectedData.classId = target.dataset.classid;
        selectedData.className = target.dataset.classname;
        inputSearchClass.value = target.textContent;
        containerClassId.value = selectedData.classId;
    };

    // Search Supplier
    const searchSupplier = function() {
        supplierList.innerHTML = "";
        fetch(`php/searchsupplier.php?q=${this.value}`).then(function(response) {
                console.log(response);
                return response.json();
            })
            .then(function(data) {
                data.forEach(data => {
                    console.log(data.sup_name, data.sup_id);
                    supplierList.insertAdjacentHTML('beforeend', `<li data-supId='${data.sup_id}' data-supName='${data.sup_name}'>${data.sup_name}</li>`)
                });
            });
    };

    // Search Class
    const searchClass = function() {
        classList.innerHTML = "";
        fetch(`php/searchclass.php?q=${this.value}`).then(function(response) {
                console.log(response);
                return response.json();
            })
            .then(function(data) {
                data.forEach(data => {
                    classList.insertAdjacentHTML('beforeend', `<li data-classid='${data.class_id}' data-classname='${data.class_name}'>${data.class_name}</li>`)
                });
            });
    };

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Show Supplier list
    inputSearchSupplier.addEventListener('keyup', function() {
        containerSupplierList.classList.add('active__list')
    });

    // Hide Supplier List
    inputSearchSupplier.addEventListener('blur', function() {
        setTimeout(function() {
            containerSupplierList.classList.remove('active__list')
        }, 100);
    });

    inputSearchSupplier.addEventListener('keyup', searchSupplier.bind(inputSearchSupplier))

    supplierList.addEventListener('click', selectSupplier);


    // Show Class list
    inputSearchClass.addEventListener('keyup', function() {
        containerClassList.classList.add('active__list')
    });

    // Hide Class List
    inputSearchClass.addEventListener('blur', function() {
        setTimeout(function() {
            containerClassList.classList.remove('active__list')
        }, 100);
    });

    inputSearchClass.addEventListener('keyup', searchClass.bind(inputSearchClass));

    classList.addEventListener('click', selectClass);
</script>





<?php include "footer.php"; ?>