<?php

include('header_main.php');


if (!isset($_SESSION['user'])) {
  header("location: login-page.php");
}
?>



<?php include('table/sup_table.html') ?>
<?php include('main/addrecord/addsup.php') ?>


<!--SCRIPTS STARTS HERE-->


<script>
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
</script>


<script type='text/javascript'>
  function showaddsup() {
    //set the width and height of the 
    //pop up window in pixels
    var width = 1400;
    var height = 1400;

    //Get the TOP coordinate by
    //getting the 50% of the screen height minus
    //the 50% of the pop up window height
    var top = parseInt((screen.availHeight / 2) - (height / 2));

    //Get the LEFT coordinate by
    //getting the 50% of the screen width minus
    //the 50% of the pop up window width
    var left = parseInt((screen.availWidth / 2) - (width / 2));

    //Open the window with the 
    //file to show on the pop up window
    //title of the pop up
    //and other parameter where we will use the
    //values of the variables above
    window.open('main/addrecord/addsup.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=no,width=500,height=800,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>


<?php include 'footer.php'; ?>