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
                            <div class="col p-3">
                                <div class="container text-primary payment__form--container">
                                    <form action="payment-page2.php" method="post" style="width: 100%" class="container m-4 mx-auto">
                                        <div class="payment__title text-center">Payment Options</div>
                                        <div class="checkbox--container container text-center my-2" style="width: 100%">
                                            <span class="form-check mx-3" style="display: inline-block">
                                                <input checked class="form-check-input" type="radio" name="payment_option" id="cash_payment" value="cash" required />
                                                <label class="form-check-label" for="cash_payment">
                                                    Cash
                                                </label>
                                            </span>
                                            <span class="form-check mx-3" style="display: inline-block">
                                                <input class="form-check-input" type="radio" name="payment_option" id="online_payment" value="online" />
                                                <label class="form-check-label" for="online_payment">
                                                    Online
                                                </label>
                                            </span>
                                            <span class="form-check mx-3" style="display: inline-block">
                                                <input class="form-check-input" type="radio" name="payment_option" id="bank_payment" value="bank" />
                                                <label class="form-check-label" for="bank_payment">
                                                    Bank Check
                                                </label>
                                            </span>
                                        </div>
                                        <div class="form_control-container container mt-5" style="width: 90%">
                                            <div class="mb-3">
                                                <label for="trans_date" class="form-label">Date</label>
                                                <input name="date" type="date" class="form-control payment__date" id="trans_date" required max="2022-07-01" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Tendered Amount</label>
                                                <input name="tendered" type="number" min="1" class="form-control" placeholder="Enter Amount" required />
                                            </div>
                                        </div>
                                        <div class="text-center mt-5">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Next >" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        const paymentDate = document.querySelector(".payment__date");

        paymentDate.max = new Date().toISOString().split("T")[0];
        paymentDate.value = new Date().toISOString().split("T")[0];
    </script>

    <script>
        //date
        document.querySelector('.date').value = new Date().toISOString();
    </script>