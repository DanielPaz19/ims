<?php 
// Get the last ID
include 'config.php';
$query = "SELECT po_id FROM po_tb ORDER BY po_id DESC LIMIT 1" ;  
$result = mysqli_query($db, $query);   
if(mysqli_num_rows($result) > 0){  
    while($row = mysqli_fetch_assoc($result)){
        $newpoId = $row['po_id'];
        echo "<input id='poId' value='".$newpoId ."'>";
    }

}  else {
        echo "No result.";
}

?>