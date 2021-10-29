<?php include_once 'header.php';

if (!$_SESSION['user']) {
  header("location: ../login-page.php");
}

?>

<!---------------------------- POS TAB ----------------------->

<div class="tab__content tab__content--pos tab__content--active">
  <div class="left-side">
    <div class="left-side-content">
      <div class="container-customer_details">
        <span class="container-customer_id">
          <label for="customerId">Customer ID</label><br />
          <input type="text" id="customerId" class="input-customer_id" placeholder="000001" />
        </span>
        <span class="container-customer_name">
          <label for="customerName">Customer Name</label><br />
          <input type="text" id="customerName" class="input-customer_name" placeholder="PHILIPPINE ACRYLIC AND CHEMICAL CORP." />
        </span>
        <span><button class="btn-search_customer"><i class="fa fa-search"></i>&nbsp;Search</button></span><br />

        <label for="customerAddress">Address</label><br />
        <input type="text" id="customerAddress" class="input-customer_address" placeholder="635 Mercedes Ave, Brgy. San Miguel, Pasig City" /><br />

        <span>
          <span class="container-customer_mobile">
            <label for="customerMobile"> Mobile</label><br />
            <input type="text" id="customerMobile" class="input-customer_mobile" placeholder="09xxxxxxxxx" />
          </span>
          <span class="container-customer_telephone">
            <label for="customerTelephone"> Telephone</label><br />
            <input type="text" id="customerTelephone" class="input-customer_telephobe" placeholder="1234-5678" />
          </span>
        </span>
      </div>
      <div class="container-nav_buttons">
        <span class="container-transaction_number"><label for="transactionNumber">Transaction Number:</label>
          <input type="text" id="transactionNumber" value="0000000001" /></span>
        <span class="container-transaction_date"><label for="transactionDate">Transaction Date:</label>
          <input type="text" id="transactionDate" disabled value="01-01-2021" /></span>
      </div>
      <div class="order-list-container">
        <table class="order-list">
          <thead>
            <tr>
              <th>Item Code</th>
              <th>Item Decription</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Unit</th>
              <th>Discount</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="container-order-list">
            <tr>
              <td class="item-code">000001</td>
              <td class="item-description">000 1.5mm x 1220mm x 2440mm</td>
              <td class="price">1,200.00</td>
              <td class="qty">20</td>
              <td class="unit">sht</td>
              <td class="discount">0</td>
              <td class="total">2,400.00</td>
              <td class="delete">X</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-item_list">
        <input type="text" class="input-search_item" placeholder="Search Item Name" />
        <div class="container table item_list">
          <table class="item-list">
            <thead>
              <tr>
                <th class="item-code">Item Code</th>
                <th class="item-description">Item Description</th>
                <th class="price">Price</th>
                <th class="qty">Qty</th>
                <th class="unit">Unit</th>
                <th class="location">Location</th>
              </tr>
            </thead>
            <tbody class="product-list"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT SIDE -->
  <div class="right-side">
    <div class="summary-details">
      <fieldset class="fieldset-summary">
        <legend>Summary Details</legend>

        <div class="summary_label-container">
          <span class="summary-label">Sub-Total</span>
          <span class="subtotal-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>
        <div class="summary_label-container">
          <span class="summary-label">Tax</span>
          <span class="tax-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>

        <div class="summary_label-container">
          <span class="summary-label">Net-sales</span>
          <span class="netsales-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>

        <div class="summary_label-container">
          <span class="summary-label">Discount Amount</span>
          <span class="disc_amount-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>

        <div class="summary_label-container">
          <span class="summary-label">Total Quantity</span>
          <span class="total_qty-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>

        <div class="summary_label-container">
          <span class="summary-label">Gross Amount</span>
          <span class="gross_amount-value">
            <input type="text" value="0.00" disabled />
          </span>
        </div>
        <div class="container-total_payable">
          <p class="label-total_payable">0.00</p>
        </div>
      </fieldset>
    </div>
    <div class="container__button--save">
      <button class="btn-save">SAVE</button>
    </div>
  </div>
  <!--  CUSTOMER MODAL -->
  <div id="customerModal" class="customer-modal modal">
    <!-- Modal content -->
    <div class="customer-modal-content">
      <div class="customer-nav">
        <span class="customer-search-container">
          <input type="text" id="searchCustomer" placeholder="Search Customer...   " />
        </span>
        <span class="customer__modal--close"> X </span>
      </div>
      <div class="customer-table-container">
        <table id="customer-table">
          <thead>
            <tr class="head">
              <th class="customer-id">ID</th>
              <th class="customer-name">Name</th>
              <th class="customer-address">Address</th>
              <th class="customer contact">Contact</th>
            </tr>
          </thead>
          <tbody id="customer-list">
            <!-- <tr class="customer-data">
                  <td class="customer-id">000001</td>
                  <td class="customer-name">Karl Siat</td>
                  <td class="customer-address">
                    635 Mercedes Ave., Pasig City
                  </td>
                  <td class="customer-contact">09876543210</td>
                </tr>
                <tr class="customer-data">
                  <td class="customer-id">000002</td>
                  <td class="customer-name">Dave Obera</td>
                  <td class="customer-address">
                    635 Mercedes Ave., Pasig City
                  </td>
                  <td class="customer-contact">09876543210</td> -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!---------------------------- PAYMENT TAB ----------------------->
<div class="tab__content tab__content--payment">
  <h1>Pending Payments</h1>

  <div class="container-transaction-list">
    <table class="tbl-transaction">
      <thead>
        <tr>
          <th>Transaction No.</th>
          <th>Customer Name</th>
          <th>Amount</th>
          <th>Balance</th>
          <th>Transaction Date</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody class="transaction-list">
        <!-- <tr>
              <td>00000001</td>
              <td>Karl Siat</td>
              <td>100000.00</td>
              <td>09/21/2021</td>
            </tr>
            <tr>
              <td>00000002</td>
              <td>Danielle Paz</td>
              <td>200000.00</td>
              <td>09/23/2021</td>
            </tr> -->
      </tbody>
    </table>
  </div>

  <div id="payment-modal">
    <div class="container-payment-details">
      <h1>Payment</h1>

      <div class="payment__modal--close">
        <p>X</p>
      </div>

      <form class="payment" method="get" action="payment.php">
        <fieldset class="payment-type">
          <legend>Payment Type</legend>
          <div>
            <span class="container-radio-button">
              <input type="radio" id="cash" name="payment-type" value="" checked class="radio--payment-type" />
              <label for="cash" class="label--payment-type">CASH</label>
              <input type="radio" id="online" value="" name="payment-type" class="radio--payment-type" />
              <label for="online" class="label--payment-type">ONLINE</label>
              <input type="radio" id="cheque" value="" name="payment-type" class="radio--payment-type" />
              <label for="cheque" class="label--payment-type">CHEQUE</label>
            </span>
          </div>
        </fieldset>

        <fieldset class="online-details">
          <div class="online-details">
            <label for="">Online Platform:</label>
            <select name="" id="onlinePlatform" disabled>
              <option value="">-Select Field-</option>
              <option value="1">GCash</option>
              <option value="2">Paymaya</option>
            </select>
            <label for="">Transaction Date:</label>
            <input type="date" class="transaction-date" name="payment_date" disabled />
            <label for="">Reference Number:</label>
            <input type="text" class="reference-number" name="ref_num" disabled />
          </div>
        </fieldset>

        <fieldset class="bank-details">
          <div class="bank-details">
            <label for="">Bank:</label>
            <select name="" id="bankName" disabled>
              <option value="">-Select Field-</option>
              <option value="1">BPI</option>
              <option value="2">BDO</option>
              <option value="3">MBTC</option>
            </select>
            <label for="">Cheque Date:</label>
            <input type="date" class="cheque-date" name="payment_date" disabled />
            <label for="">Cheque Number:</label>
            <input type="text" class="cheque-number" name="ref_num" disabled />
          </div>
        </fieldset>

        <div class="payment-details">
          <label for="">Amount:</label>
          <input type="text" class="payment-balance" value="1000.00" disabled /><br />
          <label for="">Tendered Amount:</label>
          <input type="text" class="payment-tendered" placeholder="Enter Amount" /><br />
          <label for="" class="change-balance">Change: </label>
          <input type="text" class="payment-change" disabled value="0.00" />
        </div>

        <div class='container--button__save'>
          <button class="button__save--payment">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include_once 'footer.php'; ?>