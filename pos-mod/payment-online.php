<div class="col p-3">
    <div class="container text-primary payment__form--container">
        <form action="payment-save.php?" method="post" style="width: 100%" class="container m-4 mx-auto">
            <div class="payment__title text-center">Payment Options</div>
            <div class="checkbox--container container text-center my-2" style="width: 100%">
                <span class="form-check mx-3" style="display: inline-block">
                    <input class="form-check-input" disabled type="radio" name="payment_option" id="cash_payment" required />
                    <label class="form-check-label" for="cash_payment">
                        Cash
                    </label>
                </span>
                <span class="form-check mx-3" style="display: inline-block">
                    <input class="form-check-input" checked disabled type="radio" name="payment_option" id="online_payment" />
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
                    <label for="" class="form-label">Date</label>
                    <input type="date" disabled name="date" value="<?php echo $paymentDate ?>" class="form-control payment__date" id="trans_date" required />
                </div>
                <div class="mb-3">
                    <label for="online_select" class="form-label">Online Platform</label>
                    <select name="online_select" class="form-select" aria-label="Default select example" required>
                        <option disabled selected value="">Open this select menu</option>
                        <option value="1">GCash</option>
                        <option value="2">Paymaya</option>
                        <option value="3">Online Bank</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ref_num" class="form-label">Reference Number</label>
                    <input type="text" name="date" id="ref_num" class="form-control payment__date" id="trans_date" required />
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tendered Amount</label>
                    <input type="text" value="<?php echo number_format($tendered, 2) ?>" class="form-control" required disabled />
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="./payment-page.php" class="btn btn-danger me-4">
                    Cancel</a>
                <input type="submit" name="submit" class="btn btn-success" value="Save Payment" />
            </div>
        </form>
    </div>
</div>