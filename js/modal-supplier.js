"user strict";
const buttonShowModal = document.querySelector(".button__show--modal");
const modalSupplier = document.querySelector(".modal--supplier");
const modalContent = document.querySelector(".modal__content--supplier");
const modalButtonClose = document.querySelector(".modal__button__close");
const modalTableContainer = document.querySelector(".modal__table__container");
const modalInputSearch = document.querySelector(
  ".modal__input__search--supplier"
);
const tableItemTb = document.querySelector(".itemTb");
const modalTbody = document.querySelector(".modal__tbody--supplier");

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
//   });

//   return duplicate;
// };

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

const modalOpen = function (e) {
  e.preventDefault();
  modalInputSearch.focus();
  modalSupplier.classList.toggle("modal--active");
  showData("php/searchsupplier.php", "", modalTbody);
};

const modalClose = function (e) {
  modalSupplier.classList.toggle("modal--active");
};

const searchItem = function () {
  const queue = modalInputSearch.value;
  showData("php/searchsupplier.php", `${queue}`, modalTbody);
};

const selectItem = function (e) {
  e.target.closest("tr").classList.add("selected--supplier");
  console.log(e.target.closest("tr"));
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

const showData = function (file, input, container) {
  // Create an XMLHttpRequest object
  const xhttp = new XMLHttpRequest();

  // Define a callback function
  xhttp.addEventListener("load", function () {
    const data = JSON.parse(this.responseText);
    console.log(data);
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
    let row = `<tr class=supplier-row data-id ='${data.sup_id}'>
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
};

// buttonShowModal.addEventListener("click", modalOpen);

modalButtonClose.addEventListener("click", modalClose);

modalInputSearch.addEventListener("keyup", searchItem);

modalSupplier.addEventListener("click", selectItem);

modalTableContainer
  .querySelector("tbody")
  .addEventListener("dblclick", stinEdit);
