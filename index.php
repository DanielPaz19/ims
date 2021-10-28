<?php
if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
};
include_once 'header.php';
?>


<!-- <html>
<title>Philippine Acrylic & Chemical Corporation </title>
<link rel="shortcut icon" href="img/pacclogo.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

</html> -->

<div class='container'>

</div>

<?php include 'footer.php'; ?>