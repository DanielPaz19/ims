<?php include('header.php');

if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>

<style>
    /* .content-area {
        border-radius: 10px;
        padding: 20px;
        width: 100%;
        height: fit-content;
        background-color: #EAEAEA;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        margin-bottom: 10px;
    } */

    .con-form {
        font-family: Arial, Helvetica, sans-serif;
        border: 1px;
        padding: 10px;
        background-color: none;
        vertical-align: top;
        color: midnightblue;
    }

    .butLink {
        background-color: midnightblue;
        color: white;
        padding: 7px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 3px;
        cursor: pointer;
        width: 150px;
        height: 50px;
    }

    .butLink:hover {
        font-size: 25px;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        font-family: sans-serif;
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        height: auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: red;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: lightblue;
        color: white;
        display: none;
    }

    .modal-body {
        width: auto;
        background-color: gainsboro;
        padding: 30px;

    }

    .modal-footer {
        align-content: center;
        padding: 2px 16px;
        background-color: midnightblue;
        color: white;
    }

    label {
        color: black
    }

    a {
        color: midnightblue;
    }

    table {
        border: 5px solid lightgray;
        border-collapse: collapse;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        -o-box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);

    }

    tr:nth-child(even) {
        background-color: #E7E8F8;
    }

    tr:nth-child(odd) {
        background-color: white;
    }

    th {
        border: 1px solid lightgrey;
        text-align: left;
        padding: 10px;
        font-size: 18px;
        color: white;
        background-color: midnightblue;
    }

    td {
        border: 1px solid lightgray;
        padding: 5px;
    }



    em {
        color: red;

    }
</style>

<div class="con-form">
    <div class="content-area">
        <fieldset style="border: none;">
            <legend>
                <h2 style="letter-spacing: 5px;">
                    <font color="midnightblue">EXIT-PASS</font>
                </h2>
            </legend>
            <hr style=" border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
            <?php include('table/ep_table.html') ?>
    </div>
    </fieldset>
</div>




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