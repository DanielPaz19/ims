import formatNumber from './helpers.js';

function getTotalQty() {
  const inputQty = document.querySelectorAll('.input--qty');

  const qtyArr = [];

  inputQty.forEach((el) => {
    qtyArr.push(el.closest('tr').querySelector('.input--qty').value);
  });

  const totalQty = qtyArr
    .map((subtotal) => Number(subtotal.replace(',', '')))
    .reduce((prev, curr) => prev + curr);

  return totalQty;
}

function updateSummary(grandTotal) {
  const lblSummSubTotal = document.querySelector('.input__summary--subtotal');
  const lblSummTax = document.querySelector('.input__summary--tax');
  const lblSummNetSales = document.querySelector('.input__summary--netsales');
  const lblSummTotalQty = document.querySelector('.input__summary--qty');
  const lblSummGross = document.querySelector('.input__summary--gross');

  lblSummSubTotal.value = formatNumber(grandTotal);
  lblSummGross.value = formatNumber(grandTotal);

  const tax = (grandTotal / 1.12) * 0.12;
  lblSummTax.value = formatNumber(tax);

  lblSummNetSales.value = formatNumber(grandTotal - tax);

  lblSummTotalQty.value = formatNumber(getTotalQty());
}

function updateGrandTotal() {
  const inputQty = document.querySelectorAll('.input--qty');
  const lblGrandTotal = document.querySelector('.label--grand__total');
  const total = [];

  inputQty.forEach((el) => {
    total.push(el.closest('tr').querySelector('.label--subtotal').innerText);
  });

  const grandTotal = total
    .map((subtotal) => Number(subtotal.replace(',', '')))
    .reduce((prev, curr) => prev + curr);

  lblGrandTotal.innerText = '₱ ' + formatNumber(grandTotal);

  return grandTotal;
}

function updateRowSubtotal(target) {
  const lblUnitPrice = target.closest('tr').querySelector('.label--price');
  const lblSubTotal = target.closest('tr').querySelector('.label--subtotal');
  const inputQty = target.closest('tr').querySelector('.input--qty');

  const newValue =
    Number(lblUnitPrice.innerText.replace(',', '')) * Number(inputQty.value);

  lblSubTotal.innerText = formatNumber(newValue);
}

function update(target) {
  updateRowSubtotal(target);
  const grandTotal = updateGrandTotal();
  updateSummary(grandTotal);
}

function editQty(e) {
  const target = e.target;
  const newValue = Math.round(target.value);
  if (Number(newValue) > Number(target.max)) {
    target.value = target.max;
    update(target);
    return alert(`You can't input number higher than ${target.max}`);
  }

  if (Number(newValue) < Number(target.min)) {
    target.value = target.min;
    update(target);
    return alert(`You can't input number lower than ${target.min}`);
  }

  target.value = newValue;

  update(target);
}

function init() {
  const inputQty = document.querySelectorAll('.input--qty');
  inputQty.forEach((element) => {
    element.addEventListener('change', editQty);
  });
}

init();
