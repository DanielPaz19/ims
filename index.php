<?php
include_once 'header.php';

if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
}
?>

<div class='container'>

</div>

<?php include_once 'footer.php'; ?>