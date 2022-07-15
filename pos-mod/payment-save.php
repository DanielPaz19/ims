<?php

if (isset($_POST['submit'])) {

    include "./php/Payment.php";

    $payment = new Payments($_GET['jo_id']);

    if ($payment->savePayment($_POST)) {
        return header("Location: index.php");
    }

    echo "Something went wrong";
}
