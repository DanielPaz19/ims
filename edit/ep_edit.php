<?php

include('../php/config.php');

if (isset($_POST['ep_submit'])) {
    $id = $_POST['id'];
    $epNo = mysqli_real_escape_string($db, $_POST['ep_no']);
    $epTitle = mysqli_real_escape_string($db, $_POST['ep_title']);
    $epRemarks = mysqli_real_escape_string($db, $_POST['ep_remarks']);
    $ep_date = mysqli_real_escape_string($db, $_POST['ep_date']);
    // $customersId = mysqli_real_escape_string($db, $_POST['customers_id']);
    $productId = $_POST['productId'];
    $epQty = $_POST['qty'];
    $price = $_POST['price'];
    // $incomintQty = $_POST['incomingQty'];


    mysqli_query($db, "UPDATE ep_tb SET ep_no='$epNo', ep_title='$epTitle',ep_date='$ep_date'  WHERE ep_id='$id'");



    function updateEpProd($id, $productId, $epQty, $price, $discount, $incomintQty)
    {
        include('../php/config.php');
        mysqli_query($db, "UPDATE ep_product SET ep_qty = '$epQty',  ep_price = '$price', 
   ep_totPrice = '$incomintQty' WHERE ep_id = '$id' AND product_id = '$productId'");
    }

    function addEpProdRecord($productId, $id, $epQty, $price, $incomintQty)
    {
        include('../php/config.php');
        mysqli_query($db, "INSERT INTO ep_product(product_id, ep_id, ep_qty, ep_price, ep_totPrice)
  VALUES ('$productId', '$id', '$epQty', '$price', '$incomintQty')");
    }


    // If product ID exist, update the record
    // If product ID doesnt exist, add record

    $counter = 0;
    while (count($productId) !== $counter) {
        $result =  mysqli_query($db, "SELECT * FROM ep_product  WHERE product_id = $productId[$counter] AND stout_id = $id");
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            addEpProdRecord($productId[$counter], $id, $epQty[$counter], $price[$counter], $discount[$counter],  $incomintQty[$counter]);
        } else {
            updateEpProd($id, $productId[$counter], $epQty[$counter], $price[$counter], $discount[$counter], $incomintQty[$counter]);
        }
        $counter++;
    }

    // header("Location:../ep_main.php");
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $id = $_GET['id'];
    $result = mysqli_query($db, "SELECT ep_tb.ep_id ,ep_tb.ep_no, ep_tb.ep_title, ep_tb.ep_date, ep_tb.ep_remarks, customers.customers_name, customers.customers_id
    FROM ep_tb
    LEFT JOIN customers ON customers.customers_id = ep_tb.customers_id
    WHERE ep_id=" . $_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $id = $row['ep_id'];
        $ep_no = $row['ep_no'];
        $ep_title = $row['ep_title'];
        $ep_date = $row['ep_date'];
        $ep_remarks = $row['ep_remarks'];
        $customerId = $row['customers_id'];
        $customerName = $row['customers_name'];
    } else {
        echo "No results!";
    }
}

/* TEST CODE*/

/* TEST CODE END */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            font-family: sans-serif;

        }

        body {
            padding: 50px;
        }

        fieldset {
            padding: 30px;
            font-family: sans-serif;
            border: none;
            height: 650px;
        }

        legend {
            letter-spacing: 3px;
            font-weight: bolder;
            color: midnightblue;
            font-size: 24px;
        }

        /* .container {
            border-radius: 10px;
            padding: 50px;
            height: 750px;
            background-color: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            margin-bottom: 10px;

        } */


        .table2 {
            border: 3px solid lightgray;
            border-collapse: collapse;
            width: 70%;
            float: right;

        }

        .table2 tr:nth-child(even) {
            background-color: #E7E8F8;
        }

        .table2 tr:nth-child(odd) {
            background-color: white;
        }

        .table2 th {
            border: 1px solid lightgrey;
            text-align: left;
            padding: 5px;
            font-size: 16px;
            color: white;
            background-color: midnightblue;
        }

        .table2 td {
            border: 1px solid lightgray;
            padding: 5px;
        }

        input[type=text] {
            height: 24px;
        }

        input[type=date] {
            height: 24px;
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
        }

        /* Modal Style */
        .container--modal {
            opacity: 0;
            position: fixed;
            z-index: -1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: scroll;
            background-color: rgb(0, 0, 0);
            transition: 0.3s;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal--add__item {
            position: relative;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            height: 500px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .modal--active {
            z-index: 1;
            opacity: 1;
            transition: 0.3s;
        }

        .table--container {
            height: 90%;
            overflow-y: scroll;
        }

        .modal--table__itemlist {
            table-layout: fixed;
            width: 100%;

        }

        .modal--table__itemlist th {
            height: 30px;
            background-color: midnightblue;
            color: #ffffff;
            font-size: 15px;
            position: sticky;
            top: 0;
        }

        .modal--table__itemlist tbody {
            font-size: 15px;
        }

        .modal--table__itemlist :hover {
            cursor: pointer;
        }

        .modal--table__itemlist td {
            padding: 2px 5px;
        }

        .button--add__item {
            color: #ffffff;
            background-color: midnightblue;
            height: 35px;
            width: 100px;
            margin-bottom: 10px;
        }

        .input--search {
            width: 500px;
            padding: 2px 5px;
            margin-left: 20px;
        }

        .close--modal {
            color: red;
            font-weight: bold;
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .close--modal:hover {
            cursor: pointer;
            color: black;
            font-weight: bold;
        }


        .modal--table__itemlist tr:hover {
            background-color: lightgray;
        }

        /* Item Code */
        .modal--table__itemlist th:nth-child(1) {
            width: 10%;
        }

        .modal--table__itemlist td:nth-child(1) {
            text-align: center;
        }

        /* Item Name */
        .modal--table__itemlist th:nth-child(2) {
            width: 30%;
        }

        .modal--table__itemlist td:nth-child(2) {
            text-align: left;
        }

        /* Quantity */
        .modal--table__itemlist th:nth-child(3) {
            width: 10%;
        }

        .modal--table__itemlist td:nth-child(3) {
            text-align: center;
        }

        /* Unit */
        .modal--table__itemlist th:nth-child(4) {
            width: 10%;
        }

        .modal--table__itemlist td:nth-child(4) {
            text-align: center;
        }

        /* Location */
        .modal--table__itemlist th:nth-child(5) {
            width: 10%;
        }

        .modal--table__itemlist td:nth-child(5) {
            text-align: center;
        }

        /* Cost */
        .modal--table__itemlist th:nth-child(6) {
            width: 10%;
        }

        .modal--table__itemlist td:nth-child(6) {
            text-align: right;
        }

        .button__add--item {
            color: white;
            cursor: pointer;
            background-color: midnightblue;
        }


        .highlight {
            font-weight: bolder;
            color: orangered;
            cursor: pointer;
        }

        .form-control {
            border: 2px solid lightgray;
        }

        .table1 td,
        th {
            border: 1px solid black;
        }

        .table2 td,
        th {
            border: 1px solid black;
        }

        .table1 {
            float: left;
        }
    </style>

</head>
<title>Edit Exit-Pass-Records</title>

<body style="margin: 0px;" bgcolor="#B0C4DE">
    <div class="container">
        <a href="../ep_main.php" style="float: right;"><i class="fa fa-close" style="font-size:24px; color: red;"></i></a><br>
        <fieldset>
            <legend>&nbsp;&nbsp;&nbsp;Exit-Pass: Editing Record&nbsp;&nbsp;&nbsp;</legend>
            <form autocomplete="off" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <table class="table1" width="20%">
                    <tr>
                        <td><b>
                                <font color='midnightblue'>Ep No. :</font><br> <input type="text" class="form-control" name="ep_no" value="<?php echo $ep_no; ?>"> <br><br>
                                <font color='midnightblue'>Title:</font><br> <input type="text" class="form-control" name="ep_title" value="<?php echo $ep_title; ?>" /><br><br>
                                <font color='midnightblue'>Date:</font><br> <input type="date" class="form-control" name="stout_date" value="<?php echo $ep_date; ?>"><br><br>
                                <label>Remarks</label><br>
                                <textarea name="ep_remarks" cols="50" rows="10"><?php echo $ep_remarks; ?></textarea> <br> <br>
                                <label>Customer </label><br>
                                <select name="customers_id" class="select--customer">
                                    <option value="<?php echo $_GET['customerId'] ?>"><?php echo $_GET['customerName']; ?></option>
                                    <?php

                                    $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name ASC ");
                                    while ($data = mysqli_fetch_array($records)) {
                                        echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
                                    }
                                    ?>
                                </select> <br> <br>
                                <button class="butLink" name="stout_submit" onclick="alert('Edit Records Successfully !')">Update</button>

                        </td>
                    </tr>

                </table>
                <br>
                <button class="button__add--item" title="Add Item" style="font-size: 18px; padding: 8px; float:right"><i class="fa fa-plus-circle"></i>&nbsp;Add Item</button>
                <br>
                <table class="table2">
                    <thead>
                        <tr>
                            <th style="text-align: left;">Prod. ID</th>
                            <th>Item Description</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Subtotal Price</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include "../php/config.php";

                        $sql = "SELECT product.product_id, product.product_name, ep_product.ep_qty, ep_product.ep_price, ep_product.ep_totPrice, unit_tb.unit_name 
                        FROM ep_product
                        LEFT JOIN product ON product.product_id = ep_product.product_id
                        LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
                        WHERE ep_product.ep_id='$id' 
                        ORDER BY product.product_id ASC
                         ";

                        $result = $db->query($sql);
                        $count = 0;
                        if ($result->num_rows >  0) {

                            while ($irow = $result->fetch_assoc()) {
                                $count = $count + 1;
                        ?>
                                <tr>
                                    <td style="text-align: left;"><?php echo $irow['product_id'] ?><input type="hidden" name="productId[]" value="<?php echo $irow['product_id'] ?>" class="stout--product__id"></td>
                                    <td style="text-align: left;"><?php echo $irow['product_name'] ?></td>
                                    <td style="text-align: left;" class="highlight" title="Double Click to Edit"><?php echo $irow['ep_qty'] ?>
                                        <input type="hidden" name="qty[]" value="<?php echo $irow['ep_qty'] ?>" class='ep--qtyout'>
                                    </td>
                                    <td style="text-align: left;"><?php echo $irow['unit_name'] ?></td>
                                    <td style="text-align: left;" class="highlight" title="Double Click to Edit"><?php echo $irow['ep_price'] ?><input type="hidden" name="price[]" value="<?php echo $irow['ep_price'] ?>" class='ep--price'></td>
                                    <td style="text-align: left;"><?php echo $irow['ep_qty'] * $irow['ep_price'] ?><input type="hidden" name="totPrice[]" value="<?php echo $irow['ep_qty'] * $irow['ep_qty'] ?>" class='stin--incoming__qty'></td>


                                    <td>
                                        &nbsp;
                                        <a href="item_delete/stout_item_delete.php?id=<?php echo $irow['product_id']; ?>&stoutId=<?php echo $irow['stout_id'] ?>">
                                            <font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
                                        </a>
                                    </td>


                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <br>

            </form>
            <br>
        </fieldset>
        <!-- <p style="float: left;">*&nbsp;<i>Editable Row</i> <button style="background-color: orangered" disabled>&nbsp;&nbsp;</button> </p> -->
        <!-- EDIT PO END -->
    </div>

    <div class="container--modal">
        <div class='modal--add__item'>

            <a href=""><button onclick="showadditem()" class="button--add__item">New Item</button></a>

            <input type="text" class='input--search' placeholder="Search Item..."><br>
            <span class='close--modal' style="float: right;"><i class="fa fa-close"></i></span>
            <div class='table--container'>
                <table class="modal--table__itemlist">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
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

    <script>
        'user strict';
        const buttonAddItem = document.querySelector('.button__add--item');
        const containerModalAddItem = document.querySelector('.container--modal');
        const modalAddItem = document.querySelector('.modal--add__item');
        const buttonCloseModal = document.querySelector('.close--modal');
        const containerItemList = document.querySelector('.container--itemlist');
        const inputSearch = document.querySelector('.input--search');
        const tableItemTb = document.querySelector('.itemTb');

        const stinEdit = function(e) {
            const target = e.target.closest('td').children[0];
            const prevValue = target.closest('td').childNodes[0].textContent;

            console.log(prevValue);


            const changeValue = function(promptMessage) {
                let newValue = prompt(promptMessage);

                if (!newValue || newValue.includes(' ')) return;

                target.closest('td').childNodes[0].textContent = newValue;
                target.value = newValue;
            }

            if (!target) return;


            if (target.classList.contains('ep--qtyout')) {
                changeValue("Enter New Qty-Out");
            }

            if (target.classList.contains('ep--price')) {
                changeValue("Enter New Price");
            }

            if (target.classList.contains('stout--discount')) {
                changeValue("Enter New Discount");
            }

        };

        const modalOpen = function(e) {
            e.preventDefault();
            containerModalAddItem.classList.add('modal--active');
            showData("../php/searchitem.php", "", containerItemList);
        };

        const modalClose = function() {
            containerModalAddItem.classList.remove('modal--active');
        };

        const searchItem = function() {
            const queue = inputSearch.value;
            showData("../php/searchitem.php", `${queue}`, containerItemList);
        };

        const selectItem = function(e) {
            const selectedId = e.target.closest('tr').dataset.id;
            const selectedName = e.target.closest('tr').querySelector('.item-name').innerHTML;
            const selectedQty = e.target.closest('tr').querySelector('.qty').innerHTML;
            const qtyIn = prompt("Enter Qty-out:");
            const selectedUnit = e.target.closest('tr').querySelector('.unit').innerHTML;
            const selectedCost = prompt("Enter Cost Amount:");
            const selectedDiscount = prompt("Enter Discount Amount:");
            const incomingQty = +selectedQty - +qtyIn;

            modalClose();

            tableItemTb.querySelector('tbody').insertAdjacentHTML('beforeend', `<tr>
      <td>${selectedId}<input type="hidden" name="productId[]" value="${selectedId}" class='stout--product__id'></td>
      <td>${selectedName}</td>
      <td>${selectedQty}</td>
      <td>${qtyIn}<input type="hidden" name="qty[]" value="${qtyIn}" class='ep--qtyout'></td>
      <td>${selectedUnit}</td>
      <td>${selectedCost}<input type="hidden" name="cost[]" value="${selectedCost}" class='ep--price'></td>
      <td>${selectedDiscount}<input type="hidden" name="discount[]" value="${selectedDiscount}" class='stout--discount'></td>
      <td>${incomingQty}<input type="hidden" name="incomintQty[]" value="${incomingQty}" class='stin--incoming__qty'></td>
      <td><center><a href="item_delete/stin_item_delete.php?stinProdId=<?php echo $irow["ep_product_id"] ?>" title="Remove">
                        <font color=" red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
                      </a></center></td>
      </tr>
      `)
        };

        const showData = function(file, input, container) {
            // Create an XMLHttpRequest object
            const xhttp = new XMLHttpRequest();

            // Define a callback function
            xhttp.addEventListener('load', function() {
                const data = JSON.parse(this.responseText);
                showTableData(data, container);
            });

            // Send a request
            xhttp.open("POST", file + `?q=${input}`);
            xhttp.send();
        };

        const showTableData = (data, container) => {
            container.innerHTML = "";
            console.log(data);

            data.forEach((data, index) => {
                let row = `<tr class='product-data product${index}' data-id ='${data.product_id}'>
                          <td class='item-code'>${data.product_id.padStart(8,0)}</td>
                          <td class='item-name'>${data.product_name}</td>
                          <td class='qty'>${data.qty}</td>
                          <td class='unit'>${data.unit_name}</td>
                          <td class='location'>${data.loc_name}</td>
                          <td class='cost'>${(+data.cost).toFixed(2)}</td>
                    </tr>`;
                container.innerHTML += row;

            });
        };


        buttonAddItem.addEventListener('click', modalOpen);

        buttonCloseModal.addEventListener('click', modalClose);

        inputSearch.addEventListener('keyup', searchItem)

        containerItemList.addEventListener('dblclick', selectItem)

        tableItemTb.querySelector('tbody').addEventListener('dblclick', stinEdit)
    </script>


    <script type='text/javascript'>
        function showadditem() {
            //set the width and height of the 
            //pop up window in pixels
            var width = 1200;
            var height = 500;

            //Get the TOP coordinate by
            //getting the 50% of the screen height minus
            //the 50% of the pop up window height
            var top = parseInt((screen.availHeight / 2) - (height / 2));

            //Get the LEFT coordinate by
            //getting the 50% of the screen width minus
            //the 50% of the pop up window width
            var left = parseInt((screen.availWidth / 2) - (width / 2));

            //Open the window with the 
            //file to show on the pop up window
            //title of the pop up
            //and other parameter where we will use the
            //values of the variables above
            window.open('../edit/item_edit_addnew.php',
                "Contact The Code Ninja",
                "menubar=no,resizable=yes,width=1300,height=600,scrollbars=yes,left=" +
                left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
        }
    </script>


</html>