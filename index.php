<?php include 'main_header_v2.php';
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>
<?php include('main_sidebar.php') ?>
<?php include_once 'footer.php'; ?>