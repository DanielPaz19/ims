<?php

include_once 'navbar.php';

if (!$_SESSION['user']) {
  header("location: index.php");
};

?>


<html>
<title>Philippine Acrylic & Chemical Corporation </title>
<link rel="shortcut icon" href="img/pacclogo.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

</html>

<?php include('footer.php'); ?>