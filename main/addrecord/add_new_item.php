<form method="GET" autocomplete="off" action="add_item_con.php">
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="product_name" required>
                <label for="floatingInput">Item Description</label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" name="qty" onchange="setDecimal" min="0" max="9999999999" step="0.0000001" required>
                    <label for="floatingInput">Quantity</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="unit_id" required>
                        <option></option>
                        <?php
                        $records = mysqli_query($db, "SELECT * FROM unit_tb");
                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['unit_id'] . "'>" . $data['unit_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Unit</label>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="product_type_id" required>
                        <option></option>
                        <?php
                        include "config.php";
                        $records = mysqli_query($db, "SELECT * FROM product_type ORDER BY product_type_id ASC");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['product_type_id'] . "'>" . $data['product_type_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Product Type</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="barcode">
                    <label for="floatingInput">Barcode</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="class_id" required>
                        <option></option>
                        <?php

                        $records = mysqli_query($db, "SELECT * FROM class_tb");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['class_id'] . "'>" . $data['class_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Class</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dept_id" required>
                        <option></option>
                        <?php

                        $records = mysqli_query($db, "SELECT * FROM dept_tb");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['dept_id'] . "'>" . $data['dept_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Department</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-floating">
                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="loc_id" required>
                        <option></option>
                        <?php
                        $records = mysqli_query($db, "SELECT * FROM loc_tb");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Location</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea" name="pro_remarks"></textarea>
                    <label for="floatingTextarea">Remarks</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" name="price" required>
                    <label for="floatingInput">Price </label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingInput" name="cost" required>
                    <label for="floatingInput">Cost</label>
                </div>
            </div>
        </div>
    </div>


    <div class="pull-right">
        <button type="submit" class="btn btn-success" name="add">Save Item</button>
    </div>
</form>



</div>
</body>

</html>