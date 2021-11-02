<link rel="stylesheet" href="css/modal-supplier.css">

<button class="button__show--modal">Show Modal</button>

<div class="modal--supplier">
  <div class='modal__content--supplier'>

    <a href=""><button class="modal__button__add--supplier">Add Supplier</button></a>

    <input type="text" class='modal__input__search--supplier' placeholder="Search Item..."><br>
    <span class='modal__button__close' style="float: right;"'><i class="fa fa-close"></i></span>
    <div class="modal__table__container">
      <table class="modal__table--supplier">
        <thead>
          <tr>
            <th>Supplier ID</th>
            <th>Name</th>
            <th>Contact Person</th>
            <th>Contact Number</th>
            <th>Address</th>
            <th>E-mail</th>
            <th>TIN</th>
            
          </tr>
        </thead>
        <tbody class="modal__tbody--supplier">
          <tr>
            <td>000001</td>
            <td>PHLIPPINE ACRYLIC AND CHEMICAL CORP.</td>
            <td>Dave</td>
            <td>09123456567</td>
            <td>635 Mercedes Ave, Pasig City</td>
            <td>pacchemco@gmail.com</td>
            <td>111-111-111-111</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="js/modal-supplier.js"></script>