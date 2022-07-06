<?php include 'header-pos.php';
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
include('../php/config.php');
?>


<?php
if (isset($_POST['submit'])) {
    $option = $_POST['payment_option'];
    $paymentDate = $_POST['date'];
    $tendered = $_POST['tendered'];
}

?>

<div style="padding:2%;margin-top:-1.4cm;">
    <!-- <h2>IMS CASHIERING</h2> -->
    <br>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <!-- <li class="nav-item" style="cursor: not-allowed;">
            <a class="nav-link disabled" data-bs-toggle="tab" href="#">Job-Order</a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Cashiering/Payments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pos-dr.php">Delivery Reciepts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pos-si.php">Sales Invoice</a>
        </li>
    </ul>

    <div class="row">
        <div class="col">
            <!-- Tab panes -->
            <div class="tab-content">
                <div id="menu1" class="tab-pane active" style="background-color: white;padding:1% ;border-left:1px solid #dee2e6;border-bottom:1px solid #dee2e6;border-right:1px solid #dee2e6;"><br>
                    <div class="jo_details_container">

                    </div>
                    <div class="container payment__container  ">
                        <div class="row">
                            <div class="col border-end position-relative">
                                <div class="container jo_details--container">
                                    <div class="position-absolute top-50 start-50 translate-middle" style="min-width: 70%">
                                        <div class="text-secondary">JO# 12-34567</div>
                                        <div class="customer__name text-uppercase fw-bold fs-5 mb-5 text-secondary">
                                            philippine acrylic and chemical corp.
                                        </div>
                                        <div class="jo__amount--container mx-auto" style="width: 60%">
                                            <div class="jo__amount--container row mb-2">
                                                <div class="jo__amount--label text-info text-start col">
                                                    JO Amount:
                                                </div>
                                                <div class="jo__amount text-end col text-secondary">
                                                    1000.00
                                                </div>
                                            </div>
                                            <div class="jo__paid--container mt-1 row">
                                                <div class="jo__paid--label text-info text-start col">
                                                    Total Paid:
                                                </div>
                                                <div class="jo__paid text-end col text-secondary">
                                                    3000.00
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jo__balance text-success mt-5 fw-bold fs-2 text-center">
                                            ₱ 100000.00
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                            if ($option === 'cash') {
                                include './payment-cash.php';
                            }

                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        //date
        document.querySelector('.date').value = new Date().toISOString();
    </script>