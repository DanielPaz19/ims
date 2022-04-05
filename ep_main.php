<?php include('header_main.php');


if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>


<?php include('table/ep_table.html') ?>

<script type='text/javascript'>
    function showadditem() {
        //set the width and height of the 
        //pop up window in pixels
        var width = 500;
        var height = 500;

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
        window.open('main/addrecord/addep.php',
            "Contact The Code Ninja",
            "menubar=no,resizable=yes,width=1800,height=600,scrollbars=yes,left=" +
            left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
    }
</script>

<?php include "footer.php"; ?>