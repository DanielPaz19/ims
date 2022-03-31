<?php include('header_main.php');
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
?>
<?php include('php/config.php'); ?>


<style>
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
        margin: auto;
        padding: 0;
        border: 5px solid #cce0ff;
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
</style>


<?php include('table/itemlist_table.php') ?>

<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">

            <!-- <h3>Itemlist: Adding Records </h3> -->
        </div>
        <div class="modal-body" style="background-color:whitesmoke;">
            <span class="close">&times;</span>
            <h3 style="color:#0d6efd"><i class="bi bi-boxes"></i> Itemlist : Adding Records</h3>
            <hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
            <form method="GET" autocomplete="off" action="php/connect/itemlist_additem_con.php">
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="product_name" required>
                            <label for="floatingInput">Item Description</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="product_type_id" required>
                                <option></option>
                                <?php
                                include "config.php";
                                $records = mysqli_query($db, "SELECT * FROM product_type ORDER BY product_type_id ASC");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['product_type_id'] . "'>" . $data['product_type_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Item-Type</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingInput" name="qty" onchange="setDecimal" min="0" max="9999999999" step="0.0000001">
                            <label for="floatingInput">Quantity</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="unit_id" required>
                                <option></option>
                                <?php
                                include "config.php";
                                $records = mysqli_query($db, "SELECT * FROM unit_tb ORDER BY unit_name ASC");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['unit_id'] . "'>" . $data['unit_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Unit</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="barcode">
                            <label for="floatingInput">Barcode</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="class_id" required>
                                <option></option>
                                <?php
                                include "config.php";
                                $records = mysqli_query($db, "SELECT * FROM class_tb ORDER BY class_name ASC");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['class_id'] . "'>" . $data['class_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Classification</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dept_id" required>
                                <option></option>
                                <?php
                                include "config.php";
                                $records = mysqli_query($db, "SELECT * FROM dept_tb ORDER BY dept_name ASC");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Department</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="loc_id" required>
                                <option></option>
                                <?php
                                include "config.php";
                                $records = mysqli_query($db, "SELECT * FROM loc_tb");

                                while ($data = mysqli_fetch_array($records)) {
                                    echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Location</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mt-3">
                            <input type="number" class="form-control" id="floatingInput" name="price">
                            <label for="floatingInput">Price</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mt-3">
                            <input type="number" class="form-control" id="floatingInput" name="cost">
                            <label for="floatingInput">Cost</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" id="floatingInput" name="remarks">
                            <label for="floatingInput">Remarks</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-success" name="add"> Save Record</button>
                    </div>
                </div>
            </form>




























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