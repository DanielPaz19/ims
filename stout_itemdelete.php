<?php
include "config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE FROM stout_temp_tb WHERE stout_temp_id=" . $_GET['id']);
    if ($result == true)
        mysqli_close($db); // Close connection
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

?>
