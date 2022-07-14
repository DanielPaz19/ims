<div class="col p-3">
    <div class="container text-primary payment__form--container">
        <form action="payment-save.php?" method="post" style="width: 100%" class="container m-4 mx-auto">
            <div class="payment__title text-center">Payment Options</div>
            <div class="checkbox--container container text-center my-2" style="width: 100%">
                <span class="form-check mx-3" style="display: inline-block">
                    <input checked class="form-check-input" disabled type="radio" name="payment_option" id="cash_payment" required />
                    <label class="form-check-label" for="cash_payment">
                        Cash
                    </label>
                </span>
                <span class="form-check mx-3" style="display: inline-block">
                    <input class="form-check-input" disabled type="radio" name="payment_option" id="online_payment" />
                    <label class="form-check-label" for="online_payment">
                        Online
                    </label>
                </span>
                <span class="form-check mx-3" style="display: inline-block">
                    <input class="form-check-input" disabled type="radio" name="payment_option" id="bank_payment" />
                    <label class="form-check-label" for="bank_payment">
                        Bank Check
                    </label>
                </span>
            </div>
            <div class="form_control-container container mt-5" style="width: 90%">
                <div class="mb-3">
                    <label for="trans_date" class="form-label">Date</label>
                    <input type="date" disabled name="date" value="<?php echo $paymentDate ?>" class="form-control payment__date" id="trans_date" required />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tendered Amount</label>
                    <input type="text" value="<?php echo number_format($tendered, 2) ?>" class="form-control" required disabled />
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="./payment-page.php?id=<?php echo $_GET['id'] ?>" class="btn btn-danger me-4">
                    Cancel</a>
                <input type="submit" name="submit" class="btn btn-success" value="Save Payment" />
            </div>
        </form>
    </div>
</div>