
<?php

include "../../php/config.php"; // Using database connection file here

$id = $_GET['id'];
$proId = $_GET['prodId'];
$tot = $_GET['Tot'];
 // get id through query string

$qry = mysqli_query($db,"SELECT * FROM po_product WHERE product_id='$proId' AND po_id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $prodId = $_POST['product_id'];
    $qty = $_POST['item_qtyorder'];
    $cost = $_POST['item_cost'];
    $disamount = $_POST['item_disamount'];
    $total = $_POST['po_temp_tot'];

    $edit = mysqli_query($db,"UPDATE po_product SET  item_qtyorder='$qty', item_cost='$cost', item_disamount='$disamount',po_temp_tot='$total' WHERE product_id='$proId' AND po_id='$id'");
  
    if($edit)
    {
        mysqli_close($db); // Close connection
        

    }
    else
    {
        echo mysqli_error();
    }
    header("location:../po_edit.php?id=$id");
        exit;     
}
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
.con-form{
font-family: Arial, Helvetica, sans-serif;
border: 1px;
color: midnightblue;
}
.butLink {

  background-color: #6495ed;
  border-radius: 4px;
  color: white;
  padding: 7px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.center {
  margin: auto;
  margin-top: 50px;
  width: 90%;
  padding: 30px;
  border-radius: 5px;
}
</style>


<div class = "con-form">
<div class="center">
<fieldset>
<legend><b>Item Edit</b></legend>
<form method="POST" >
  <input type="hidden" name="product_id[]" value="<?php echo $proId; ?>"/>
  <input type="hidden" name="po_temp_tot" value="<?php echo $tot; ?>"/>
<table>
<tr>

<td width="5%"><b><font color='midnightblue'>Qty-In<em>*</em></font></b></td>
<td><label>
<input type="text" class="form-control" name="item_qtyorder" value="<?php echo $data['item_qtyorder'] ;?>" />
</label></td>
<td>&nbsp</td>
</tr>

<tr>
<td width="5%"><b><font color='midnightblue'>Cost<em>*</em></font></b></td>
<td><label>
<input type="number" class="form-control" name="item_cost" value="<?php echo $data['item_cost'] ;?>">
</label></td>
</tr>

<tr>
<td width="5%"><b><font color='midnightblue'>Discount Amount<em>*</em></font></b></td>
<td><label>
<input type="number" class="form-control" name="item_disamount" value="<?php echo $data['item_disamount'] ;?>">
</label></td>
</tr>


</table>
<br><br>
  <input type="submit" name="update" value="Update" class="butLink" onclick="myFunction()">

  <button type="button" class="butLink" onclick="javascript:history.go(-1)">Back</button>
</form>

</fieldset>
</div>
</div>

<script>
function myFunction() {
  alert("Edit Item Successfully !! \n\n Press Back Button.");
}
</script>


