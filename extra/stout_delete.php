
<?php
include "config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE FROM stout_tb WHERE stout_id=" . $_GET['id']);

    $result = mysqli_query($db, "DELETE FROM stout_product WHERE stout_id=" . $_GET['id']);
    if ($result == true)
        echo "success";
    header("Location:stout.php");
}

?>