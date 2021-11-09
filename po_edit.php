<?php include_once 'header.php';


if (isset($_GET['id'])) {

  $poId = $_GET['id'];



  require_once 'php/config.php';

  $result = mysqli_query(
    $db,
    "SELECT po_tb.po_id, po_tb.po_terms, po_tb.po_remarks, po_tb.po_code,
  po_tb.po_date, po_tb.po_title, po_product.item_qtyorder, po_product.item_cost, 
  po_product.item_disamount, po_product.po_temp_tot, product.product_name, product.product_name,
  product.class_id, product.unit_id, product.product_id, sup_tb.sup_name
 FROM po_tb  
 LEFT JOIN po_product ON po_product.po_id = po_tb.po_id
 LEFT JOIN product ON po_product.product_id = product.product_id
 LEFT JOIN sup_tb ON sup_tb.sup_id = po_tb.sup_id
 WHERE po_tb.po_id ='$poId'"
  );

  // PO Details
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
      $supName = $row['sup_name'];
      $poTerms = $row['po_terms'];
      $poRemarks = $row['po_remarks'];
      $poDate = $row['po_date'];
      $poCode = $row['po_code'];
      $poTitle = $row['po_title'];
    }
  } else {
    echo "0 results";
  }


  // PO Tables
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
    }
  } else {
    echo "0 results";
  }
}


?>


<link rel="stylesheet" href="css/po_edit-style.css">
<script defer src="js/po_edit-script.js"></script>

<h1>Edit Purchase Order</h1>
<div class='container--po__details'>
  <span class="po__label">
    PO ID:
  </span>
  <input type="text" name="poId" id="po_id" value="<?php echo $poId ?>" disabled>
  <span class="po__label">
    Supplier Name:
  </span>
  <input type="text" name="supplierName" id="supplier_name" value="<?php echo $supName ?>">
  <span class="po__label">
    PO Title:
  </span>
  <input type="text" name="poTitle" id="po_title" value="<?php echo $poTerms ?>"><br>
  <span class="po__label">
    Terms:
  </span>
  <input type="text" name="poTerms" id="po_terms" value="<?php echo $poTerms ?>">
  <span class="po__label">
    Remarks:
  </span>
  <input type="text" name="poRemarks" id="po_remarks" value="<?php echo $poRemarks ?>">
  <span class="po__label">
    PO Date:
  </span>
  <input type="text" name="poDate" id="po_date" value="<?php echo $poDate ?>">

  <button class="po__button button--add__item">Add item</button>
</div>

<div class="container--po__table">
  <table class='po__table'>
    <thead>
      <tr>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Qty-In</th>
        <th>Unit</th>
        <th>Cost</th>
        <th>Total Cost</th>
        <th>%Discount</th>
        <th>Discount Value</th>
        <th>Sub-total</th>
        <th>
        </th>
      </tr>
    </thead>
    <tbody class='po__table--item'>
      <tr>
        <td>00000001</td>
        <td>Acry table shield</td>
        <td>5.00</td>
        <td>pcs</td>
        <td>100.00</td>
        <td>500.00</td>
        <td>50.00</td>
        <td>250.00</td>
        <td>250.00</td>
        <td>
          <font color="red"><i class="fa fa-trash-o" style="font-size:26px"></i></font>
        </td>
      <tr>
        <td>00000001</td>
        <td>Acry table shield</td>
        <td>5.00</td>
        <td>pcs</td>
        <td>100.00</td>
        <td>500.00</td>
        <td>50.00</td>
        <td>250.00</td>
        <td>250.00</td>
        <td>
          <font color="red"><i class="fa fa-trash-o" style="font-size:26px"></i></font>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="container--po__button">
  <button class="po__button button--po__update">Update</button>
  <button class="po__button button--po__cancel">Cancel</button>
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

<?php include_once 'footer.php' ?>