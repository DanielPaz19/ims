<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> <!-- navbar icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
  <a href="../index.php" style="float:right;"><i class="fas fa-sign-out-alt"></i>&nbspSign-Out</a>
</div>


<!-- Class Window -->
<script type='text/javascript'>
  function showClass() {
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
    window.open('../utilities/addclass.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=800,height=600,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>

<!-- Department Window -->
<script type='text/javascript'>
  function showDept() {
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
    window.open('../utilities/adddept.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1000,height=600,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>

<!-- Unit Window -->
<script type='text/javascript'>
  function showUnit() {
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
    window.open('../utilities/addunit.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1200,height=600,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>

<!-- Location Window -->
<script type='text/javascript'>
  function showLocation() {
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
    window.open('../utilities/addlocation.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1200,height=600,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>


<!-- Employee Window -->
<script type='text/javascript'>
  function showEmployee() {
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
    window.open('../utilities/addemployee.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1200,height=600,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>


<!-- Payments Window -->
<script type='text/javascript'>
  function showPayments() {
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
    window.open('../utilities/bo_payments.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1000,height=800,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>

<!-- Bank Window -->
<script type='text/javascript'>
  function showBank() {
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
    window.open('../utilities/bo_bank.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=yes,width=1000,height=800,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>


<!-- Customer Window -->
<script type='text/javascript'>
  function showCustomer() {
    //set the width and height of the 
    //pop up window in pixels
    var width = 1200;
    var height = 820;

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
    window.open('../utilities/bo_customer.php',
      "Contact The Code Ninja",
      "menubar=no,resizable=no,width=1200,height=820,scrollbars=yes,left=" +
      left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
  }
</script>