<?php 
// Get the last ID
include 'config.php';
$query = "SELECT stin_id FROM stin_tb ORDER BY stin_id DESC LIMIT 1" ;  
$result = mysqli_query($db, $query);   
if(mysqli_num_rows($result) > 0){  
    while($row = mysqli_fetch_assoc($result)){
        $newStinId = $row['stin_id'];
        echo "<input id='stinId' value='".$newStinId ."'>";
    }

}  else {
        echo "No result.";
}

?>