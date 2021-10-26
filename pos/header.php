<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POS</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="stylesheet" href="styles/pos-style.css" />
    <link rel="stylesheet" href="styles/login-style.css" />
    <link rel="stylesheet" href="styles/adduser-style.css" />
    <script defer type="application/javascript" src="js/pos-script.js"></script>
</head>

<body>
    <div class="nav-bar">
        <span class="nav--options">
            <button class="nav__button nav__button--pos nav__button--active" data-tab="pos">
                POS
            </button>
            <button class="nav__button nav__button--payment" data-tab="payment">
                Payment
            </button>
        </span>

        <?php
        if (isset($_SESSION['user'])) {
            echo    '<button class="nav__button nav__button--logout" data-tab="payment">
            <a href="php/logout-inc.php">Log-out</a>
            </button>';
        }
        ?>


    </div>