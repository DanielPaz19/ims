<!DOCTYPE html>
<html>

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <!-- <link rel="stylesheet" href="css/tablepage.css"> -->
  <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
</head>

<div style="padding:2%">
  <div class="shadow-lg p-5 mb-5 bg-rounded" style="background-color: white;border: 5px solid #cce0ff">
    <h3 style="color: #0d6efd;"><i class="bi bi-boxes"></i> Itemlist</h3>
    <hr>
    <br>
    <div class="row">
      <div class="col">
        <button class="btn btn-primary" title="Create New Item" id="myBtn"><i class="bi bi-plus-circle"></i>
          New Product</button>
      </div>
      <div class="col">
        <div class="input-group mb-3">
          <span class="input-group-text" style="background-color: whitesmoke;"><i class="bi bi-search"></i></span>
          <input type="text" class="form-control" name="search_box" id="search_box" placeholder="Search anything here..">
        </div>
      </div>
    </div>

    <div class="table-responsive" id="dynamic_content">

    </div>
  </div>
</div>

</html>
<script>
  $(document).ready(function() {

    load_data(1);

    function load_data(page, query = '') {
      $.ajax({
        url: "fetch/itemlist_fetch.php",
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