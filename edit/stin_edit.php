<?php

// use PhpMyAdmin\Database\Search;

include('../php/config.php');

if (isset($_POST['stin_submit'])) {
  $id = $_POST['id'];
  $stin_code = mysqli_real_escape_string($db, $_POST['stin_code']);
  $stin_title = mysqli_real_escape_string($db, $_POST['stin_title']);
  $stin_remarks = mysqli_real_escape_string($db, $_POST['stin_remarks']);
  $stin_date = mysqli_real_escape_string($db, $_POST['stin_date']);
  $productId = $_POST['productId'];
  $stinTempQty = $_POST['stinTempQty'];
  $cost = $_POST['cost'];
  $discount = $_POST['discount'];
  $incomintQty = $_POST['incomingQty'];

  mysqli_query($db, "UPDATE stin_tb SET stin_code='$stin_code', stin_title='$stin_title' ,stin_remarks='$stin_remarks',stin_date='$stin_date'  WHERE stin_id='$id'");


  function updateStinProd($id, $productId, $stinTempQty, $cost, $discount, $incomintQty)
  {
    include('../php/config.php');
    mysqli_query($db, "UPDATE stin_product SET stin_temp_qty = '$stinTempQty',  stin_temp_cost = '$cost', 
    stin_temp_disamount = '$discount', stin_temp_tot = '$incomintQty' WHERE stin_id = '$id' AND product_id = '$productId'");
  }

  function addStinProdRecord($productId, $id, $stinTempQty, $cost, $discount,  $incomintQty)
  {
    include('../php/config.php');
    mysqli_query($db, "INSERT INTO stin_product(product_id, stin_id, stin_temp_qty, stin_temp_cost, stin_temp_disamount, stin_temp_tot)
    VALUES ('$productId', '$id', '$stinTempQty', '$cost', '$discount',  '$incomintQty')");
  }


  // If product ID exist, update the record
  // If product ID doesnt exist, add record
  $counter = 0;
  while (count($productId) !== $counter) {
    $result =  mysqli_query($db, "SELECT * FROM stin_product  WHERE product_id = $productId[$counter] AND stin_id = $id");
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
      addStinProdRecord($productId[$counter], $id, $stinTempQty[$counter], $cost[$counter], $discount[$counter],  $incomintQty[$counter]);
    } else {
      updateStinProd($id, $productId[$counter], $stinTempQty[$counter], $cost[$counter], $discount[$counter], $incomintQty[$counter]);
    }
    $counter++;
  }



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
      padding: 5px;
      font-size: 16px;
      color: white;
      background-color: midnightblue;
    }

    .itemTb td {
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


    /* .table1 td,
    th {
      border: 1px solid black;
    } */
  </style>

</head>
<title>Edit STOCK-IN</title>

<body style="margin: 0px;" bgcolor="#B0C4DE">
  <div class="container">
    <a href="../main/stin_main.php" style="float: right;"><i class="fa fa-close" style="font-size:24px; color: red;"></i></a><br>
    <fieldset>
      <legend>&nbsp;&nbsp;&nbsp;Stock-Inventory IN: Editing Record&nbsp;&nbsp;&nbsp;</legend>
      <form autocomplete="off" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <table class="table1" width="100%">
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
            <td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </td>
            <td style="text-align: right;"><button class="button__add--item" title="Add Item" style="font-size: 18px; padding: 8px"><i class="fa fa-plus-circle"></i>&nbsp;Add Item</button></td>
          </tr>

        </table>

        <br>
        <table class="itemTb">
          <thead>
            <tr>
              <th style="text-align: left;" width="5%">Prod. ID</th>
              <th style="text-align: left;" width="20%">Item Description</th>
              <th style="text-align: left;" width="10%">On-Hand</th>
              <th style="text-align: left;" width="10%">Qty-In</th>
              <th style="text-align: left;" width="5%">Unit</th>
              <th style="text-align: left;" width="5%">Cost</th>
              <th style="text-align: left;" width="10%">Discount Amount</th>
              <th style="text-align: left;" width="10%">Incomming Qty</th>
              <th width="5%"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../php/config.php";
            $sql = "SELECT product.product_id, product.product_name,product.qty,stin_product.stin_temp_qty,
            unit_tb.unit_name,stin_product.stin_temp_cost,stin_product.stin_temp_disamount 
            FROM product 
            INNER JOIN stin_product ON stin_product.product_id=product.product_id 
            INNER JOIN stin_tb ON stin_product.stin_id=stin_tb.stin_id 
            INNER JOIN unit_tb ON product.unit_id = unit_tb.unit_id 
            WHERE stin_tb.stin_id='$id' 
            ORDER BY product.product_id DESC";

            $result = $db->query($sql);
            $count = 0;
            if ($result->num_rows >  0) {

              while ($irow = $result->fetch_assoc()) {
                $count = $count + 1;
                $total = $irow['qty'] + $irow['stin_temp_qty'];
            ?>

                <tr>

                  <td style="text-align: left;"><?php echo $irow['product_id'] ?><input type="hidden" name="productId[]" value="<?php echo $irow['product_id'] ?>" class="stin--product__id"></td>
                  <td style="text-align: left;"><?php echo $irow['product_name'] ?></td>
                  <td style="text-align: left;"><?php echo $irow['qty'] ?></td>
                  <td style="text-align: left;"><?php echo $irow['stin_temp_qty'] ?><input type="hidden" name="stinTempQty[]" value="<?php echo $irow['stin_temp_qty'] ?>" class='stin--qty__in'></td>
                  <td style="text-align: left;"><?php echo $irow['unit_name'] ?></td>
                  <td style="text-align: left;"><?php echo $irow['stin_temp_cost'] ?><input type="hidden" name="cost[]" value="<?php echo $irow['stin_temp_cost'] ?>" class='stin--cost'></td>
                  <td style="text-align: left;"><?php echo $irow['stin_temp_disamount'] ?><input type="hidden" name="discount[]" value="<?php echo $irow['stin_temp_disamount'] ?>" class='stin--discount'></td>
                  <td style="text-align: left;"><?php echo $irow['qty'] + $irow['stin_temp_qty'] ?><input type="hidden" name="incomingQty[]" value="<?php echo $irow['qty'] + $irow['stin_temp_qty'] ?>" class='stin--incoming__qty'></td>
                  <td>
                    <center>

                      &nbsp;
                      <a href="stin_item_delete.php?id=<?php echo $id; ?>" title="Remove">
                        <font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
                      </a>
                  </td>


                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
        <br>
        <button class="butLink" name="stin_submit" onclick="alert('Edit Records Successfully !')">Update</button>
      </form>
      <br>
    </fieldset>
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
      const changeValue = function(promptMessage) {
        newValue = prompt(promptMessage);
        target.closest('td').childNodes[0].textContent = newValue;
        target.value = newValue;
      }

      let newValue;

      if (!target) return;

      if (target.classList.contains('stin--qty__in')) {
        changeValue("Enter New Qty-In");
      }

      if (target.classList.contains('stin--cost')) {
        changeValue("Enter New Cost");
      }

      if (target.classList.contains('stin--discount')) {
        changeValue("Enter New Discount");
      }

    };

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
      <td>${selectedId}<input type="hidden" name="productId[]" value="${selectedId}" class='stin--product__id'></td>
      <td>${selectedName}</td>
      <td>${selectedQty}</td>
      <td>${qtyIn}<input type="hidden" name="stinTempQty[]" value="${qtyIn}" class='stin--qty__in'></td>
      <td>${selectedUnit}</td>
      <td>${selectedCost}<input type="hidden" name="cost[]" value="${selectedCost}" class='stin--cost'></td>
      <td>${selectedDiscount}<input type="hidden" name="discount[]" value="${selectedDiscount}" class='stin--discount'></td>
      <td>${incomingQty}<input type="hidden" name="incomintQty[]" value="${incomingQty}" class='stin--incoming__qty'></td>
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