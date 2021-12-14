<?php
include_once 'header.php';

if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
}
?>
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
    animation: blinker 0.5s linear infinite;

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
<div class='container'>
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
    <!-- <table>
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
    </table> -->
  </div>
</div>


<div class="item--details">
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
</div>

</div>

<?php include_once 'footer.php'; ?>