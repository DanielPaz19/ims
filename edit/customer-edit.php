<?php

include('../php/config.php');

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$customers_name=mysqli_real_escape_string($db, $_POST['customers_name']);
$customers_company=mysqli_real_escape_string($db, $_POST['customers_company']);
$customers_address=mysqli_real_escape_string($db, $_POST['customers_address']);
$customers_contact=mysqli_real_escape_string($db, $_POST['customers_contact']);
$customers_note=mysqli_real_escape_string($db, $_POST['customers_note']);
$customers_tin=mysqli_real_escape_string($db, $_POST['customers_tin']);
$tax_type_id=mysqli_real_escape_string($db, $_POST['tax_type_id']);


mysqli_query($db,"UPDATE customers 
                  SET customers_name='$customers_name', customers_company='$customers_company', customers_address='$customers_address', customers_contact='$customers_contact', customers_note='$customers_note', customers_tin='$customers_tin', tax_type_id='$tax_type_id'  
                  WHERE customers_id='$id'");

echo "<script>
alert('Successfully updated!');
location.href = '../utilities/bo_customer.php';
</script>";
// header("Location:../utilities/bo_customer.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT customers.customers_id, customers.customers_name,customers.customers_company,customers.customers_address,customers.customers_contact,customers.customers_note,customers.customers_tin,tax_type_tb.tax_type_id,tax_type_tb.tax_type_name
FROM customers
LEFT JOIN tax_type_tb ON tax_type_tb.tax_type_id = customers.tax_type_id
WHERE customers.customers_id=".$_GET['id']);

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['customers_id'];
$customers_name = $row['customers_name'];
$customers_company = $row['customers_company'];
$customers_address = $row['customers_address'];
$customers_contact = $row['customers_contact'];
$customers_note = $row['customers_note'];
$customers_tin = $row['customers_tin'];
$taxTypeName = $row['tax_type_name'];
$taxTypeId = $row['tax_type_id'];




}
else
{
echo "No results!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <link rel="stylesheet" href="../source/css/bootstrap.min.css">
  <script src="../source/js/bootstrap.min.js"></script>
  <link rel="shortcut icon" href="../img/pacclogo.png" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <title>Customer Editing Details</title>
</head>
<body style="background-color:lightgrey;">
  <div class="container">
    <br />
      <div class="card"> 
        <h3 class="card-header" style="color:#0d6efd"> Customer Editing Records <i class="bi bi-pencil"></i></h3>
          <div class="card-body">
          <form action="" method="post" action="">
                  <input type="hidden" name="id" value="<?php echo $id; ?>"/>
              <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" id="email" name="customers_company" value="<?php echo $customers_company; ?>">
                  <label for="email">Company</label>
              </div>
                <div class="form-floating mb-3 mt-3">
                  <input type="text" class="form-control" id="email" name="customers_name" value="<?php echo $customers_name; ?>">
                    <label for="email">Contact Person</label>
                </div>
                <div class="form-floating">
                <textarea class="form-control" id="comment" name="customers_address"><?php echo $customers_address; ?></textarea>
                <label for="comment">Address</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                  <input type="text" class="form-control" id="email" name="customers_contact" value="<?php echo $customers_contact; ?>">
                    <label for="email">Contact No.</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                  <input type="text" class="form-control" id="email" name="customers_note" value="<?php echo $customers_note; ?>">
                    <label for="email">Note</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                  <input type="text" class="form-control" id="email" name="customers_tin" value="<?php echo $customers_tin; ?>">
                    <label for="email">TIN No.</label>
                </div>
                <div class="form-floating">
                  <select class="form-select" id="sel1" name="tax_type_id">
                    <option value="<?php echo $taxTypeId ?>"><?php echo $taxTypeName; ?></option>
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
<br>
                <button class="btn btn-success" type="submit" name="submit" style="width: 20%;">Update</button>&emsp;
               
              </form>
             
          </div>
        
      </div>
  </div>

</body>
</html>