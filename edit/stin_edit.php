<?php

use PhpMyAdmin\Database\Search;

include('../php/config.php');

if (isset($_POST['stin_submit'])) {
  $id = $_POST['id'];
  $stin_code = mysqli_real_escape_string($db, $_POST['stin_code']);
  $stin_title = mysqli_real_escape_string($db, $_POST['stin_title']);
  $stin_remarks = mysqli_real_escape_string($db, $_POST['stin_remarks']);
  $stin_date = mysqli_real_escape_string($db, $_POST['stin_date']);

  mysqli_query($db, "UPDATE stin_tb SET stin_code='$stin_code', stin_title='$stin_title' ,stin_remarks='$stin_remarks',stin_date='$stin_date'  WHERE stin_id='$id'");

  header("Location:../main/stin_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];
  $result = mysqli_query($db, "SELECT * FROM stin_tb  WHERE stin_id=" . $_GET['id']);

  $row = mysqli_fetch_array($result);

  if ($row) {

    $id = $row['stin_id'];
    $stin_code = $row['stin_code'];
    $stin_title = $row['stin_title'];
    $stin_remarks = $row['stin_remarks'];
    $stin_date = $row['stin_date'];
  } else {
    echo "No results!";
  }
}


// Check product ID if exist on stin_product table
// If product ID exist, update the record
// If product ID doesnt exist, add record



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
      border: 5px solid lightgrey;
      height: 650px;
    }

    legend {
      letter-spacing: 3px;
      font-weight: bolder;
      color: midnightblue;
      font-size: 24px;
    }

    .container {
      border-radius: 10px;
      padding: 50px;
      height: 750px;
      background-color: #EAEAEA;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
      margin-bottom: 10px;

    }


    .itemTb {
      border: 3px solid lightgray;
      border-collapse: collapse;
      width: 100%;

    }

    .itemTb tr:nth-child(even) {
      background-color: #E7E8F8;
    }

    .itemTb tr:nth-child(odd) {
      background-color: white;
    }

    .itemTb th {
      border: 1px solid lightgrey;
      text-align: left;
      padding: 10px;
      font-size: 18px;
      color: white;
      background-color: midnightblue;
    }

    .itemTb td {
      border: 1px solid lightgray;
      padding: 9px;
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





    /*.table1 td,th {
border: 1px solid black;
}*/
  </style>

</head>
<title>Edit STOCK-IN</title>

<body style="margin: 0px;" bgcolor="#B0C4DE">
  <div class="container">
    <fieldset>
      <legend>&nbsp;&nbsp;&nbsp;Stock-Inventory IN: Editing Record&nbsp;&nbsp;&nbsp;</legend>
      <form autocomplete="off" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <table class="table1">
          <tr>
            <td><b>
                <font color='midnightblue'>Code:</font>
              </b></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><label>
                <input type="text" class="form-control" name="stin_code" value="<?php echo $stin_code; ?>">
              </label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td><b>
                <font color='midnightblue'>Title:</font>
              </b></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><label>
                <input type="text" class="form-control" name="stin_title" value="<?php echo $stin_title; ?>" />
              </label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td><b>
                <font color='midnightblue'>Remarks:</font>
              </b></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><label>
                <input type="text" class="form-control" name="stin_remarks" value="<?php echo $stin_remarks; ?>">
              </label></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

            <td><b>
                <font color='midnightblue'>Date:</font>
              </b></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td><label>
                <input type="date" class="form-control" name="stin_date" value="<?php echo $stin_date; ?>">
              </label></td>
            <td><button class="button__add--item">ADD ITEM</button></td>
          </tr>

        </table>

        <br>
        <table class="itemTb">
          <tr>
            <th style="text-align: left;">ID</th>
            <th style="text-align: left;">Item Description</th>
            <th style="text-align: left;">On-Hand</th>
            <th style="text-align: left;">Qty-In</th>
            <th style="text-align: left;">Unit</th>
            <th style="text-align: left;">Cost</th>
            <th style="text-align: left;">Discount Amount</th>
            <th style="text-align: left;">Incomming Qty</th>
            <th style="text-align: center;">Action</th>
          </tr>

          <?php
          include "../php/config.php";
          $sql = "SELECT product.product_id, product.product_name,product.qty,stin_product.stin_temp_qty,unit_tb.unit_name,product.cost,stin_product.stin_temp_disamount FROM product INNER JOIN stin_product ON stin_product.product_id=product.product_id INNER JOIN stin_tb ON stin_product.stin_id=stin_tb.stin_id INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id WHERE stin_tb.stin_id='$id' ORDER BY product.product_id ASC";

          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {

            while ($irow = $result->fetch_assoc()) {
              $count = $count + 1;
              $total = $irow['qty'] + $irow['stin_temp_qty'];
          ?>

              <tr>

                <td style="text-align: left;"><?php echo $irow['product_id'] ?><input type="hidden" name="productId[]" value="<?php echo $irow['product_id'] ?>"></td>
                <td style="text-align: left;"><?php echo $irow['product_name'] ?></td>
                <td style="text-align: left;"><?php echo $irow['qty'] ?></td>
                <td style="text-align: left;"><?php echo $irow['stin_temp_qty'] ?><input type="hidden" name="stinTempQty[]" value="<?php echo $irow['stin_temp_qty'] ?>"></td>
                <td style="text-align: left;"><?php echo $irow['unit_name'] ?></td>
                <td style="text-align: left;"><?php echo $irow['cost'] ?><input type="hidden" name="cost[]" value="<?php echo $irow['cost'] ?>"></td>
                <td style="text-align: left;"><?php echo $irow['stin_temp_disamount'] ?><input type="hidden" name="discount[]" value="<?php echo $irow['stin_temp_disamount'] ?>"></td>
                <td style="text-align: left;"><?php echo $irow['qty'] + $irow['stin_temp_qty'] ?><input type="hidden" name="incomingQty[]" value="<?php echo $irow['qty'] + $irow['stin_temp_qty'] ?>"></td>
                <td>
                  <center>
                    <a href="../edit/item_edit/stin_itemedit.php?<?php echo 'id=' . $id . '&prodId=' . $irow['product_id'] . '&Tot=' . $total; ?>" title="Edit"><i class="fa fa-edit" style="font-size:24px"></i></a>
                    &nbsp;
                    <a href="stin_item_delete.php?id=<?php echo $id; ?>" title="Remove">
                      <font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
                    </a>
                </td>


              </tr>
          <?php }
          } ?>
        </table>
        <br>
        <button class="butLink" name="stin_submit" onclick="alert('Edit Records Successfully !')">Update</button>
      </form>
      <br>
      <a href="../main/stin_main.php"><button class="butLink">Cancel</button></a>
    </fieldset>
    <!-- EDIT PO END -->
  </div>

  <div class="container--modal">
    <div class='modal--add__item'>
      <span class='close--modal'>Close</span>
      <button class="button--add__item">New Item</button>
      <input type="text" class='input--search' placeholder="Search Item...">
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


    const modalOpen = function(e) {
      e.preventDefault();
      containerModalAddItem.classList.add('modal--active');
      showData("../pos/php/search-product.php", "", containerItemList);
    };

    const modalClose = function() {
      containerModalAddItem.classList.remove('modal--active');
    };

    const searchItem = function() {
      const queue = inputSearch.value;
      showData("../pos/php/search-product.php", `${queue}`, containerItemList);
    };

    const selectItem = function(e) {
      const selectedId = e.target.closest('tr').dataset.id;
      const selectedName = e.target.closest('tr').querySelector('.item-name').innerHTML;
      const selectedQty = e.target.closest('tr').querySelector('.qty').innerHTML;
      const qtyIn = prompt("Enter Qty-in:");
      const selectedUnit = e.target.closest('tr').querySelector('.unit').innerHTML;
      const selectedCost = prompt("Enter Cost Amount:");
      const selectedDiscount = prompt("Enter Discount Amount:");
      const incomingQty = +selectedQty + +qtyIn;

      modalClose();

      tableItemTb.querySelector('tbody').insertAdjacentHTML('beforeend', `<tr>
      <td>${selectedId}<input type="hidden" name="productId[]" value="${selectedId}"></td>
      <td>${selectedName}</td>
      <td>${selectedQty}</td>
      <td>${qtyIn}<input type="hidden" name="stinTempQty[]" value="${qtyIn}"></td>
      <td>${selectedUnit}</td>
      <td>${selectedCost}<input type="hidden" name="cost[]" value="${selectedCost}"></td>
      <td>${selectedDiscount}<input type="hidden" name="discount[]" value="${selectedDiscount}"></td>
      <td>${incomingQty}<input type="hidden" name="incomintQty[]" value="${incomingQty}"></td>
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
  </script>

</html>