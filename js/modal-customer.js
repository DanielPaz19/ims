"user strict";

const selectedCustomer = {};

const buttonShowModal = document.querySelector(".button__show--modal");
const modalCustomer = document.querySelector(".modal--customer");
const modalContent = document.querySelector(".modal__content--customer");
const modalButtonClose = document.querySelector(".modal__button__close");
const modalTableContainer = document.querySelector(".modal__table__container");
const modalInputSearch = document.querySelector(
  ".modal__input__search--customer"
);
const tableItemTb = document.querySelector(".itemTb");
const modalTbody = document.querySelector(".modal__tbody--customer");
const modalTrigger = document.querySelector(".modal__trigger--customer");
const nextTab = document.querySelector(".next__tab");

// const hasDuplicateOrder = function (productId) {
//   console.log(productId);
//   const orderRow = tableItemTb
//     .querySelector("tbody")
//     .querySelectorAll(".stin--product__id");
//   // There's no order in the table
//   if (!orderRow.length) return false;

//   let duplicate;
//   orderRow.forEach((row) => {
//     if (+row.value === productId) duplicate = true;

//   return duplicate;
// };
//   });

// const stinEdit = function (e) {
//   const target = e.target.closest("td").children[0];
//   const prevValue = target.closest("td").childNodes[0].textContent;

//   console.log(prevValue);

//   const changeValue = function (promptMessage) {
//     let newValue = prompt(promptMessage);

//     if (!newValue || newValue.includes(" ")) return;

//     target.closest("td").childNodes[0].textContent = newValue;
//     target.value = newValue;
//   };

//   if (!target) return;

//   if (target.classList.contains("stin--qty__in")) {
//     changeValue("Enter New Qty-In");
//   }

//   if (target.classList.contains("stin--cost")) {
//     changeValue("Enter New Cost");
//   }
//   if (target.classList.contains("stin--discount")) {
//     changeValue("Enter New Discount");
//   }
// };

const setCustId = function (className) {
  const container = document.querySelector(className);
  if (!container) return;

  container.value = selectedCustomer.id;
};

const cancelSelection = function () {
  modalCustomer.classList.toggle("modal--active");

  nextTab.focus();
};

const modalOpen = function (e) {
  e.preventDefault();
  modalInputSearch.focus();
  modalCustomer.classList.toggle("modal--active");
  showData("php/searchcustomer.php", modalTbody);
};

const modalClose = function (e) {
  modalCustomer.classList.toggle("modal--active");

  const selectedRow = document.querySelector(".selected--customer");

  selectedCustomer.id = +selectedRow.children[0].textContent;
  selectedCustomer.name = selectedRow.children[1].textContent;

  if (modalTrigger.nodeName === "INPUT" && modalTrigger.type === "text") {
    modalTrigger.value = selectedCustomer.name;
  }

  // modalTrigger.insertAdjacentHTML(
  //   "afterend",
  //   `<input type='hidden' value='${selectedCustomer.id}' name='sup_id'>`
  // );

  setCustId(".container--customer__id");

  nextTab.focus();
};

const searchItem = function () {
  const queue = modalInputSearch.value;
  showData("php/searchcustomer.php", `${queue}`, modalTbody);
};

const selectItem = function (e) {
  // Remove selected--customer class

  const selected = document.querySelectorAll(".selected--customer");

  if (!e.target.closest("tr")) return;
  selected.forEach((row) => row.classList.remove("selected--customer"));
  e.target.closest("tr").classList.add("selected--customer");

  // const selectedId = e.target.closest("tr").dataset.id;
  // const selectedName = e.target
  //   .closest("tr")
  //   .querySelector(".item-name").innerHTML;
  // const selectedQty = e.target.closest("tr").querySelector(".qty").innerHTML;
  // const qtyIn = prompt("Enter Qty-in:");
  // const selectedUnit = e.target.closest("tr").querySelector(".unit").innerHTML;
  // const selectedCost = prompt("Enter Cost Amount:");
  // const selectedDiscount = prompt("Enter Discount Amount:");
  // const incomingQty = +selectedQty + +qtyIn;

  // if (hasDuplicateOrder(+selectedId))
  //   return alert(`${selectedName} is already added.`);

  // modalClose();

  // tableItemTb.querySelector("tbody").insertAdjacentHTML(
  //   "beforeend",
  //   `<tr>
  //     <td>${selectedId}<input type="hidden" name="productId[]" value="${selectedId}" class='stin--product__id'></td>
  //     <td>${selectedName}</td>
  //     <td>${selectedQty}</td>
  //     <td>${qtyIn}<input type="hidden" name="stinTempQty[]" value="${qtyIn}" class='stin--qty__in'></td>
  //     <td>${selectedUnit}</td>
  //     <td>${selectedCost}<input type="hidden" name="cost[]" value="${selectedCost}" class='stin--cost'></td>
  //     <td>${selectedDiscount}<input type="hidden" name="discount[]" value="${selectedDiscount}" class='stin--discount'></td>
  //     <td>${incomingQty}<input type="hidden" name="incomingQty[]" value="${incomingQty}" class='stin--incoming__qty'></td>
  //     <td><center><a href="item_delete/stin_item_delete.php?stinProdId=<?php echo $irow["stin_product_id"] ?>" title="Remove">
  //                       <font color=" red"><i class="fa fa-trash-o" style="font-size:24px"></i></font>
  //                     </a></center></td>
  //     </tr>
  //     `
  // );
};

const showData = (file, container, input = "") => {
  fetch(file + `?q${input}`)
    .then((response) => response.json())
    .then((data) => {
      container.innerHTML = "";

      data.forEach((data) => {
        let row = `<tr class=customer-row data-id ='${data.sup_id}'>
                            <td class='item-code'>${data.sup_id.padStart(
                              8,
                              0
                            )}</td>
                            <td class='item-name'>${data.sup_name}</td>
                            <td class='qty'>${data.sup_conper}</td>
                            <td class='unit'>${data.sup_tel}</td>
                            <td class='location'>${data.sup_address}</td>
                            <td class='cost'>${data.sup_email}</td>
                            <td class='cost'>${data.sup_tin}</td>
                      </tr>`;
        container.innerHTML += row;
      });
    });
  //   // Create an XMLHttpRequest object
  //   const xhttp = new XMLHttpRequest();
  //   // Define a callback function
  //   xhttp.addEventListener("load", function () {
  //     const data = JSON.parse(this.responseText);
  //     showTableData(data, container);
  //   });
  //   // Send a request
  //   xhttp.open("POST", file + `?q=${input}`);
  //   xhttp.send();
  // };
  // const showTableData = (data, container) => {
  //   container.innerHTML = "";
  //   data.forEach((data, index) => {
  //     let row = `<tr class=customer-row data-id ='${data.sup_id}'>
  //                           <td class='item-code'>${data.sup_id.padStart(
  //                             8,
  //                             0
  //                           )}</td>
  //                           <td class='item-name'>${data.sup_name}</td>
  //                           <td class='qty'>${data.sup_conper}</td>
  //                           <td class='unit'>${data.sup_tel}</td>
  //                           <td class='location'>${data.sup_address}</td>
  //                           <td class='cost'>${data.sup_email}</td>
  //                           <td class='cost'>${data.sup_tin}</td>
  //                     </tr>`;
  //     container.innerHTML += row;
  //   });
};

// buttonShowModal.addEventListener("click", modalOpen);

modalButtonClose.addEventListener("click", cancelSelection);

modalInputSearch.addEventListener("keyup", searchItem);

modalCustomer.addEventListener("click", selectItem);

// modalTableContainer
//   .querySelector("tbody")
//   .addEventListener("dblclick", stinEdit);

modalTrigger.addEventListener("focus", modalOpen);

document.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    e.preventDefault();
    modalClose();
  }
});
