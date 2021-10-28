<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> <!-- navbar icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Document</title>
  <style>
    .navbar {
      overflow: hidden;
      background-color: midnightblue;
      height: 40px;
      letter-spacing: 3px;
    }

    .navbar a {
      margin-left: 5px;
      float: left;
      font-size: 16px;
      color: white;
      text-align: center;
      padding: 7px 8px;
      text-decoration: none;
      font-family: sans-serif;
    }

    .dropdown {
      float: left;
      overflow: hidden;
      font-family: sans-serif;
      margin-left: 20px;

    }

    .dropdown .dropbtn {
      font-size: 16px;
      border: none;
      outline: none;
      color: white;
      padding: 7px 8px;
      background-color: inherit;
      font-family: inherit;
      margin: 0;
      letter-spacing: 2px;
      position: sticky;
    }

    .navbar a:hover,
    .dropdown:hover .dropbtn {
      background-color: white;
      color: midnightblue;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      padding-bottom: 10px;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 0;
      height: auto;


    }

    .dropdown-content a {
      float: none;
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .dropdown-content a:hover {
      background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="#"><i class="fas fa-home"></i>&nbspHome</a>

    <div class="dropdown">
      <button class="dropbtn"><i class="fas fa-box"></i>&nbspInventory
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="../main/itemlist_main.php"><i class="fas fa-box"></i>&nbspItemList</a>
        <a href="../main/stin_main.php"><i class="fas fa-arrow-circle-down"></i>&nbspStock-In</a>
        <a href="../main/stout_main.php"><i class="fas fa-arrow-circle-up"></i>&nbspStock-Out</a>
        <a href="../main/po_main.php"><i class="fas fa-shopping-cart"></i>&nbspPurchase Order</a>
        <a href="../main/srr_main.php"><i class='fas fa-receipt'></i>&nbspStockroom Reciepts Register</a>
      </div>
    </div>


    <div class="dropdown">
      <button class="dropbtn"><i class="fas fa-tools"></i>&nbsp; Utilities&nbsp<i class="fa fa-caret-down"></i>
      </button>

      <div class="dropdown-content">
        <a href="../main/sup_main.php"><i class="fas fa-people-arrows"></i>&nbspSupplier</a>
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
        <a href="#">&nbsp;Purchase Order</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn"><i class="fa fa-gear"></i>&nbspTools&nbsp<i class="fa fa-caret-down"></i>
      </button>

      <div class="dropdown-content">
        <a href="register.php"><i class="fa fa-users"></i>&nbsp;Add New Users</a>
      </div>
    </div>
    <a href="logout-inc.php" style="float:right;"><i class="fas fa-sign-out-alt"></i>&nbspSign-Out</a>
  </div>