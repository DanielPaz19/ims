<?php include('header_main.php');
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
?>
<?php include('php/config.php'); ?>



<?php include('table/ol_table.html') ?>





<?php include "footer.php"; ?>