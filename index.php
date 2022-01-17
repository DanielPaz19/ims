<?php include 'header.php';
if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
}

?>
<div class="navbar" <?php
                    if (!isset($_SESSION['user'])) {
                      echo "hidden";
                    }
                    ?>>
  <a href="index.php"><i class="fas fa-home"></i>&nbspHome</a>
  <a href="jo_main.php" title="Create New Job-Order"><i class="fas fa-clipboard-list"></i>&nbspJob-Order</a>
  <div class="dropdown">
    <button class="dropbtn"><i class="fas fa-box"></i>&nbspInventory
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="itemlist_main.php"><i class="fas fa-box"></i>&nbspItemList</a>
      <a href="stin_main.php"><i class="fas fa-arrow-circle-down"></i>&nbspStock-In</a>
      <a href="stout_main.php"><i class="fas fa-arrow-circle-up"></i>&nbspStock-Out</a>
      <a href="ep_main.php"><i class="fas fa-arrow-circle-up"></i>&nbspExit-Pass</a>
      <a href="po_main.php"><i class="fas fa-shopping-cart"></i>&nbspPurchase Order</a>
      <a href="pinv_main2.php">Physical Inventory</a>
      <a href="rt_main.php">Return Slip</a>
      <a href="ol_main.php">Online Transaction</a>

    </div>
  </div>


  <div class="dropdown">
    <button class="dropbtn"><i class="fas fa-tools"></i>&nbsp; Utilities&nbsp<i class="fa fa-caret-down"></i>
    </button>

    <div class="dropdown-content">
      <a href="sup_main.php"><i class="fas fa-people-arrows"></i>&nbspSupplier</a>
      <a href="#" onclick="showPayments()"><i class="fa fa-plus-circle"></i>&nbsp;Payment Type</a>
      <a href="#" onclick="showBank()"><i class="fa fa-plus-circle"></i>&nbsp;Bank</a>
      <a href="#" onclick="showCustomer()"><i class="fa fa-plus-circle"></i>&nbsp;Customer</a>
      <a href="#" onclick="showClass()"><i class="fa fa-plus-circle"></i>&nbsp;Class</a>
      <a href="#" onclick="showDept()"><i class="fa fa-plus-circle"></i>&nbsp;Department</a>
      <a href="#" onclick="showUnit()"><i class="fa fa-plus-circle"></i>&nbsp;Unit</a>
      <a href="#" onclick="showLocation()"><i class="fa fa-plus-circle"></i>&nbsp;Location</a>
      <a href="#" onclick="showEmployee()"><i class="fa fa-plus-circle"></i>&nbsp;Employee</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-file-text-o"></i>&nbsp;Reports&nbsp<i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">&nbsp;Inventory</a>
      <a href="pos_report.php">&nbsp;POS</a>
      <a href="#" onclick="showStinReport()">&nbsp;Stock-In </a>
      <a href="#">&nbsp;Stock-Out </a>
      <a href="#" onclick="showSrr()">&nbsp;Purchase Order</a>
    </div>
  </div>

  <div class="dropdown">
    <button class="dropbtn"><i class="fa fa-file-text-o"></i>&nbsp;Others&nbsp<i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="pivdr_main.php">&nbsp;PIVDR</a>
    </div>
  </div>

  <a href="php/logout-inc.php" style="float:right;" title="Sign-Out">Welcome &nbsp; <i class='fas fa-user-circle'></i>&nbsp;<?php echo $_SESSION["empName"]; ?></a>
</div>
<style>
  .item--details {
    width: 800px;
    height: 800px;
    background-color: white;
    margin-top: 20px;
    margin-left: 50px;
    overflow-y: scroll;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.5);
    float: right;
  }

  .item--details table {

    width: 100%;
    border: 1px solid black;
    border-collapse: collapse;
    border-style: dotted;

  }

  .item--details th {
    padding: 5px;
    width: 100%;
    border: 1px dotted black;
  }

  .item--details td {
    padding: 5px;
    border-right: 1px dotted black;
  }

  .item--details tr:hover {
    font-size: large;
    background-color: lightgray;
    cursor: pointer;
  }

  .item--details th:hover {
    font-size: larger;

  }

  blink {
    animation: blinker 5s linear infinite;

  }

  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }

  h2,
  h3 {
    letter-spacing: 5px;
  }


  .sales--details {
    width: 800px;
    height: 800px;
    background-color: white;
    margin-top: 20px;
    margin-left: 50px;
    overflow-y: scroll;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.5);
    float: left;
  }
</style>
<!-- <div class='container'>
  <center>
    <h2>Sales / Inventory Logs </h2>
  </center>

  <div class="sales--details">
    <center>
      <h3>
        <b style="color: red;">
          Pending Customer Payments
        </b>
      </h3>
    </center>

  </div>
</div> -->


<!-- <div class="item--details">
  <center>
    <h3>
      <b style="color: red;">
        <blink>Low Quantity Stock <i class="fa fa-warning"></i></blink>
      </b>
    </h3>
  </center>

  <table>
    <tr style="text-align: left;">
      <th style="width: 10%;">Product ID</th>
      <th style="width: 50%;">Description</th>
      <th style="width: 10%;">Quantity</th>
    </tr>
    <?php
    include "php/config.php";
    $sql = "SELECT * FROM product WHERE qty < 1 AND product_type_id = 1";

    $result = $db->query($sql);
    $count = 0;
    if ($result->num_rows >  0) {

      while ($irow = $result->fetch_assoc()) {

    ?>
        <tr>
          <td><?php echo str_pad($irow["product_id"], 8, 0, STR_PAD_LEFT) ?></td>
          <td><?php echo $irow['product_name'] ?></td>

          <td style="color: red; font-weight:bold"><?php
                                                    if ($irow['qty'] < 0) {
                                                      echo '<style="color:red; font-weight:bolder;">' . $irow['qty'];
                                                    } else {
                                                      echo $irow['qty'];
                                                    }
                                                    ?></td>
        </tr>
    <?php }
    } ?>
  </table>
</div> -->



<?php include_once 'footer.php'; ?>