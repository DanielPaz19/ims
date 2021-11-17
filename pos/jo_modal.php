<?php include_once 'php/jo_modal-inc.php' ?>

<link rel="stylesheet" href="styles/jo_modal-style.css">
<script defer src="js/jo_modal-script.js"></script>

<div class="jo__modal jo__modal--active">
  <div class="jo__modal--content">
    <span class="jo__modal--close"><i class="fa fa-close"></i></span>
    <h1 class="jo__modal--heading">Job Order List</h1>
    <label for="" class="jo__modal--label">Enter JO Number :</label>
    <input type="text" placeholder="12-34567" class="jo__modal--input jo__modal--input__search">
    <div class="jo__modal--table__container">
      <table class="jo__modal--table">
        <thead>
          <tr>
            <th>JO No.</th>
            <th>Customer</th>
            <th>Price</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $jolimit = 0;

          while (count($joId) !== $jolimit) {
            echo
            "<tr>
            <td class='jo__modal--td__jonumber'>" . $joNum[$jolimit] . "</td>
            <td>" . $joCustomerName[$jolimit] . "</td>
            <td>999,999.99</td>
            <td>" . $joDate[$jolimit] . "</td>
          </tr>";

            $jolimit++;
          }

          ?>
          <!-- <tr>
            <td>12-23456</td>
            <td>Philippine Acrylic and Chemical Corp.</td>
            <td>999,999.99</td>
            <td>01-01-2021</td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
</div>