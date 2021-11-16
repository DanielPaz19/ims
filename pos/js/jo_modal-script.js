"use strict";

const inputJoSearch = document.querySelector(".jo__modal--input__search");
const tblJoModal = document.querySelector(".jo__modal--table");
const joModalClose = document.querySelector(".jo__modal--close");
const joModal = document.querySelector(".jo__modal");

// Render data on JO table when Searched
const renderJoTable = function (data, tbody) {
  tbody.innerHTML = "";
  data.forEach((data) => {
    tbody.insertAdjacentHTML(
      "beforeend",
      `<tr>
    <td class='jo__modal--td__jonumber'>${data.jo_no}</td>
    <td>${data.customers_name}</td>
    <td></td>
    <td>${data.jo_date}</td>
    </tr>`
    );
  });
};

// Get data from PHP file
const searchJo = function () {
  const joSearch = this.value;
  console.log(joSearch);

  fetch("php/jo-search.php", {
    method: "POST", // or 'PUT'
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `joSearch=${joSearch}`,
  })
    .then((res) => {
      // console.log(res.text());
      return res.json();
    })
    .then((data) => {
      renderJoTable(data, tblJoModal.querySelector("tbody"));
    });
};

// Remove active modal
const closeJoModal = function () {
  joModal.classList.remove("jo__modal--active");
};

// Select Jo number
const selectJo = function (e) {
  const targetRow = e.target.closest("tr");
  const targetJoNumber = targetRow.querySelector(".jo__modal--td__jonumber");

  // Fetch customer details
  fetch(`php/jo_modal-inc.php?selectCustomer&joNo=${targetJoNumber.innerHTML}`)
    .then((res) => res.json())
    .then((data) => {
      // Put data on Customer Details
      const [customerData] = data;
      console.log(customerData.jo_id);

      // Render customer details
      inputCustomerId.value = customerData.customers_id.padStart(8, 0);
      inputCustomerName.value = customerData.customers_name.toUpperCase();
      inputCustomerAddress.value = customerData.customers_address;
      inputCustomerContact.value = customerData.customers_contact;

      // Fetch Order details
      return fetch(
        `php/jo_modal-inc.php?selectOrders&joNo=${targetJoNumber.innerHTML}&joId=${customerData.jo_id}`
      );
    })
    .then((res) => res.json())
    .then((data) => {
      data.forEach((product) => {
        console.log(product.jo_no);
        containerOrderList.insertAdjacentHTML(
          "beforeend",
          `<tr>
          <td class="item-code">${product.product_id.padStart(8, 0)}</td>
          <td class="item-description">${product.product_name}</td>
          <td class="price">${formatNumber(product.jo_product_price)}</td>
          <td class="qty">${product.jo_product_qty}</td>
          <td class="unit">${product.unit_name}</td>
          <td class="discount">0.00</td>
          <td class="total">${formatNumber(
            product.jo_product_qty * product.jo_product_price
          )}</td>
          <td class="delete">X</td>
        </tr>`
        );
      });
    });

  closeJoModal();
};

// Search Event
inputJoSearch.addEventListener("keyup", searchJo.bind(inputJoSearch));
// Close modal event
joModalClose.addEventListener("click", closeJoModal);
// Event for Selecting JO
tblJoModal.addEventListener("dblclick", selectJo);
