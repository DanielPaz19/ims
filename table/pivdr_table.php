<!DOCTYPE html>
<html>

<head>


</head>

<body>
  <br />
  <div class="container">

    <br />
    <div class="card">

      <div class="card-body">
        <div class="form-group" style="align-content: right;">
          <button class="butLink" title="Create New Item" onclick="showadditem()"><i class="fas fa-plus"></i>&nbspNew</button>
          <a href="pivdr_main.php"><button style="float: right; height: 40px; background-color: midnightblue;"><i class="fa fa-refresh fa-spin" style="font-size:16px; color:white" title="Refresh"></i></button></a>
          <!-- <input type="text" name="search_box" id="search" style="width: 500px; height: 40px; float: right;" placeholder=" &#x1F50E;&nbsp;Search ....."> -->
          <input type="search" placeholder=" &#x1F50E;&nbsp;Search ....." class="form-control search-input" data-table="customers-list" style="width: 500px; height: 40px; float: right;" />
        </div>
        <br>
        <table width="100%" class="table table-striped mt32 customers-list">
          <thead>
            <tr>
              <th style="width: 10%;">PIVDR ID</th>
              <th style="width: 25%;">Customer</th>
              <th style="width: 10%;">DR No.</th>
              <th style="width: 10%;">SI No.</th>
              <th style="width: 10%;">OR No.</th>
              <th style="width: 25%;">Remarks</th>
              <th style="width: 10%;">Date</th>
            </tr>
          </thead>
          <tbody>
            <?php

            include "php/config.php";

            $sql = "SELECT customers.customers_id,customers.customers_name, pinvdr_tb.pinvdr_drNo, pinvdr_tb.pinvdr_id,pinvdr_tb.pinvdr_siNo,pinvdr_tb.pinvdr_orNo,pinvdr_tb.pinvdr_remarks,pinvdr_tb.pinvdr_date
          FROM pinvdr_tb
          LEFT JOIN customers ON customers.customers_id = pinvdr_tb.customers_id";

            $result = $db->query($sql);
            $count = 0;

            if ($result->num_rows >  0) {

              while ($irow = $result->fetch_assoc()) {
                $dateString = $irow['pinvdr_date'];
                $dateTimeObj = date_create($dateString);
                $date = date_format($dateTimeObj, 'm/d/y');
                $count = $count + 1;

            ?>
                <tr>
                  <td>
                    <?php echo str_pad($irow["pinvdr_id"], 8, 0, STR_PAD_LEFT) ?>
                  </td>
                  <td><?php echo $irow['customers_name'] ?></td>
                  <td><?php echo $irow['pinvdr_drNo'] ?></td>
                  <td><?php echo $irow['pinvdr_siNo'] ?></td>
                  <td><?php echo $irow['pinvdr_orNo'] ?></td>
                  <td><?php echo $irow['pinvdr_remarks'] ?></td>
                  <td><?php echo $date ?></td>
                </tr>
          </tbody>
      <?php }
            } ?>

        </table>

      </div>
    </div>
  </div>
</body>

</html>
<script>
  (function(document) {
    'use strict';

    var TableFilter = (function(myArray) {
      var search_input;

      function _onInputSearch(e) {
        search_input = e.target;
        var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
        myArray.forEach.call(tables, function(table) {
          myArray.forEach.call(table.tBodies, function(tbody) {
            myArray.forEach.call(tbody.rows, function(row) {
              var text_content = row.textContent.toLowerCase();
              var search_val = search_input.value.toLowerCase();
              row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
            });
          });
        });
      }

      return {
        init: function() {
          var inputs = document.getElementsByClassName('search-input');
          myArray.forEach.call(inputs, function(input) {
            input.oninput = _onInputSearch;
          });
        }
      };
    })(Array.prototype);

    document.addEventListener('readystatechange', function() {
      if (document.readyState === 'complete') {
        TableFilter.init();
      }
    });

  })(document);
</script>
<script>
  $(document).ready(function() {

    load_data(1);

    function load_data(page, query = '') {
      $.ajax({
        url: "fetch/pivdr_fetch.php",
        method: "POST",
        data: {
          page: page,
          query: query
        },
        success: function(data) {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function() {
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function() {
      var query = $('#search_box').val();
      load_data(1, query);
    });

  });
</script>