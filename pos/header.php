<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POS</title>
    <link rel="shortcut icon" href="../img/pacclogo.png" />
    <link rel="stylesheet" href="styles/pos-style.css" />
    <link rel="stylesheet" href="styles/login-style.css" />
    <link rel="stylesheet" href="styles/adduser-style.css" />
    <link rel="stylesheet" href="../css/itemlist-modal-style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> <!-- navbar icon -->
    <script defer type="application/javascript" src="js/pos-script.js"></script>
    <script defer type="application/javascript" src="../js/itemlist-modal-script.js"></script>
</head>

<body>
    <div class="nav-bar">
        <span class="nav--options">
            <button class="nav__button nav__button--pos nav__button--active" data-tab="pos">
                Payment
            </button>
            <button class="nav__button nav__button--payment" data-tab="payment">
                Releasing
            </button>
        </span>

        <?php
        if (isset($_SESSION['user'])) {
        }
        ?>
        <button class="nav__button nav__button--logout"><a href="../php/logout-inc.php" style="float:right; font-size: 18px" title="Sign-Out"><i class='fas fa-user-circle'></i>&nbsp;<?php echo $_SESSION["empName"]; ?></a></button>

    </div>