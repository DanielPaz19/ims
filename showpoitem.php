
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/div.css">
<link rel="stylesheet" href="css/table.css">
<style>
.butLink {

  background-color: #6495ed;
  border-radius: 4px;
  color: white;
  padding: 7px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
</style>

<!--SHOW THE ITEMLIST WHEN ADD ITEM CLICK-->

<div class="form-popup" id="myItemList">
      <h2><font color="midnightblue">ItemList</font></h2>
    <th><input type="text" id="myInput" size="50" onkeyup="mySearch()" placeholder="🔎 Search anything here......" > </th> 
<form method="POST">
        <table id="items">   
                      <thead>
                           <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Name</th>
                              <th scope="col">Class</th>
                              <th scope="col">Qty</th>
                              <th scope="col">Unit</th>
                              <th scope="col">Location</th>                     
                              <th scope="col">Cost</th>
                              <th scope="col">Department</th>
                              <th><input type="submit" name="sendPo" value="✔️"></th>
                            </tr>
                      </thead>


    <tbody id="myTable">
            <?php 
               $conn = new mysqli("localhost","root","","inventorymanagement");
               $sql = "SELECT * FROM product";
               $result = $conn->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
            ?>

                <tr class="header">
                      <td><?php echo $count ?></td>
                      <td><?php echo $row["product_name"] ?></td>
                      <td><?php echo $row["class"]  ?></td>
                      <td><?php echo $row["qty"]  ?></td>
                      <td><?php echo $row["unit"]  ?></td>
                      <td><?php echo $row["location"]  ?></td>
                      <td><?php echo $row["cost"]  ?></td>   
                      <td><?php echo $row["dept"]  ?></td>
          <td><input type="checkbox" value="<?php echo $row['product_id']; ?>" name="id[]"></td>   
                </tr>
            <?php
                 } } 
               
            ?>
        </form>      
       </tbody>                                     
        </table>
</div>

<!--ITEMLIST END-->


<script>
function showItemList() {
  document.getElementById("myItemList").style.display = "block";
}

function closeItemList() {
  document.getElementById("myItemList").style.display = "none";
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>