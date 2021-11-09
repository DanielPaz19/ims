"use strict";
const buttonAddItem = document.querySelector(".button__add--item");
const containerModalAddItem = document.querySelector(".container--modal");
const modalAddItem = document.querySelector(".modal--add__item");
const buttonCloseModal = document.querySelector(".close--modal");
const containerItemList = document.querySelector(".container--itemlist");
const inputSearch = document.querySelector(".input--search");
const tableItemTb = document.querySelector(".itemTb");

const fetchTableData = (tableType, container, renderFunction, input = "") => {
  fetch(`php/search-${tableType}.php?q=${encodeURIComponent(input)}`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      renderFunction(data, container);
    })
    .catch(() => {
      container.innerHTML = "";
    });
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

const poEdit = function (e) {
  const target = e.target.closest("td").querySelector("input");
  const prevValue = target.closest("td").innerText;
  console.log(prevValue);
  console.dir(target.closest("td"));

  const changeValue = function (promptMessage) {
    let newValue = prompt(promptMessage);

    if (!newValue || newValue.includes(" ") || newValue === NaN) return;

    target.value = newValue;
    target.closest("td").childNodes[0].data = newValue;
  };

  if (!target) return;

  if (target.classList.contains("po--qty__in")) {
    changeValue("Enter New Qty-Order");
  }

  if (target.classList.contains("po--cost")) {
    changeValue("Enter New Cost");
  }

  if (target.classList.contains("po--discount")) {
    changeValue("Enter New Discount");
  }
};

const modalOpen = function (e) {
  e.preventDefault();
  containerModalAddItem.classList.add("modal--active");
  showData("../php/searchitem.php", "", containerItemList);
};

const modalClose = function () {
  containerModalAddItem.classList.remove("modal--active");
};

const searchItem = function () {
  const queue = inputSearch.value;
  showData("../php/searchitem.php", `${queue}`, containerItemList);
};

const hasDuplicate = function (productId, table) {
  const orderRow = table.querySelectorAll("tr");
  // There's no order in the table
  if (!orderRow.length) return false;

  let duplicate;
  orderRow.forEach((row) => {
    if (+row.children[0].innerHTML === productId) duplicate = true;
  });

  return duplicate;
};

// Function for selecting item and adding to table
const selectItem = function (e) {
  // Select Row
  const targetItem = e.target.closest("tr");

  // Get Values to add on Order List
  const itemCode = targetItem.querySelector(".item-code").innerHTML;
  const itemName = targetItem.querySelector(".item-name").innerHTML;
  const itemUnit = targetItem.querySelector(".unit").innerHTML;
  const itemCost = targetItem.querySelector(".cost").innerHTML;

  // Check for duplicate entries
  if (hasDuplicate(+itemCode, tableItemTb))
    return alert(`${itemName} is already added.`);

  const poQty = prompt("Enter Qty-in");
  const itemDiscPercent = 0;
  const itemDiscVal = 0;
  const totalCost = poQty * itemCost;
  const subTotal = +totalCost - +itemDiscVal;

  // Insert selected values into table
  tableItemTb.querySelector("tbody").insertAdjacentHTML(
    "beforeend",
    `<tr>
    <td class="item-code">${itemCode}</td>
    <td class="item-description">${itemName}</td>
    <td class="qty-in">${poQty}</td>
    <td class="unit">${itemUnit}</td>
    <td class="cost">${itemCost}</td> 
    <td class="total-cost">${totalCost}</td>
    <td class="discount-percent">${itemDiscPercent}</td>
    <td class="discount-value">${itemDiscVal}</td>
    <td class="discount-value">${subTotal}</td>
    <td class="delete">
    <font color="red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
    </td>
    </tr>`
  );

  // Close the modal
  modalClose();
};

const showData = function (file, input, container) {
  // Create an XMLHttpRequest object
  const xhttp = new XMLHttpRequest();

  // Define a callback function
  xhttp.addEventListener("load", function () {
    const data = JSON.parse(this.responseText);
    showTableData(data, container);
  });

  // Send a request
  xhttp.open("POST", file + `?q=${input}`);
  xhttp.send();
};

const showTableData = (data, container) => {
  container.innerHTML = "";
  console.log(data);

  data.forEach((data, index) => {
    let row = `<tr class='product-data product${index}' data-id ='${
      data.product_id
    }'>
                    <td class='item-code'>${data.product_id.padStart(8, 0)}</td>
                    <td class='item-name'>${data.product_name}</td>
                    <td class='qty'>${data.qty}</td>
                    <td class='unit'>${data.unit_name}</td>
                    <td class='location'>${data.loc_name}</td>
                    <td class='cost'>${(+data.cost).toFixed(2)}</td>
              </tr>`;
    container.innerHTML += row;
  });
};

buttonAddItem.addEventListener("click", modalOpen);

buttonCloseModal.addEventListener("click", modalClose);

inputSearch.addEventListener("keyup", searchItem);

containerItemList.addEventListener("dblclick", selectItem);

tableItemTb.querySelector("tbody").addEventListener("dblclick", poEdit);

function showadditem() {
  //set the width and height of the
  //pop up window in pixels
  var width = 1200;
  var height = 500;

  //Get the TOP coordinate by
  //getting the 50% of the screen height minus
  //the 50% of the pop up window height
  var top = parseInt(screen.availHeight / 2 - height / 2);

  //Get the LEFT coordinate by
  //getting the 50% of the screen width minus
  //the 50% of the pop up window width
  var left = parseInt(screen.availWidth / 2 - width / 2);

  //Open the window with the
  //file to show on the pop up window
  //title of the pop up
  //and other parameter where we will use the
  //values of the variables above
  window.open(
    "../edit/item_edit_addnew.php",
    "Contact The Code Ninja",
    "menubar=no,resizable=yes,width=1300,height=600,scrollbars=yes,left=" +
      left +
      ",top=" +
      top +
      ",screenX=" +
      left +
      ",screenY=" +
      top
  );
}
