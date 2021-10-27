<?php

include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];

  $result = mysqli_query($db, "SELECT po_tb.po_code, po_tb.po_title, po_tb.po_date, po_tb.po_remarks, po_tb.po_terms, sup_tb.sup_id, po_tb.po_id, sup_tb.sup_name, sup_tb.sup_address,sup_tb.sup_tel, sup_tb.sup_tin FROM sup_tb INNER JOIN po_tb ON sup_tb.sup_id = po_tb.sup_id  WHERE po_id=" . $_GET['id']);


  $row = mysqli_fetch_array($result);

  if ($row) {
    $id = $row['po_id'];
    $po_code = $row['po_code'];
    $po_date = $row['po_date'];
    $po_title = $row['po_title'];
    $po_remarks = $row['po_remarks'];
    $po_terms = $row['po_terms'];
    $sup_name = $row['sup_name'];
    $sup_address = $row['sup_address'];
    $sup_tel = $row['sup_tel'];
    $sup_tin = $row['sup_tin'];
  } else {
    echo "No results!";
  }
}
?>
<html>
<title><?php echo $po_code; ?></title>

<head>
  <link rel="stylesheet" href="../../css/viewpo.css" type="text/css" media="print">
  <link rel="stylesheet" href="../../css/viewpo.css" type="text/css">
</head>
<script>
  function printDiv() {
    var divContents = document.getElementById("print-area").innerHTML;
    var a = window.open('', '', 'height=1000, width=1300');
    a.document.write(divContents);
    a.document.close();
    a.print();
  }
</script>

<body>
  <div class="print-area">
    <page id="print" size="A4">
      <div class="top">
        <table width="100%">
          <tr>
            <td>
              <font color="midnightblue"><img src="../img/pacclogo.png" height="65px" width="65px" style="float:left">
            </td>
            <td style="text-align: center;">
              <font style="font-size: 25px; letter-spacing: 4px;">Philippine Acrylic & Chemical Corporation</font><br>
              <center>
                <font style="font-size: 20px; letter-spacing: 3px;"> 635 Mercedes Ave. San Miguel, Pasig City</font><br>
                <font style="font-size: 15px; letter-spacing: 3px;">Tel. Nos.<input type="text" style="border: none; width: 80px;" value="7894-5612">&nbsp;<input type="text" style="border: none; width: 80px;" value="3216-5478">&nbsp;<input type="text" style="border: none; width: 100px;" value="+6391234287"></font>
              </center>
            </td>
          </tr>
        </table>
        <hr>
        </center>
      </div>


      <div class="suptab">
        <table width="100%">
          <tr>
            <td>
              <h4 style="text-align: left; margin-right:20px;"><label>Puchase Order :</label> <?php echo $po_title; ?></h4>
            </td>
            <td>
              <h4 style="text-align: right; margin-right:20px;">Date: <?php echo $po_date; ?></h4>
            </td>
          </tr>
        </table>




        <fieldset>
          <legend style="letter-spacing: 3px; font-weight: bolder;">&nbsp;Supplier Information &nbsp;&nbsp;&nbsp;</legend>
          <table width="100%">
            <tr>
              <td style="font-size: 11px; "><label> Name :</label>
                <?php echo $sup_name; ?>
              </td>
            </tr>
            <tr>
              <td style="font-size: 11px; "><label> Addres :</label><?php echo $sup_address; ?></td>
              <td style="font-size: 11px; "><label> Contact :</label> <?php echo $sup_tel; ?></td>
            </tr>
            <tr>
              <td style="font-size: 11px; "><label>TIN :</label><?php echo $sup_tin; ?></td>
              <td style="font-size: 11px; "><label>Terms :</label><?php echo $po_terms; ?></td>
            </tr>
          </table>
        </fieldset>
      </div>
      <div class="itemTB">
        <table class="ordertable">
          <tr>
            <th width="40%">Product Name</th>
            <th width="10%">Qty Order</th>
            <th width="5%">Unit</th>
            <th width="10%">Cost</th>
            <th width="10%">Total Cost</th>
            <th width="10%">Discount</th>
            <th width="10%">Total Amount</th>
          </tr>
          <?php
          $sql = "SELECT product.product_name, po_product.item_qtyorder, unit_tb.unit_name, product.cost, po_product.item_disamount 
                                  FROM product
                                  INNER JOIN po_product
                                  ON product.product_id = po_product.product_id
                                  INNER JOIN unit_tb
                                  ON product.unit_id = unit_tb.unit_id
                                  WHERE po_product.po_id = '$id' ";

          $result = $db->query($sql);
          $count = 0;
          if ($result->num_rows >  0) {
            while ($irow = $result->fetch_assoc()) {
              $count = $count + 1;

              $total[] = $irow["item_qtyorder"] * $irow["cost"];

              $totaldisamount[] =  $irow["item_disamount"];

          ?>
              <tr>
                <td contenteditable="false"><?php echo $irow['product_name'] ?></td>
                <td contenteditable="false"><?php echo $irow['item_qtyorder'] ?></td>
                <td contenteditable="true"><?php echo $irow['unit_name'] ?></td>
                <td contenteditable="true"><?php echo $irow['cost'] ?></td>
                <td class="item_totcost"><?php echo $irow["item_qtyorder"] * $irow["cost"]; ?></td>
                <td contenteditable="true"><?php echo $irow['item_disamount'] ?></td>
                <td class="po_temp_tot"><?php echo $irow["item_qtyorder"] * $irow["cost"] - $irow["item_disamount"]; ?></td>
              </tr>
              <input type="hidden" name="product_id[]" value="<?php echo $irow['product_id'] ?>">
          <?php }
          } ?>
        </table><br>
        <div class="subtot">
          <table>
            <?php

            $limit = 0;
            $subTot = 0;
            $disTot = 0;

            while ($limit != count($total)) {
              $subTot += $total[$limit];
              $disTot += $totaldisamount[$limit];
              $limit += 1;
            }

            $grandTot = $subTot - $disTot;

            ?>
            <tr>
              <td><label for=""> Sub Total:</label>&nbsp;<?php echo $subTot; ?></td>
            </tr>
            <tr>
              <td><label for=""> Shipping:</label>&nbsp;0</td>
            </tr>
            <tr>
              <td><label for=""> Total Discount:</label>&nbsp;<?php echo $disTot ?></td>
            </tr>
            <tr>
              <td><label for=""> Total Amount:</label>&nbsp;<?php echo $grandTot ?></td>
            </tr>
          </table>
        </div>
      </div>
      <table>
        <tr>
          <td>Prepared By:__________</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Check By:__________</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Approve By:__________</td>
        </tr>
      </table>
    </page>
  </div>
</body>


</html>