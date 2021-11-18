<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/pacclogo.png" />
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/header-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> <!-- navbar icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <title>PACC IMS</title>
  <!-- <style>
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
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      border: 1px solid #888;
      width: 80%;
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
      color: white;
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
      background-color: #5cb85c;
      color: white;
    }

    .modal-body {
      padding: 2px 16px;
    }

    .modal-footer {
      padding: 2px 16px;
      background-color: #5cb85c;
      color: white;
    }
  </style> -->
</head>

<body style="margin: 0px;" bgcolor="#B0C4DE">


  <div class="navbar" <?php
                      if (!isset($_SESSION['user'])) {
                        echo "hidden";
                      }
                      ?>>
    <a href="index.php"><i class="fas fa-home"></i>&nbspHome</a>
    <a href="jo_main.php" title="Create New Job-Order"><i class="fas fa-clipboard-list"></i>&nbspJob-Order</a>
    <div class="dropdown">
      <button class="dropbtn"><i class="fas fa-box"></i>&nbspInventory
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="itemlist_main.php"><i class="fas fa-box"></i>&nbspItemList</a>
        <a href="stin_main.php"><i class="fas fa-arrow-circle-down"></i>&nbspStock-In</a>
        <a href="stout_main.php"><i class="fas fa-arrow-circle-up"></i>&nbspStock-Out</a>

        <a href="ep_main.php"><i class="fas fa-arrow-circle-up"></i>&nbspExit-Pass</a>
        <a href="po_main.php"><i class="fas fa-shopping-cart"></i>&nbspPurchase Order</a>
        <!-- <a href="srr_main.php"><i class='fas fa-receipt'></i>&nbspStockroom Reciepts Register</a> -->
      </div>
    </div>


    <div class="dropdown">
      <button class="dropbtn"><i class="fas fa-tools"></i>&nbsp; Utilities&nbsp<i class="fa fa-caret-down"></i>
      </button>

      <div class="dropdown-content">
        <a href="sup_main.php"><i class="fas fa-people-arrows"></i>&nbspSupplier</a>
        <a href="#" onclick="showPayments()"><i class="fa fa-plus-circle"></i>&nbsp;Payment Type</a>
        <a href="#" onclick="showBank()"><i class="fa fa-plus-circle"></i>&nbsp;Bank</a>
        <a href="#" onclick="showCustomer()"><i class="fa fa-plus-circle"></i>&nbsp;Customer</a>
        <a href="#" onclick="showClass()"><i class="fa fa-plus-circle"></i>&nbsp;Class</a>
        <a href="#" onclick="showDept()"><i class="fa fa-plus-circle"></i>&nbsp;Department</a>
        <a href="#" onclick="showUnit()"><i class="fa fa-plus-circle"></i>&nbsp;Unit</a>
        <a href="#" onclick="showLocation()"><i class="fa fa-plus-circle"></i>&nbsp;Location</a>
        <a href="#" onclick="showEmployee()"><i class="fa fa-plus-circle"></i>&nbsp;Employee</a>


      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn"><i class="fa fa-file-text-o"></i>&nbsp;Reports&nbsp<i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="#">&nbsp;Inventory</a>
        <a href="#">&nbsp;POS</a>
        <a href="#">&nbsp;Stock-In </a>
        <a href="#">&nbsp;Stock-Out </a>
        <a href="#" onclick="showSrr()">&nbsp;Purchase Order</a>
      </div>
    </div>

    <a href="php/logout-inc.php" style="float:right;" title="Sign-Out">Welcome &nbsp; <i class='fas fa-user-circle'></i>&nbsp;<?php echo $_SESSION["empName"]; ?></a>
  </div>


  <script type='text/javascript'>
    function showSrr() {
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
      window.open('report/srr_select.php',
        "Contact The Code Ninja",
        "menubar=no,resizable=yes,width=1600,height=1000,scrollbars=yes,left=" +
        left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
    }
  </script>