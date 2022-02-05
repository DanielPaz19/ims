
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="source/css/bootstrap.min.css">
    <script src="source/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../img/pacclogo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

    <body>
    <div class="card" style="border: none;">
        <div class="card-body p-5">
            <form class="form-inline" method="POST" action="">
                <div class="range">
                    <label style="float: left;">From:</label>
                        <input type="date" class="form-control" placeholder="Start" name="date1" /> <br>
                    <label style="float: left;">To :</label>
                        <input type="date" class="form-control" placeholder="End" name="date2" /> <br>
                    <label for="inputEmail4" class="form-label">Class <span style="color: red;">*</span> </label>
              <select class="form-select form-select" name="class_id">
                <option>Choose...</option>
                  <?php
                    include "source/php/config.php";
                    $records = mysqli_query($db, "SELECT * FROM class_tb");
                    while ($data = mysqli_fetch_array($records)) {
                        echo "<option value='" . $data['class_id'] . "'>" . $data['class_name'] . "</option>";
                    }
                  ?>
              </select> <br>
                    <button class="btn btn-primary" name="search">Generate Report</button> <br> <br>
                    <!-- <button onclick="window.print()">Print Report</button> -->
                </div>
            </form>
       

        <div class="report">
        <table  class="table table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Description</th>
                        <th>Class</th>
                        <th>TON</th>
                        <th>JO No.</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'php/config.php';
                    if (isset($_POST['search'])) {
                        $date1 = date("Y-m-d", strtotime($_POST['date1']));
                        $date2 = date("Y-m-d", strtotime($_POST['date2']));
                        $class_id = $_POST['class_id'];
                        $query = mysqli_query($db, "SELECT product.product_id, product.product_name, class_tb.class_name, stin_tb.stin_code, stin_tb.stin_title, stin_tb.stin_date, stin_product.stin_temp_qty, unit_tb.unit_name
                        FROM product
                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                        LEFT JOIN stin_product ON stin_product.product_id = product.product_id
                        LEFT JOIN stin_tb ON stin_tb.stin_id = stin_product.stin_id
                        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                        WHERE product.class_id = '$class_id' AND stin_tb.stin_date BETWEEN '$date1' AND '$date2' ;");
                        $row = mysqli_num_rows($query);
                        if ($row > 0) {
                            while ($fetch = mysqli_fetch_array($query)) {
                                $dateString = $fetch['stin_date'];
                                $dateTimeObj = date_create($dateString);
                                $date = date_format($dateTimeObj, 'm/d/y');
                    ?>
                                <tr>
                                    
                                    <td><?php echo $fetch['product_id'] ?></td>
                                    <td><?php echo $fetch['product_name'] ?></td>
                                    <td><?php echo $fetch['class_name'] ?></td>
                                    <td><?php echo $fetch['stin_code'] ?></td>
                                    <td><?php echo $fetch['stin_title'] ?></td>
                                    <td><?php echo $fetch['stin_temp_qty'] ?></td>
                                    <td><?php echo $fetch['unit_name'] ?></td>
                                    <td><?php echo $date ?><br></td>
                                </tr>
                            <?php
                            }
                        } else {
                            echo '
			<tr>
				<script>alert("No records found !");</script>
			</tr>';
                        }
                    } else {
                        $query = mysqli_query($db, "SELECT product.product_id, product.product_name, class_tb.class_name, stin_tb.stin_code, stin_tb.stin_title, stin_tb.stin_date, stin_product.stin_temp_qty, unit_tb.unit_name
                        FROM product
                        LEFT JOIN class_tb ON class_tb.class_id = product.class_id
                        LEFT JOIN stin_product ON stin_product.product_id = product.product_id
                        LEFT JOIN stin_tb ON stin_tb.stin_id = stin_product.stin_id
                        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id");
                        while ($fetch = mysqli_fetch_array($query)) {
                            $dateString = $fetch['po_date'];
                            $dateTimeObj = date_create($dateString);
                            $date = date_format($dateTimeObj, 'm/d/y');
                            ?>
                            <tr>
                            <td><?php echo $date ?><br></td>
                                    <td><?php echo $fetch['product_id'] ?></td>
                                    <td><?php echo $fetch['product_name'] ?></td>
                                    <td><?php echo $fetch['class_name'] ?></td>
                                    <td><?php echo $fetch['stin_code'] ?></td>
                                    <td><?php echo $fetch['stin_title'] ?></td>
                                    <td><?php echo $fetch['stin_temp_qty'] ?></td>
                                    <td><?php echo $fetch['unit_name'] ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>



            </div>


    </div>

    </div>



    </body>

</html>