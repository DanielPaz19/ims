"use strict";

window.addEventListener("load", function () {
  window.print();
});

window.addEventListener("afterprint", function () {
  window.close();
});
