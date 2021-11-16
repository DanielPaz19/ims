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
        <!-- <a href="#" onclick="myMessage()">End of day...</a> -->

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
        <a href="#">&nbsp;Purchase Order</a>
      </div>
    </div>

    <a href="php/logout-inc.php" style="float:right;" title="Sign-Out">Welcome &nbsp; <i class='fas fa-user-circle'></i>&nbsp;<?php echo $_SESSION["empName"]; ?></a>
  </div>

  <script>
    function myMessage() {
      if (window.confirm("Make sure to sign-out all connected pc before proceeding ..")) {
        window.location.href = "endday/index.html";
      }
    }

    function startTimer() {
      userInput = 15;
      if (userInput.length == 0) {
        alert("Please enter a value");
      } else {
        var numericExpression = /^[0-9]+$/;

        function display(notifier, str) {
          document.getElementById(notifier).innerHTML = str;
        }

        function toMinuteAndSecond(x) {
          return Math.floor(x / 60) + ":" + x % 60;
        }

        function setTimer(remain, actions) {
          (function countdown() {
            display("countdown", toMinuteAndSecond(remain));
            actions[remain] && actions[remain]();
            (remain -= 1) >= 0 && setTimeout(countdown, 1000);

          })();
        }

        let p1 = "Closing all connection...";
        let p2 = "Getting backup file.....";
        let p3 = "Backup Data Successful......";

        setTimer(userInput, {
          12: function() {
            document.getElementById("demo1").innerHTML = p1;;
          }
        });

        setTimer(userInput, {
          10: function() {
            document.getElementById("demo2").innerHTML = p2;;
          }
        });

        setTimer(userInput, {
          5: function() {
            document.getElementById("demo2").innerHTML = p3;;
          }
        });

        setTimer(userInput, {
          3: function() {
            window.location.href = "db-bkp.php";
          }
        });

        setTimer(userInput, {
          0: function() {
            window.location.href = "../php/logout-inc.php";
          }
        });

      }
    }
  </script>