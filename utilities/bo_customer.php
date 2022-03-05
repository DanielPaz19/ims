
<?php
// connect to the database
include "../php/config.php";
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


// Add item
if (isset($_GET['addcus'])) {
  // receive all input values from the form
  echo "connect";
  $customers_company=mysqli_real_escape_string($db, $_GET['customers_company']);
  $customers_name=mysqli_real_escape_string($db, $_GET['customers_name']);
  $customers_address=mysqli_real_escape_string($db, $_GET['customers_address']);
  $customers_contact=mysqli_real_escape_string($db, $_GET['customers_contact']);
  $customers_note=mysqli_real_escape_string($db, $_GET['customers_note']);
  $customers_tin=mysqli_real_escape_string($db, $_GET['customers_tin']);
  $tax_type_id=mysqli_real_escape_string($db, $_GET['tax_type_id']);


    $query = "INSERT INTO customers (customers_company,customers_name,customers_address,customers_contact,customers_note,customers_tin,tax_type_id) 
  			  VALUES('$customers_company','$customers_name','$customers_address','$customers_contact','$customers_note','$customers_tin','$tax_type_id')";

      if(mysqli_query($db, $query))
      {

      echo "<script>
      alert('Record Created Successfully!');
      location.href = 'bo_customer.php';
      </script>";
				
    }
    else{
        echo"<script>alert('Failed to create record !');</script>";
    }
  	
  
  
}
?>
<?php include ('../table/customer_table.html')?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> <i class="bi bi-person-plus"></i> Create New Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="GET">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingInput" placeholder="Company Name" name="customers_company">
            <label for="floatingInput">Company Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Contact Person" name="customers_name">
          <label for="floatingInput">Contact Person</label>
        </div>
        <br>
        <div class="form-floating">
          <textarea class="form-control" placeholder="Company Address" id="floatingTextarea" name="customers_address"></textarea>
            <label for="floatingTextarea">Company Address</label>
        </div><br>

        <div class="form-floating">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Contact Info" name="customers_contact">
            <label for="floatingPassword">Contact Info</label>
            <br>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingPassword" placeholder="Tin No."  name="customers_tin">
            <label for="floatingPassword">TIN No.</label>
        </div>
        <br>
        <div class="form-floating">
                  <select class="form-select" id="sel1" name="tax_type_id">
                      <?php
                      include "../php/config.php";
                      $records = mysqli_query($db, "SELECT * FROM tax_type_tb");

                      while ($data = mysqli_fetch_array($records)) {
                          echo "<option value='" . $data['tax_type_id'] . "'>" . $data['tax_type_name'] . "</option>";
                      }
                      ?>
                 </select>
                    <label for="sel1" class="form-label">Tax Type</label>
                </div>
      </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" style="width: 30%;" name="addcus">Save Record</button>
        </form>
      </div>
    </div>
  </div>
</div>