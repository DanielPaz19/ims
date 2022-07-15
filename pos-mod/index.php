<?php include 'header-pos.php';
if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}
include './php/PointOfSales.php';

$pos = new PointOfSales();

?>
<style>
    * {
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }
</style>


<div style="padding:2%;margin-top:-1.4cm;">
    <!-- <h2>IMS CASHIERING</h2> -->
    <br>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <!-- <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#home">Job-Order</a>
        </li> -->
        <li class="nav-item" style="cursor: not-allowed;">
            <a class="nav-link active" data-bs-toggle="tab" href="#home">Cashiering/Payments</a>
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
                <div id="home" class="tab-pane active" style="background-color: white;padding:1% ;border-left:1px solid #dee2e6;border-bottom:1px solid #dee2e6;border-right:1px solid #dee2e6;">

                    <div class="container w-50 ">
                        <form action="" class="mt-3 mb-5" method="get">
                            <input class="form-control" name="qry" placeholder="Type to search...">
                        </form>
                    </div>
                    <div class="container text-end ">
                        <nav class="d-inline-block">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="container">
                        <table class="table table-sm align-middle">
                            <tr class="text-center">
                                <th>JO ID</th>
                                <th>JO No.</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Balance</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                <?php
                                $result = $pos->getPendingJoPayments();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        $jo_amount = $pos->getJoTotal($row['jo_id']);
                                        $jo_total_paid = $pos->getPaidAmount($row['jo_id']);

                                        $jo_balance = $jo_amount - $jo_total_paid;

                                        if ($jo_balance == 0) continue;
                                ?>

                                        <tr class="text-center">
                                            <td><?php echo $row['jo_id'] ?></td>
                                            <td><?php echo $row['jo_no'] ?></td>
                                            <td class="text-start"><?php echo $row['customers_name'] ?></td>
                                            <td class="text-end"><?php echo number_format($jo_amount, 2); ?></td>
                                            <td class="text-end"><?php echo number_format($jo_balance, 2); ?></td>
                                            <td><?php echo $row['jo_date'] ?></td>
                                            <td><a href="pos-cashier.php?editJo&id=<?php echo $row['jo_id'] ?>" class="btn btn-success"><i class="bi bi-wallet2 "></i> Pay Now</a></td>
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
        </div>
    </div>