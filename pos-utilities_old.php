<?php

$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$query = "SELECT order_tb.order_id, customers.customers_name, order_tb.dr_number,order_tb.pos_date,order_status.order_status_name, order_tb.jo_id,order_status.order_status_id,customers.tax_type_id,user.user_name
FROM order_tb
LEFT JOIN customers ON customers.customers_id = order_tb.customer_id
LEFT JOIN user ON user.user_id = order_tb.user_id
LEFT JOIN order_status ON order_status.order_status_id = order_tb.order_status_id
ORDER BY order_tb.order_id DESC

";
$result = mysqli_query($connect, $query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <title>POS-OLD-DATA</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700");
        @import url("https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css");

        *,
        *:before,
        *:after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font: 14px/1 'Open Sans', sans-serif;
            color: #555;
            background: aliceblue;
        }

        h1 {
            padding: 50px 0;
            font-weight: 400;
            text-align: center;
        }

        p {
            margin: 0 0 20px;
            line-height: 1.5;
        }

        main {
            min-width: 100%;
            max-width: 800px;
            padding: 50px;
            margin: 0 auto;
            background: white;
        }

        section {
            display: none;
            padding: 20px 0 0;
            border-top: 1px solid #ddd;
        }

        input {
            display: none;
        }

        label {
            display: inline-block;
            margin: 0 0 -1px;
            padding: 15px 25px;
            font-weight: 600;
            text-align: center;
            color: #bbb;
            border: 1px solid transparent;
        }

        label:before {
            font-family: fontawesome;
            font-weight: normal;
            margin-right: 10px;
        }

        img {
            height: 3vh;
        }

        label:hover {
            color: #888;
            cursor: pointer;
        }

        input:checked+label {
            color: #555;
            border: 1px solid #ddd;
            border-top: 3px solid #443DFE;
            border-bottom: 1px solid #fff;
            background-color: white;
        }


        #tab1:checked~#content1,
        #tab2:checked~#content2 {
            display: block;
        }

        @media screen and (max-width: 650px) {
            label {
                font-size: 0;
            }

            label:before {
                margin: 0;
                font-size: 18px;
            }
        }

        .shopee {
            padding-bottom: 7px;
            border-bottom: 1px solid #443DFE;
            line-height: 48px;
        }

        .lazada {
            padding-bottom: 7px;
            border-bottom: 1px solid #443DFE;
            line-height: 48px;
        }

        th {
            text-align: left;
        }

        #data td {
            padding: 8px;
            margin: auto;

        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #FDFCFC;
        }

        thead {
            background-color: #443DFE;

        }





        @media screen and (max-width: 400px) {
            label {
                padding: 15px;
            }
        }
    </style>
</head>

<body style="background-color: aliceblue;"><br>
    <div style="padding: 3%; background-color:white" class="container">
        <a href="pos-utilities.php" style="float: right;text-decoration:none;color:#443DFE;font-weight:bold"> <i class="bi bi-chevron-left"></i>New Record</a>

        <div class="row">
            <div class="col">
                <h3 style="color: #443DFE;"> <span class="shopee">Delivery Reciepts Records (Old)</span> </h3>
            </div>
        </div>

        <br>
        <table id="data" class="table table-striped" data-order='[[ 0, "desc" ]]'>
            <thead>
                <tr style="color: white;">
                    <th>Order ID</th>
                    <th>DR NO.</th>
                    <th>Customer</th>
                    <th style="text-align:center;">Date</th>
                    <th style="text-align:center;">Created by</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $dateString = $row['pos_date'];
                $dateTimeObj = date_create($dateString);
                $date = date_format($dateTimeObj, 'm/d/y'); ?>

                <tr>
                    <td style="margin-bottom:0"><?php echo  str_pad($row['order_id'], 8, 0, STR_PAD_LEFT) ?></td>
                    <td style="margin-bottom:0"><?php echo $row['dr_number'] ?></td>
                    <td style="margin-bottom:0"><?php echo $row['customers_name'] ?></td>
                    <td style="margin-bottom:0"><?php echo $date ?></td>
                    <td style="margin-bottom:0"><?php echo $row['user_name'] ?></td>
                    <td align="center"><a href="view/viewdr2.php?id=<?php echo $row['order_id'] ?>&joId=<?php echo $row['jo_id'] ?>">
                            <button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-printer"></i> Re-Print DR</button></a></td>
                </tr>

            <?php } ?>
        </table>

    </div>

</body>

</html>

<script>
    $(document).ready(function() {
        $(' #data').DataTable();
    });
</script>