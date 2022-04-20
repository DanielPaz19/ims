<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Supplier: Adding Records <i class="bi bi-pencil-fill"></i></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form autocomplete="off" method="POST" class="form-inline" action="main/addrecord/sup_add.php">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_name">
            <label for="floatingInput"><i class="bi bi-people-fill"></i> Supplier Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_conper">
            <label for="floatingInput"><i class="bi bi-person-rolodex"></i> Contact Person</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_tel">
            <label for="floatingInput"><i class="bi bi-telephone-fill"></i> Telephone</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="sup_address">
            <label for="floatingInput"><i class="bi bi-geo-alt-fill"></i> Address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="sup_email">
            <label for="floatingInput"><i class="bi bi-envelope-paper-fill"></i> Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingInput" name="sup_tin">
            <label for="floatingInput"> TIN No.</label>
          </div>
          <button type="submit" class="btn btn-success" name="add_sup">Save Record</button>
        </form>
      </div>

    </div>

  </div>
</div>