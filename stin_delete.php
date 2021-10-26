
<?php
include "config.php"; 
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
<?php

if (isset($_GET['id']))
{

$result = mysqli_query($db,"DELETE FROM stin_tb WHERE stin_id=".$_GET['id']);
if($result==true)
	echo "success";
header("Location:stin.php");
}

?>