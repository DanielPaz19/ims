"use strict";

// OBJECTS
const transaction = {
  customerId: 0,
  transactionId: 0,
  transDate: "",
};

const order = {
  productId: [],
  qty: [],
  discount: [],
  price: [],
  total: 0,
};

const paymentId = [];

const payment = {
  type: 1,
  id: 0,
  tendered: 0,
  balance: 0,
  change: 0,
  status: 0,
};

const online = {
  platform: "",
  reference: "",
  paymentDate: "",
};

const cheque = {
  bank: "",
  chequeNumber: "",
  chequeDate: "",
};

const NumOptions = {
  style: "decimal",
  currency: "PHP",
  minimumFractionDigits: 2,
};

// ELEMENTS

// Nav
const nav = document.querySelector(".nav-bar");
const navOptions = document.querySelectorAll(".nav__button");
const tabPayment = document.querySelector(".nav__button--payment");
const tabPos = document.querySelector(".nav__button--pos");

// Tab Content
const tabContent = document.querySelectorAll(".tab__content");

//---------------------------POS ELEMENTS---------------------------------

//customers
const inputCustomerId = document.querySelector("#customerId");
const inputCustomerName = document.querySelector("#customerName");
const inputCustomerAddress = document.querySelector("#customerAddress");
const inputCustomerContact = document.querySelector("#customerContact");
const btnSearchCustomer = document.querySelector(".btn-search_customer");
const containerCustomerList = document.querySelector("#customer-list");
const inputSearchCustomer = document.querySelector("#searchCustomer");
const rowCustomerList = document.querySelector("tr.customer-data");

//modal
const modalCustomer = document.querySelector("#customerModal");
const btnCustomerClose = document.querySelector(".customer__modal--close");

//transaction
const inputTransNumber = document.querySelector("#transactionNumber");

//product table
const inputSearchProduct = document.querySelector(".input-search_item");
const containerProductList = document.querySelector(".product-list");

//order table
const containerOrderList = document.querySelector(".container-order-list");
const btnDeleteRow = document.querySelector(".delete");

//summary
const containerSummary = document.querySelector(".fieldset-summary");
const labelSubtotal = document.querySelector(".subtotal-value").children[0];
const labelGrossAmount = document.querySelector(".gross_amount-value")
  .children[0];
const labelTotalQty = document.querySelector(".total_qty-value").children[0];
const labelTaxAmount = document.querySelector(".tax-value").children[0];
const labelNetSales = document.querySelector(".netsales-value").children[0];
const labelDiscount = document.querySelector(".disc_amount-value").children[0];
const labelTotalPayable = document.querySelector(".label-total_payable");

//buttons
const btnSaveTransaction = document.querySelector(".btn-save");

//--------------------------- PAYMENT ELEMENTS ---------------------------------

const containPendingTrans = document.querySelector(".transaction-list");
const tblTransaction = document.querySelector(".tbl-transaction");
const btnPaymentType = document.querySelector(".button-pay-option");
const rowOptions = document.querySelector(".options");
const modalPayment = document.querySelector("#payment-modal");
const paymentModalClose = document.querySelector(".payment__modal--close");
const labelPaymentBalance = document.querySelector(".payment-balance");
const btnSavePayment = document.querySelector(".button__save--payment");
const inputPaymentTendered = document.querySelector(".payment-tendered");
const inputPaymentChange = document.querySelector(".payment-change");
const labelChangeBalance = document.querySelector(".change-balance");

//radio button
const containerPayOption = document.querySelector(".container-radio-button");
const radioCash = document.querySelector("input#cash");
const radioOnline = document.querySelector("input#online");
const radioCheque = document.querySelector("input#cheque");
const fieldsetOnline = document.querySelector("fieldset.online-details");
const fieldsetBank = document.querySelector("fieldset.bank-details");
const radioPaymentType = document.querySelectorAll(".radio--payment-type");

// Payment Inputs Fields
const selectOnlinePlatform = document.querySelector("#onlinePlatform");
const onlineTransactionDate = document.querySelector(".transaction-date");
const onlineReferenceNumber = document.querySelector(".reference-number");
const selectBankName = document.querySelector("#bankName");
const inputChequeDate = document.querySelector(".cheque-date");
const inputChequeNumber = document.querySelector(".cheque-number");

// ---------------------------------- FUNCTION ---------------------------------
const fetchData = (file, container, input = "") => {
  fetch(file + `?q=${encodeURIComponent(input)}`)
    .then((response) => response.json())
    .then((data) => {
      renderCustomer(data, container);
    });
};

const openCustModal = function () {
  modalCustomer.classList.add("modal--active");

  fetchData("php/search-customer.php", containerCustomerList);
};

const closeCustModal = function () {
  const selectedData = document.querySelector(".customer-data.selected");

  modalCustomer.classList.remove("modal--active");

  if (!selectedData) return;

  inputCustomerId.value = selectedData.children[0].innerHTML;
  inputCustomerName.value = selectedData.children[1].innerHTML;
  inputCustomerContact.value = selectedData.children[3].innerHTML;
  inputCustomerAddress.value = selectedData.children[2].innerHTML;
};

const renderCustomer = function (data, container) {
  container.innerHTML = "";
  data.forEach((data, index) => {
    container.insertAdjacentHTML(
      "beforeend",
      `<tr class='customer-data' id='customer${index}'>
            <td>${data.customers_id.padStart(8, 0)}</td>
            <td>${data.customers_name}</td>
            <td>${data.customers_address}</td>
            <td>${data.customers_contact}</td>
            </tr>`
    );
  });
};

// Update total
const updateRowTotal = (rowIndex) => {
  const targetRow = containerOrderList.rows[rowIndex - 1];

  const rowTotal = targetRow.querySelector(".total");
  const rowPrice = removeComma(targetRow.querySelector(".price").innerHTML);
  const rowDiscount = removeComma(
    targetRow.querySelector(".discount").innerHTML
  );
  const rowQty = removeComma(targetRow.querySelector(".qty").innerHTML);

  rowTotal.innerHTML = formatNumber(rowPrice * rowQty - rowDiscount);
};

const editOrder = function (e, selector) {
  const targetPrice = e.target.closest("tr").querySelector(`.${selector}`);
  const targetIndex = e.target.closest("tr").rowIndex;
  let newValue = prompt("Enter New Value");

  if (
    !newValue ||
    newValue === "null" ||
    newValue.includes(" ") ||
    isNaN(newValue)
  )
    return;

  targetPrice.innerHTML = formatNumber(newValue);

  updateRowTotal(targetIndex);
};

// Update the summary based
function updateSummary(e) {
  const smrySubtotal = containerSummary.querySelector(
    ".input__summary--subtotal"
  );
  const smryTax = containerSummary.querySelector(".input__summary--tax");
  const smryNetsales = containerSummary.querySelector(
    ".input__summary--netsales"
  );
  const smryDiscount = containerSummary.querySelector(
    ".input__summary--discount"
  );
  const smryQty = containerSummary.querySelector(".input__summary--qty");
  const smryGross = containerSummary.querySelector(".input__summary--gross");
  const smryTotal = containerSummary.querySelector(".label-total_payable");
  console.log(containerSummary);
}

const hasDuplicateOrder = function (productId) {
  console.log(productId);
  const orderRow = containerOrderList.querySelectorAll("tr");
  // There's no order in the table
  if (!orderRow.length) return false;

  let duplicate;
  orderRow.forEach((row) => {
    if (+row.children[0].innerHTML === productId) duplicate = true;
  });

  return duplicate;
};

const orderCancel = function (orderId) {
  // Pop up Message for confirmation
  const confirmAcion = confirm(
    `You are about to DELETE Transaction Number ${orderId.padStart(8, 0)}. 
    ARE YOU SURE?`
  );

  // Change order Status into cancelled
  if (confirmAcion) {
    const update = new XMLHttpRequest();

    update.open("POST", "php/order-cancel.php");
    update.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    update.send(`orderId=${orderId}`);
  }

  location.reload();
};

const orderPay = function (orderId, rowIndex, balance) {
  order.orderId = +orderId;
  payment.id = paymentId[rowIndex];
  inputPaymentTendered.value = "";
  inputPaymentChange.value = "";
  labelChangeBalance.textContent = "Change:";
  modalPayment.style.display = "block";
  labelPaymentBalance.value = formatNumber(balance.replaceAll(",", ""));
  inputPaymentTendered.focus();
};

const orderView = function () {};

const savePayment = function (e) {
  e.preventDefault();
  payment.tendered = Number(inputPaymentTendered.value.replace(",", ""));
  payment.balance = Number(inputPaymentChange.value.replace(",", ""));
  payment.date = new Date().toISOString();

  if (!payment.tendered) {
    alert("Invalid tendered amount!");
    return;
  }

  // Online Details
  online.platform = +selectOnlinePlatform.value;
  online.reference = onlineReferenceNumber.value;
  online.paymentDate = onlineTransactionDate.value;

  // Checque Details
  cheque.bank = selectBankName.value;
  cheque.chequeDate = inputChequeDate.value;
  cheque.chequeNumber = inputChequeNumber.value;

  const save = new XMLHttpRequest();
  const paymentJSON = { ...payment, ...order, ...online, ...cheque };

  save.onload = function () {
    const paymentDetails = JSON.parse(this.responseText);
    console.log(paymentDetails);
    alert(
      `Payment Reference: PR-${paymentDetails.order_payment_id.padStart(8, 0)}`
    );

    location.reload();
  };

  save.open("POST", "php/save-payment.php");
  save.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  save.send(`json=${JSON.stringify(paymentJSON)}`);

  console.log(JSON.stringify(paymentJSON));
  console.log(paymentJSON);
  alert("Payment Saved!");
};

//initialization
const init = function () {
  getTransNumber();

  containerOrderList.innerHTML = "";

  document.querySelector("#transactionDate").value = getCurrDate();

  showData("php/search-product.php", containerProductList);
};

const getTransNumber = function () {
  const xhttp = new XMLHttpRequest();

  xhttp.onload = function () {
    const data = JSON.parse(this.responseText);

    inputTransNumber.value = `${Number(data.order_id) + 1}`.padStart(10, 0);
  };

  xhttp.open("GET", "php/auto-order-id.php");
  xhttp.send();
};

const getCurrDate = function () {
  const currDate = new Date();
  return currDate.toDateString();
};

const showData = function (file, container, input = "") {
  // Create an XMLHttpRequest object
  const xhttp = new XMLHttpRequest();

  // Define a callback function
  xhttp.onload = function () {
    const data = JSON.parse(this.responseText);
    showTableData(data, container);
  };

  // Send a request
  xhttp.open("POST", file + `?q=${input}`);
  xhttp.send();
};

const showTableData = (data, container) => {
  container.innerHTML = "";
  if (container == containerProductList) {
    data.forEach((data, index) => {
      let row = `<tr class='product-data product${index}'>
                          <td class='item-code'>${data.product_id.padStart(
                            8,
                            0
                          )}</td>
                          <td class='item-name'>${data.product_name}</td>
                          <td class='price'>${(+data.price).toFixed(2)}</td>
                          <td class='qty'>${data.qty}</td>
                          <td class='unit'>${data.unit_name}</td>
                          <td class='location'>${data.loc_name}</td>
                    </tr>`;
      container.innerHTML += row;
    });
  } else {
    data.forEach((data, index) => {
      let row = `<tr class='customer-data' id='customer${index}'>
                          <td class="customer-id">
                          ${data.customers_id}
                          </td>
                          <td class="customer-name">
                          ${data.customers_name}
                          </td>
                          <td class="customer-address">
                          ${data.customers_address}
                          </td>
                          <td class="customer-contact">
                          ${data.customers_contact}
                          </td>
                    </tr>`;
      container.innerHTML += row;
    });
  }
};

const search = function (inputSearch, container, file, modal) {
  const q = inputSearch.value;
  container.innerHTML = "";
  openCustModal();
};

const selectRow = function (target) {
  // Remove selected
  const checkSelected = document.querySelectorAll("tr.customer-data");
  checkSelected.forEach((row) => {
    row.classList.remove("selected");
  });

  // Add selected
  const selectedRow = target.closest("tr");
  selectedRow.classList.add("selected");
};

//remove comma and convert string to number
const removeComma = (string) => (+string.replace(",", "")).toFixed(2);

const formatNumber = (string) =>
  new Intl.NumberFormat("en-US", NumOptions).format(string);

//request data from database
const showPaymentData = function (file, input, container) {
  // Create an XMLHttpRequest object
  const xhttp = new XMLHttpRequest();

  // Define a callback function
  xhttp.onload = function () {
    const data = JSON.parse(this.responseText);
    showPendingPayments(data, container);
  };

  // Send a request
  xhttp.open("POST", file);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`q=${input}`);
};

//show requested data from database on table
const showPendingPayments = (data, container) => {
  container.innerHTML = "";

  data.forEach((data, index) => {
    paymentId.push(data.order_payment_id);
    const transDate = new Date(data.pos_date).toLocaleString();
    let row = `<tr>
                          <td class="transaction-number">${data.order_id.padStart(
                            8,
                            0
                          )}</td>
                          <td class="customer-name">${data.customers_name}</td>
                          <td class="total">${formatNumber(data.total)}</td>
                          <td class="balance">${formatNumber(
                            data.order_payment_balance
                          )}</td>
                          <td class="date">${transDate}</td>
                          <td class="table__options">
                          <span class="table__option table__option--pay">PAY</span>|
                          <span class="table__option table__option--cancel">CANCEL</span>|
                          <span class="table__option table__option--view">VIEW</span>
                          </td>

                    </tr>`;
    container.innerHTML += row;
  });
};

//disable inputs
const disablePaymentGroup = (group) => {
  switch (group) {
    case "online":
      document.querySelector("#onlinePlatform").setAttribute("disabled", "");
      document.querySelector(".transaction-date").setAttribute("disabled", "");
      document.querySelector(".reference-number").setAttribute("disabled", "");
      fieldsetOnline.style.opacity = 0.5;
      break;
    case "cheque":
      document.querySelector("#bankName").setAttribute("disabled", "");
      document.querySelector(".cheque-date").setAttribute("disabled", "");
      document.querySelector(".cheque-number").setAttribute("disabled", "");
      fieldsetBank.style.opacity = 0.5;
  }
};

//enable inputs
const enablePaymentGroup = (group) => {
  switch (group) {
    case "online":
      document.querySelector("#onlinePlatform").removeAttribute("disabled");
      document.querySelector(".transaction-date").removeAttribute("disabled");
      document.querySelector(".reference-number").removeAttribute("disabled");
      fieldsetOnline.style.opacity = 1;

      break;
    case "cheque":
      document.querySelector("#bankName").removeAttribute("disabled");
      document.querySelector(".cheque-date").removeAttribute("disabled");
      document.querySelector(".cheque-number").removeAttribute("disabled");
      fieldsetBank.style.opacity = 1;
  }
};

// ---------------------------------- POS EVENTS / DECLARATIONS ---------------------------------

//initialization
init();

// EVENTS

// Nav Options
nav.addEventListener("click", function (e) {
  const clicked = e.target.closest(".nav__button");
  console.log(clicked);

  if (!clicked) return;

  // Remove Active
  navOptions.forEach((el) => el.classList.remove("nav__button--active"));
  tabContent.forEach((el) => el.classList.remove("tab__content--active"));

  // Active Tab Button
  clicked.classList.add("nav__button--active");

  // Active Content
  document
    .querySelector(`.tab__content--${clicked.dataset.tab}`)
    .classList.add("tab__content--active");
});

//show customer modal on btn click
btnSearchCustomer.addEventListener("click", openCustModal);

//close customer modal
btnCustomerClose.addEventListener("click", function () {
  closeCustModal();
});

//search customer on customer modal
inputSearchCustomer.addEventListener("keyup", function (e) {
  fetchData("php/search-customer.php", containerCustomerList, this.value);
});

//select customer from customer modal
containerCustomerList.addEventListener("click", function (e) {
  const target = e.target;
  selectRow(target);
});

//add customer details to customer form on key press (Enter)
document.addEventListener("keyup", function (e) {
  if (e.key === "Enter") closeCustModal();
});

//search product from product table
inputSearchProduct.addEventListener("keyup", function () {
  const searchVal = inputSearchProduct.value;
  console.log(inputSearchProduct.value);

  showData(
    "php/search-product.php",
    containerProductList,
    encodeURIComponent(searchVal)
  );
});

//add product to order list
containerProductList.addEventListener("dblclick", function (e) {
  const selectedData = e.target.closest("tr").children;
  const selectedItemCode = selectedData[0].innerHTML;
  const selectedItemName = selectedData[1].innerHTML;
  const selectedPrice = selectedData[2].innerHTML;
  const inputQty = 1;
  const selectedUnit = selectedData[4].innerHTML;
  const inputDiscount = 0;
  const total = selectedPrice * inputQty - inputDiscount;
  console.log(selectedItemCode, selectedItemName, selectedPrice, selectedUnit);

  if (hasDuplicateOrder(+selectedItemCode))
    return alert(`${selectedItemName} is already added.`);

  containerOrderList.innerHTML += `
  <tr>
  <td class="item-code">${selectedItemCode.padStart(8, 0)}</td>
  <td class="item-description">${selectedItemName}</td>
  <td class="price">${selectedPrice}</td>
  <td class="qty">${inputQty}</td>
  <td class="unit">${selectedUnit}</td>
  <td class="discount">${inputDiscount.toFixed(2)}</td>
  <td class="total">${total.toFixed(2)}</td>
  <td class="delete">X</td>
</tr>`;

  //add to summary
  labelGrossAmount.value = (+labelGrossAmount.value + +total).toFixed(2);
  labelTotalQty.value = +labelTotalQty.value + inputQty;
  labelSubtotal.value = (+labelGrossAmount.value / 1.12).toFixed(2);
  labelTaxAmount.value = (
    +labelGrossAmount.value - +labelSubtotal.value
  ).toFixed(2);
  labelNetSales.value = (
    +labelSubtotal.value +
    +labelTaxAmount.value -
    +labelDiscount.value
  ).toFixed(2);

  labelTotalPayable.innerHTML = labelNetSales.value;
});

//click events inside order list
containerOrderList.addEventListener("click", function (e) {
  const selectedEdit = e.target.className;
  const prevQty = e.target.closest("tr").children[3].innerHTML;
  const prevDiscount = e.target.closest("tr").children[5].innerHTML;
  const inputTotal = e.target.closest("tr").children[6];
  const price = e.target.closest("tr").children[2].innerHTML;
  const prevTotal = e.target.closest("tr").children[6].innerHTML;
  let newQty;
  let newDiscount;
  let userInput;

  switch (selectedEdit) {
    //Edit qty order
    case "qty":
      editOrder(e, "qty");

      break;

    //Edit Discount
    case "discount":
      editOrder(e, "discount");
      break;

    // delete row
    case "delete":
      //subtract values of the deleted row form the summary details

      //subract qty
      labelTotalQty.value = +labelTotalQty.value - +prevQty;

      //subract discount
      labelDiscount.value = Number(
        +labelDiscount.value - +prevDiscount
      ).toFixed(2);

      //subract gross
      labelGrossAmount.value = Number(
        +labelGrossAmount.value - +prevQty * +price
      ).toFixed(2);

      //update summary subtotal
      labelSubtotal.value = (+labelGrossAmount.value / 1.12).toFixed(2);

      //update summary tax value
      labelTaxAmount.value = (
        +labelGrossAmount.value - +labelSubtotal.value
      ).toFixed(2);

      //update summary netsales
      labelNetSales.value = (
        +labelSubtotal.value +
        +labelTaxAmount.value -
        +labelDiscount.value
      ).toFixed(2);

      //update total payable
      labelTotalPayable.innerHTML = labelNetSales.value;

      //delete row
      e.target.closest("tr").remove();
      break;

    case "price":
      editOrder(e, "price");
      break;
  }
});

//save button
btnSaveTransaction.addEventListener("click", function (e) {
  e.preventDefault();
  e.stopPropagation();
  //customer is empty
  if (!inputCustomerId.value) {
    alert("Invalid Customer Details");
  }

  //order list is empty
  else if (!containerOrderList.children.length) {
    alert("No orders selected");
  } else {
    //add to objects
    transaction.customerId = +inputCustomerId.value;
    transaction.transactionId = +inputTransNumber.value;
    transaction.transDate = new Date().toISOString();
    order.total = +labelTotalPayable.innerHTML.replace(",", "");

    const orderRow = containerOrderList.querySelectorAll("tr");

    orderRow.forEach((element) => {
      order.productId.push(+element.children[0].innerHTML);
      order.qty.push(+element.children[3].innerHTML);
      order.discount.push(+element.children[5].innerHTML);
      order.price.push(+element.children[2].innerHTML);
    });

    const save = new XMLHttpRequest();
    const saveJSON = { ...transaction, ...order };

    save.open("POST", "php/save-transaction.php");
    save.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    save.send(`json=${JSON.stringify(saveJSON)}`);

    console.log(JSON.stringify(saveJSON));
    console.log(saveJSON);

    alert("Transaction Saved");

    location.reload();
  }
});

// --------------------- PAYMENT EVENTS / DECLARATIONS ------------------------

showPaymentData("php/pending-payments.php", "", containPendingTrans);

// Nav Options
nav.addEventListener("click", function (e) {
  const clicked = e.target;
  if (clicked.classList.contains("nav--button-pos")) {
    window.open("../index.html");
  }
});

containPendingTrans.addEventListener("click", function (e) {
  e.preventDefault();
  const clickedOpt = e.target;
  const balance = e.target.closest("tr").children[3].innerHTML;
  const orderId = e.target.closest("tr").children[0].innerHTML;
  const rowIndex = e.target.closest("tr").rowIndex - 1;

  if (clickedOpt.classList.contains("table__option--pay")) {
    orderPay(orderId, rowIndex, balance);
  }

  if (clickedOpt.classList.contains("table__option--cancel")) {
    orderCancel(orderId);
  }

  if (clickedOpt.classList.contains("table__option--view")) {
    orderView();
  }
});

paymentModalClose.addEventListener("click", function (e) {
  modalPayment.style.display = "none";
});

// Input Amount Tendered Function
inputPaymentTendered.addEventListener("keyup", function () {
  const change =
    labelPaymentBalance.value.replaceAll(",", "") -
    inputPaymentTendered.value.replaceAll(",", "");

  inputPaymentChange.value = formatNumber(change);

  if (change > 0) {
    labelChangeBalance.textContent = "New Balance:";
    payment.status = 1;
  } else {
    labelChangeBalance.textContent = "Change:";
  }
});

//clear payment tender on click
inputPaymentTendered.addEventListener("focusin", function () {
  inputPaymentTendered.value = "";

  //update change value
  labelChangeBalance.textContent = "New Balance:";
  inputPaymentChange.value = "";
});

//focus out on payment tender input
inputPaymentTendered.addEventListener("focusout", function () {
  if (inputPaymentTendered.value) {
    inputPaymentTendered.value = new Intl.NumberFormat(
      "en-US",
      NumOptions
    ).format(removeComma(inputPaymentTendered.value));
  }

  console.log(inputPaymentTendered.value);
});

//radio button event
containerPayOption.addEventListener("change", function (e) {
  switch (e.target.id) {
    case "online":
      //enable input for online payments
      console.log("online selected");
      enablePaymentGroup("online");
      disablePaymentGroup("cheque");
      payment.type = 2;
      selectOnlinePlatform.focus();
      break;
    case "cheque":
      //enable input for cheque payments
      console.log("check selected");
      disablePaymentGroup("online");
      enablePaymentGroup("cheque");
      payment.type = 3;
      selectBankName.focus();
      break;
    default:
      //disable both online and cheque inputs
      console.log("cash selected");
      disablePaymentGroup("online");
      disablePaymentGroup("cheque");
      payment.type = 1;
      inputPaymentTendered.focus();

      break;
  }
});

containerPayOption.addEventListener("mouseover", function (e) {
  if (e.target.classList.contains("label--payment-type")) {
    e.target.style.color = "blue";
  }
});

containerPayOption.addEventListener("mouseout", function (e) {
  if (e.target.classList.contains("label--payment-type")) {
    e.target.style.color = "black";
  }
});

//save Button
btnSavePayment.addEventListener("click", savePayment);
