<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/bootstrap.min.css">
    <script src="source/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body style="background-color: aliceblue;">
    <?php
    session_start();
    include('main_sidebar.php'); ?>
    <div class="mt-2" style="padding: 2%;">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="ol-utilities.php" style="color:#0d6efd;text-decoration:none"><button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true" style="color:orangered;">
                        <h5>Shopee</h5>
                    </button></a>
                <a href=" ol-utilities_lazada.php" style="color:#0d6efd;text-decoration:none"><button class="nav-link  active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" style="color:#0d6efd;">
                        <h5>Lazada</h5>
                    </button></a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="background-color: white;">
                <div class="shadow card-header" style="background-color: white;padding:2%;height:80vh">

                    <form action="" method="get">
                        <div class="shadow-sm row" style="background-color: #FEFEFC;padding:2%;width:59%">

                            <div class="col">

                                <div class="form-floating">
                                    <select class="shadow form-select" id="floatingSelect" aria-label="Floating label select example" name="ol_set" style="border-color: #0d6efd;">
                                        <option selected> ------- </option>
                                        <?php
                                        include "php/config.php";
                                        $records = mysqli_query($db, "SELECT ol_title FROM ol_tb
                    WHERE ol_tb.ol_type_id = 1
                    GROUP BY ol_title
                    ORDER BY ol_id DESC");
                                        while ($data = mysqli_fetch_array($records)) {
                                            echo "<option value='" . $data['ol_title'] . "'>" . $data['ol_title'] . "</option>";
                                        }

                                        ?>
                                    </select>

                                    <?php  ?>
                                    <label for="floatingSelect">Choose Statement</label>
                                </div>
                            </div>
                            <div class="col-3 mt-2"><button type="submit" name="submit" class="btn btn-primary" style="border-color:#0d6efd"><i class="bi bi-check2-circle"></i> Select Record</button></div>
                        </div>

                        <br>

                    </form>
                    <?php

                    // IF Edit button Click from PO Main
                    if (isset($_GET['submit'])) {

                        $set = $_GET['ol_set'];

                        require 'php/config.php';

                        $result = mysqli_query(
                            $db,
                            "SELECT ol_product.ol_id,ol_tb.ol_title,ol_type.ol_type_name,ol_tb.ol_si
    FROM ol_product
    LEFT JOIN ol_tb ON ol_tb.ol_id = ol_product.ol_id
    LEFT JOIN ol_type ON ol_tb.ol_type_id = ol_type.ol_type_id
    WHERE ol_tb.ol_type_id = 1 AND ol_tb.ol_title LIKE '%$set%'

    ORDER BY ol_id DESC"
                        );



                        // PO Details
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                $olSi = $row['ol_si'];
                                $olTitle = $row['ol_title'];
                                $ol_type_name = $row['ol_type_name'];
                                $ol_id = $row['ol_id'];
                            }
                        } else {

                            echo "<script>alert('No Item Selected !');
    location.href ='ol-utilities.php' </script>";
                        }

                    ?><br>

                        <form action="view/ol_or.php" method="GET">
                            <div class="row">
                                <div class="shadow col-7" style="background-color: #FEFEFC;padding:2%;height:50vh">
                                    <div class="row" style="color:#0d6efd">
                                        <div class="col">
                                            <h4><?php echo $ol_type_name ?></h4>
                                        </div>
                                    </div>
                                    <div class="row" style="color:#0d6efd">
                                        <div class="col">
                                            <h5>Pay-Out Summary</h5>
                                        </div>
                                        <div class="col">
                                            <div class="row">


                                                <div class=" col">
                                                    <h5 style="text-align:right ;"><?php echo $olTitle ?></h5>
                                                </div>
                                            </div>

                                            <input type="hidden" value="<?php echo $olTitle ?>" name="set">
                                        </div>
                                    </div>


                                    <table class="table">
                                        <tr>
                                            <thead style="color: #0d6efd;">
                                                <th>OL ID</th>
                                                <th>SI No.</th>
                                                <th style="text-align: center;">Product Total Qty</th>
                                                <th>SI Amount</th>
                                                <th>Fee's and Charges</th>
                                                <th>Sub Total</th>
                                            </thead>
                                        </tr>
                                        <tr>
                                            <?php
                                            include "php/config.php";
                                            $sql = "SELECT ol_product.ol_id,ol_tb.ol_title,ol_type.ol_type_name,ol_tb.ol_si,
                            SUM(ol_product.ol_fee) AS fc,
                            SUM(ol_product.ol_priceTot) AS price,
                            SUM(ol_product.ol_qty) AS qty
                            FROM ol_product
                           
                            LEFT JOIN ol_tb ON ol_tb.ol_id = ol_product.ol_id
                            LEFT JOIN ol_type ON ol_tb.ol_type_id = ol_type.ol_type_id
                            WHERE ol_tb.ol_title ='$set'
                            GROUP BY ol_tb.ol_id";

                                            $result = $db->query($sql);
                                            $count = 0;
                                            if ($result->num_rows >  0) {

                                                while ($irow = $result->fetch_assoc()) {
                                                    $total[] = $irow['price'] - $irow['fc'];
                                                    $fcTotal[] = $irow['fc'];

                                            ?>
                                                    <tbody>
                                                        <td><?php echo  str_pad($irow['ol_id'], 8, 0, STR_PAD_LEFT) ?></td>
                                                        <td><?php echo $irow['ol_si'] ?></td>
                                                        <td style="text-align: center;"><?php echo number_format($irow['qty'], 2)  ?></td>

                                                        <td><?php echo number_format($irow['fc'] + $irow['price'], 2) ?></td>
                                                        <td><?php echo number_format($irow['fc'], 2)  ?></td>
                                                        <td><?php echo number_format($irow['price'] - $irow['fc'], 2)  ?></td>

                                                    </tbody>
                                        </tr>

                                <?php }
                                            } ?>
                                    </table>


                                </div>
                                <div class="col-1">
                                </div>

                                <div class="shadow col-4" style="background-color: #FEFEFC;padding:2%;height:35vh;margin-top:1cm">
                                    <h4 style="color:#0d6efd">Summary Breakdown</h4>
                                    <br>
                                    <table class="table">
                                        <tr>
                                            <td style="color:#0d6efd">Total Fee's & Charges</td>
                                            <td><?php
                                                $limit = 0;
                                                $subTot = 0;
                                                $disTot = 0;
                                                while ($limit != count($fcTotal)) {
                                                    $subTot += $fcTotal[$limit];

                                                    // $disTot += $totaldisamount[$limit];
                                                    $limit += 1;
                                                }
                                                $fCgrandTot = $subTot - $disTot;

                                                echo "₱ " . number_format($fCgrandTot, 2)  ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#0d6efd">Sub Total Amount</td>
                                            <td><?php
                                                $limit = 0;
                                                $subTot = 0;
                                                $disTot = 0;
                                                while ($limit != count($total)) {
                                                    $subTot += $total[$limit];

                                                    // $disTot += $totaldisamount[$limit];
                                                    $limit += 1;
                                                }
                                                $grandTot = $subTot - $disTot;



                                                echo "₱ " . number_format($grandTot, 2) ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 style="color:#0d6efd">Settlement Amount</h5>
                                            </td>
                                            <td><?php
                                                $fTot = $grandTot - $fCgrandTot;
                                                echo "<h5>₱ " . number_format($fTot, 2) . "</h5>"; ?>
                                                <input type="hidden" name="setAmount" value="<?php echo $fTot ?>">
                                                <input type="hidden" name="fcTotal" value="<?php echo $fCgrandTot ?>">
                                                <input type="hidden" name="grandTot" value="<?php echo $grandTot ?>">
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div style="float:right">
                                        <button type="submit" class="btn btn-primary" name="save" style="border-color:#0d6efd;">Generate OR</button>
                                        <a href="itemlist_main.php"> <button type="button" class="btn btn-danger"> Cancel</button></a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    <?php
                    } ?>
                </div>
            </div>


        </div>
    </div>


</body>

</html>