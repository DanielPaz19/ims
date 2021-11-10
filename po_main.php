<?php include_once 'header.php';
if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
}
?>

<link rel="stylesheet" href="css/po_main-style.css">
<script defer src="js/po_main-script.js" type='text/javascript'></script>

<div class="con-form">
  <div class="content-area">
    <fieldset style="border: none;">
      <legend>
        <h2 style="letter-spacing: 5px;">
          <font color="midnightblue">PURCHASE ORDER</font>
        </h2>
      </legend>
      <hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
      <?php include('table/porder_table.html') ?>
  </div>
  </fieldset>
</div>


<?php include_once "footer.php"; ?>