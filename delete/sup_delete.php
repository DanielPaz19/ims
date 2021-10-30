<?php
include "../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE FROM sup_tb WHERE sup_id=" . $_GET['id']);
    if ($result == true)
        echo "success";
    header("Location:../sup_main.php");
}

?>