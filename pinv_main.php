<?php include('header.php');

if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>
<?php include('php/config.php'); ?>
<link rel="stylesheet" href="css/pinv-style.css" media="print">
<link rel="stylesheet" href="css/pinv-style.css">
<script>
    function printDiv() {
        var divContents = document.getElementById("print-area").innerHTML;
        var a = window.open('', '', 'height=1000, width=1300');
        a.document.write(divContents);
        a.document.close();
        a.print();
    }
</script>


<center>
    <form method="POST">
        <div class="form-inline">
            <label>Choose Location:</label>
            <select name="loc_id">
                <option>-- Select Location --</option>
                <?php
                include "php/config.php";
                $records = mysqli_query($db, "SELECT * FROM loc_tb");

                while ($data = mysqli_fetch_array($records)) {
                    echo "<option value='" . $data['loc_id'] . "'>" . $data['loc_name'] . "</option>";
                }
                ?>
            </select> <br> <br>
            <button name="filter">Generate</button> &nbsp;
            <button name="reset">Reset</button>&nbsp;
            <br>
    </form> <br>
    <button style="width: 50%;" class="noprint" onclick="window.print()">Print</button> <br>
    </div>

    <br />

    <page id="print" size="A4">
        <div class="itemlist">
            <label style="float: left;"> Location :</label>&nbsp;<input type="text" placeholder="Type Location Here..." style="float: left;" class="typo">&nbsp;&nbsp; <input type="text" placeholder="Type Location Here..." style="float: right;" class="typo">"><label style="float: right;">Date :</label> <br /> <br />
            <table class="pinv-tb" id="table-id">
                <thead>
                    <th style="width: 10%;">Product ID</th>
                    <th style="width: 40%;">Name</th>
                    <th style="width: 10%;">On-Hand</th>
                    <th style="width: 10%;">Unit</th>
                    <th style="width: 10%;">Location</th>
                    <th style="width: 10%;">Stock No.</th>
                    <th style="width: 5%;">PhyQty</th>
                </thead>
                <thead>
                    <?php include 'pinv_filter.php' ?>
                </thead>
            </table>
    </page>
    </div>