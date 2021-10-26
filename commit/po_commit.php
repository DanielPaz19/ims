<?php
include('../php/config.php');
if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];

$result = mysqli_query($db,"SELECT po_tb.po_code, po_tb.po_title, po_tb.po_date, po_tb.po_remarks, sup_tb.sup_id, po_tb.po_id, sup_tb.sup_name, sup_tb.sup_address, po_tb.po_terms, sup_tb.sup_tin FROM sup_tb INNER JOIN po_tb ON sup_tb.sup_id = po_tb.sup_id  WHERE po_id=".$_GET['id']);


$row = mysqli_fetch_array($result);

if($row)
{
$id = $row['po_id'];
$po_code = $row['po_code'];
$po_date = $row['po_date'];
$po_title = $row['po_title'];
$po_remarks = $row['po_remarks'];
$sup_name = $row['sup_name'];
$sup_address = $row['sup_address'];
$sup_tin = $row['sup_tin'];
$po_terms = $row['po_terms'];
}
else
{
echo "No results!";
}



}


?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  color: black;
  padding: 50px;
}

.item-details {
border-collapse: collapse;
box-shadow:  0 0 1px  rgba(0,0,0,0.2);
-moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
-webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
-o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
}

.item-details td{
  padding: 7px;
  border: 1px solid grey;
  text-align: left;
  font-size: 15px;
  background-color: white;

}
.item-details th{
background-color: midnightblue;
color: white;
padding: 5px;
border: 1px solid grey;
text-align: left;
font-size: 15px;
}

.fieldset {
  border: none;
}

h2 {
  color: midnightblue;
  letter-spacing: 4px;
  text-decoration: underline;
}


.button {
  background-color: midnightblue; /* Green */
  border: none;
  color: white;
  padding: 7px 16px;
  text-align: center;
  letter-spacing: 2px;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}

.button:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}

.head {
  color: midnightblue;
}

.stock-details td {
  padding: 15px;

}

.container {
  padding: 30px;
  background-color:#EAEAEA;
  box-shadow:  0 0 10px  rgba(0,0,0,0.6);
  -moz-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
  -webkit-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
  -o-box-shadow: 0 0 10px  rgba(0,0,0,0.6);
  height: 1000px;
}

input[type=number]{
    color: red;
    font-weight: bolder;
}


</style>
</head>



<!-- VIEW PO END -->
<input type="hidden" name="id" value="<?php echo $id; ?>"/>
<body style="margin: 0px;" bgcolor="#B0C4DE">
  <!-- PO Details -->
<div class="container">
  <a href="../main/po_main.php" style="float: right; color: red;" title="Close"><i class="fa fa-close" style="font-size:24px"></i></a>
<fieldset style="border:none;">
  <legend><h2>PO-DETAILS</h2></legend>
    <table class="stock-details" width="100%">
        <tr>
          <td class="head"><b>PO Code</b> <?php echo $po_code; ?>  </td>
          <td class="head"><b>Supplier</b> <?php echo $sup_name; ?> </td>
          <td class="head"><b>Remarks </b><?php echo $po_remarks; ?></td>
          <td class="head"><b>PO Title </b><?php echo $po_title; ?></td>
          <td class="head"><b>Address </b><?php echo $sup_address; ?></td>
          <td class="head"><b>PO Date </b><?php echo $po_date; ?></td>
          <td class="head"><b>TIN </b><?php echo $sup_tin; ?></td>
          <td></td>
        </tr>
    </table>



<br>

<!-- Items Details -->
    <form method="GET" action="../commit/que/po_commit_que.php">
      <input type="hidden" name= "po_id" value ="<?php echo $_GET['id']?>">
      <input type="hidden" name='mov_date' class='date'>
          <table class="item-details" >
                <tr>
                    <th width="30%">Item Name</th>
                    <th width="10%">Beg. Qty</th>
                    <th width="10%">Qty-Recieved</th>
                    <th width="10%">Qty-Order</th>
                    <th width="3%">Unit</th>
                    <th width="10%">Cost</th>
                    <th width="10%">Total Cost</th>
                    <th width="10%">Discount Amount</th>
                    <th width ="10%">Incomming-Qty</th>
                </tr>
                        <?php 
                           $sql = "SELECT po_product.po_id, product.product_id ,product.product_name, product.qty, po_product.item_qtyorder, unit_tb.unit_name, product.cost, po_product.item_disamount 
                                  FROM product
                                  INNER JOIN po_product
                                  ON product.product_id = po_product.product_id
                                  INNER JOIN unit_tb
                                  ON product.unit_id = unit_tb.unit_id
                                  WHERE po_product.po_id = '$id' ";

                              $result = $db->query($sql);
                                            $count=0;
                                       if ($result -> num_rows >  0) {
                                          
                                         while ($irow = $result->fetch_assoc()) 
                                         {
                                              $count=$count+1;
                        ?>
                <tr>
                    
                    
                    <td contenteditable="false"><?php echo $irow['product_name']?></td>
                    <td><input type="number" name="bal_qty[]" value="<?php echo $irow['qty']?>"  style="border: none;" readonly></td>
                    <td contenteditable="false"><input style="border:none;" type="number" name="in_qty[]" value="<?php echo $irow['item_qtyorder']?>" readonly></td>
                    <td contenteditable="true"><?php echo $irow['item_qtyorder']?></td>
                    <td contenteditable="true"><?php echo $irow['unit_name']?></td>
                    <td contenteditable="true"><?php echo $irow['cost']?></td>
                    <td class="item_totcost"><input type="number" name="item_totcost[]" style="border: none;" value ="<?php echo $irow["item_qtyorder"]* $irow["cost"] ;?>" contenteditable="false"></td>
                    <td contenteditable="true"><?php echo $irow['item_disamount']?></td>
                    <td class="po_temp_tot"><input type="number" name="po_temp_tot[]"  style="border: none;"value = "<?php echo $irow["qty"]+ $irow["item_qtyorder"] ;?>" contenteditable="false"></td>
                </tr>
                    <input type="hidden" name= "product_id[]" value ="<?php echo $irow['product_id']?>">
                        <?php }}?> 

          </table>
<br>
                    <input type="submit" name="submit" value="Commit" class="button" onclick="confirmUpdate()">
  </form>
                   

<script type="text/javascript">
  function PrintPage() {
    window.print();
  }

  function HideBorder(id)
{
   var myInput = document.getElementById(id).style;
   myInput.borderStyle="none";
}
</script>
<script>

    //date
    document.querySelector('.date').value = new Date().toISOString();

      function confirmUpdate() {
        let confirmUpdate = confirm("Are you sure you want to Commit record?\n \nNote: Double Check Input Records");
        if (confirmUpdate) {
          alert("Update Record Database Successfully!");
        } else {
          
          alert("Action Canceled");
        }
      }
    </script>

    <script>
      function confirmCancel() {
        let confirmUpdate = confirm("Are you sure you want to cancel ?");
        if (confirmUpdate) {
          alert("Nothing Changes");
        } else {
          
          alert("Action Canceled");
        }
      }
    </script>
</html>
