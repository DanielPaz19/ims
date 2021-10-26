<?php 

include '../../../php/config.php';
$query = "SELECT stout_id FROM stout_tb ORDER BY stout_id DESC LIMIT 1" ;  
$result = mysqli_query($db, $query);   
if(mysqli_num_rows($result) > 0)  
{  
    while($row = mysqli_fetch_assoc($result)){
        $newOrderId = $row['stout_id'] + 1;
        echo "<input style='border:none; font-weight:bolder; color:grey;' name='stout_id' value='" .$newOrderId ."'>" ;
    }

}  else {
        echo "No result.";
}

?>