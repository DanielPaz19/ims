<?php
include "../php/config.php";
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE FROM unit_tb WHERE unit_id=" . $_GET['id']);
    if ($result == true)
        echo "<script>alert('Delete Location successfully !')</script>";
    header("Location:../utilities/addunit.php");
}

?>