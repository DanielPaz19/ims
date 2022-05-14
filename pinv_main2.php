<?php include('header_main.php');
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
?>


<?php include('table/pinv_table.html') ?>

<?php include "footer.php"; ?>