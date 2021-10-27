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

$result = mysqli_query($db,"DELETE FROM stin_product WHERE stin_id=".$_GET['id']);
if($result==true)
        echo "Success";
        mysqli_close($db); // Close connection
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
}

?>