<?php include 'header-pos.php';
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
include('../php/config.php');

?>


<div style="padding:2%;margin-top:-1.4cm;">
    <!-- <h2>IMS CASHIERING</h2> -->
    <br>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#home">Job-Order</a>
        </li>
        <li class="nav-item" style="cursor: not-allowed;">
            <a class="nav-link disabled" data-bs-toggle="tab" href="#" style="color: grey;cursor:not-allowed">Cashiering</a>
        </li>
        <li class="nav-item" style="cursor: not-allowed;">
            <a class="nav-link disabled" data-bs-toggle="tab" href="#" style="color: grey;cursor:not-allowed">Payments</a>
        </li>


    </ul>
    <div class="row">
        <div class="col">
            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane active" style="background-color: white;padding:1% ;border-left:1px solid #dee2e6;border-bottom:1px solid #dee2e6;border-right:1px solid #dee2e6;">
                    <?php include_once 'php/jo_modal-inc.php' ?>
                    <!-- <link rel="stylesheet" href="styles/jo_modal-style.css"> -->
                    <script defer src="js/jo_modal-script.js"></script>

                    <div style="padding: 2%;">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control jo__modal--input jo__modal--input__search" placeholder="Search JO-Order No..." aria-label="Username" aria-describedby="addon-wrapping" style="width: 50%;">
                        </div>
                        <br>
                        <table class="jo__modal--table table table-hover">
                            <thead>
                                <tr>
                                    <th>JO No.</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($joId)) {
                                    $jolimit = 0;
                                    while (count($joId) !== $jolimit) {
                                        echo
                                        "<tr>
                                            <td class='jo__modal--td__jonumber'>" . $joNum[$jolimit] . "</td>
                                            <td>" . $joCustomerName[$jolimit] . "</td>
                                            <td>" . $joDate[$jolimit] . "</td>
                                            <td><a href='pos-cashier.php?editJo&id=$joId[$jolimit] '><button class='btn btn-primary' title='Select'><i class='bi bi-caret-right-fill'></i></button></a></td>
                                        </tr>";

                                        $jolimit++;
                                    }
                                }
                                ?>
                                <!-- <tr>
            <td>12-23456</td>
            <td>Philippine Acrylic and Chemical Corp.</td>
            <td>999,999.99</td>
            <td>01-01-2021</td>
          </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>