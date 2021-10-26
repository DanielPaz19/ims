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
  <style>
    body {
      background: rgb(204, 204, 204);
    }

    page {
      background: white;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
      color: black;
      font-family: sans-serif;
    }

    page[size="A4"] {
      width: 21cm;
      height: 29.7cm;
    }

    @media print {
      #printPageButton {
        display: none;
        font-family: sans-serif;
      }

    }

    .suptab {
      line-height: 30px;
    }
  </style>
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
<button id="printPageButton" onClick="printDiv();">Print</button>

<body>
  <div>
  </div>
  <div id="print-area">
    <page id="print" size="A4">
      <fieldset style="border:none;">
        <div class="top">
          <center>

            <table style="border: 1px solid black;" width="100%">
              <tr>
                <td>
                  <font color="midnightblue"><img src="../img/pacclogo.png" height="50px" width="50px" style="float:left">
                </td>
                <td>
                  <font color="midnightblue" style="font-size: 25px; letter-spacing: 2px;">PHILIPPINE ACRYLIC & CHEMICAL CORPORATION</font><br>
                  <center>635 Mercedes Ave. San Miguel, Pasig City
                  </center>
                </td>
              </tr>
            </table>
          </center>

          <b>
            <font color="midnightblue">Contact No. :</font>
          </b><input type="text" style="border: none; width: 80px;" value="7894-5612">,<input type="text" style="border: none; width: 80px;" value="3216-5478">,<input type="text" style="border: none; width: 100px;" value="+6391234287"><br>
          <b>
            <font color="midnightblue">Contact Person:</font>
          </b> <input type="text" style="border: none; width: 150px;" value="Ms. Jan Ciria Cruz">
        </div>
      </fieldset>
      <br>

      <fieldset>
        <legend>Supplier Details</legend>
        <div class="suptab">
          <b>
            <font color="midnightblue">Supplier :</font>
          </b> <?php echo $sup_name; ?> &nbsp&nbsp<br>
          <b>
            <font color="midnightblue">Address :</font>
          </b> <?php echo $sup_address; ?> &nbsp&nbsp
          <b>
            <font color="midnightblue">Contact:</font>
          </b> <?php echo $sup_tel; ?>&nbsp&nbsp<br>
          <b>
            <font color="midnightblue">Terms :</font>
          </b><input type="text" style="border: none; width: 120px;" value="<?php echo $po_terms; ?>"><br>
          <b>
            <font color="midnightblue">Tin :</font>
          </b><?php echo $sup_tin; ?>&nbsp&nbsp︳
          <b>
            <font color="midnightblue">Remarks :</font>
          </b> <?php echo $po_remarks; ?> &nbsp&nbsp︳
          <b>
            <font color="midnightblue">Date :</font>
          </b> <?php echo $po_date; ?>
        </div>
      </fieldset>
    </page>
  </div>
</body>


</html>