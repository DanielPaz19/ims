<?php 

include '../../../php/config.php';
$query = "SELECT po_id FROM po_tb ORDER BY po_id DESC LIMIT 1" ;  
$result = mysqli_query($db, $query);   
if(mysqli_num_rows($result) > 0)  
{  
    while($row = mysqli_fetch_assoc($result)){
        $newOrderId = $row['po_id'] + 1;
        echo "<input style='border:none; font-weight:bolder; color:grey;' name='po_id' value='" .$newOrderId ."'>" ;
    }

}  else {
        echo "No result.";
}

?>