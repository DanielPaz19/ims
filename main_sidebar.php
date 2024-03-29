<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: hidden;
    }

    ul:hover {
        overflow: visible;
    }

    li {
        position: relative;
        float: left;
        /* background-color: #17B0FF; */
    }

    li:hover {
        /* background-color: #189BDF; */
    }

    /* a {
        display: block;
        padding: 10px 20px;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
    } */

    /* second level */

    ul li:hover ul {
        max-height: 999px;
    }

    ul ul li {
        float: none;
        /* background-color: #189BDF; */
    }

    ul ul li:hover {
        /* background-color: #1289C7; */
    }

    /* third level */
    ul ul ul {
        position: absolute;
        width: 0;
        top: 0;
        left: 100%;
        transition: width 0.5s;
    }

    ul ul li:hover ul {
        width: 100%;
    }

    ul ul ul li {
        background-color: white;
        padding: 1%;

        /* border: 1px solid gray; */
    }

    ul ul ul li:hover {
        /* background-color: lightgrey; */
        cursor: pointer;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #3333cc;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="img/navbar_logo.png" alt="" style="height: 25px;"> PACC IMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-house-door"></i> Home&emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="jo_main.php"><i class="bi bi-archive"></i> Job-Order&emsp;</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-box-seam"></i>&nbsp;Inventory
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="itemlist_main.php"><i class="bi bi-boxes"></i>&nbsp;ItemList</a></li>
                        <li><a class="dropdown-item" href="stin_main.php"><i class="bi bi-box-arrow-in-down"></i>&nbsp;Stock-Inventory-IN</a></li>
                        <li><a class="dropdown-item" href="stout_main.php"><i class="bi bi-box-arrow-up"></i>&nbsp;Stock-Inventory-OUT</a></li>
                        <li><a class="dropdown-item" href="ep_main.php"><i class="bi bi-box-arrow-left"></i>&nbsp;Exit-Pass</a></li>
                        <li><a class="dropdown-item" href="po_main.php"><i class="bi bi-bag"></i>&nbsp;Purchase Order</a></li>
                        <li><a class="dropdown-item" href="pinv_main2.php"><i class="bi bi-person-workspace"></i>&nbsp;Physical Inventory</a></li>
                        <li><a class="dropdown-item" href="rt_main.php"><i class="bi bi-box-arrow-right"></i>&nbsp;Return Slip</a></li>
                        <li><a class="dropdown-item" href="ol_shopee_main.php"><i class="bi bi-box-arrow-right"></i>&nbsp;Online Transaction</a></li>
                    </ul>
                </li>
                &emsp;
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-gear"></i>&nbsp;Utilities</a>
                    <ul class="dropdown-menu">
                        <a href="pos-utilities.php" class="dropdown-item"><i class="bi bi-caret-right"></i> Reciepts</a>
                        <a href="ol-utilities.php" class="dropdown-item"><i class="bi bi-caret-right"></i> Online Transactions</a>
                        <a href="sup_main.php" class="dropdown-item"><i class="fas fa-people-arrows"></i><i class="bi bi-caret-right"></i> Supplier</a>
                        <a href="#" class="dropdown-item" onclick="showPayments()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Payment Type</a>
                        <a href="#" class="dropdown-item" onclick="showBank()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Bank</a>
                        <a href="#" class="dropdown-item" onclick="showCustomer()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Customer</a>
                        <a href="#" class="dropdown-item" onclick="showClass()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Class</a>
                        <a href="#" class="dropdown-item" onclick="showDept()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Department</a>
                        <a href="#" class="dropdown-item" onclick="showUnit()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Unit</a>
                        <a href="#" class="dropdown-item" onclick="showLocation()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Location</a>
                        <a href="#" class="dropdown-item" onclick="showEmployee()"><i class="fa fa-plus-circle"></i><i class="bi bi-caret-right"></i>&nbsp;Employee</a>

                    </ul>
                </li>&emsp;
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"><i class="bi bi-journals"></i>&nbsp;Reports</a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="#"><i class="bi bi-list"></i>&nbsp;Inventory </a>
                            <ul>
                                <li><a class="dropdown-item" href="inv_report.php?dept_id=23"><i class="bi bi-caret-right"></i> Detailed</a></li>
                                <li><a class="dropdown-item" href="inv_report_summary.php?dept_id=23&date1=&date2="><i class="bi bi-caret-right"></i> Summary Dated</a></li>
                                <!-- <li><a href="#" type="button" class="dropdown-item" role="button" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="And here's some amazing content. It's very engaging. Right?" title="asdjaslkdjsa"><i class="bi bi-caret-right"></i> Dated</a></li> -->

                            </ul>
                            <script>
                                var popoverList1 = [].slice.call(document.querySelectorAll('[data-bs-toggle = "popover"]'))
                                var popoverList2 = popoverList1.map(function(popoverTriggerfun) {
                                    return new bootstrap.Popover(popoverTriggerfun)
                                })
                            </script>
                        </li>
                        <!-- <li> <a class="dropdown-item" href="pos_report.php"><i class="bi bi-caret-right"></i>&nbsp;POS</a></li> -->
                        <li> <a class="dropdown-item" href="#" onclick="showJoReport()"><i class="bi bi-caret-right"></i>&nbsp;Job-Order</a></li>
                        <li> <a class="dropdown-item" href="#" onclick="showStinReport()"><i class="bi bi-caret-right"></i>&nbsp;Stock-In </a></li>
                        <!-- <li> <a class="dropdown-item" href="ton_prcg_report.php"><i class="bi bi-caret-right"></i>&nbsp;Stock-In-PRCG (Detailed) </a></li>
                        <li> <a class="dropdown-item" href="ton_prcg_report_summary.php"><i class="bi bi-caret-right"></i>&nbsp;Stock-In-PRCG (Summary) </a></li> -->
                        <li> <a class="dropdown-item" href="#"><i class="bi bi-caret-right"></i>&nbsp;Stock-Out </a></li>
                        <li> <a class="dropdown-item" href="#" onclick="showSrr()"><i class="bi bi-caret-right"></i>&nbsp;Purchase Order</a></li>
                        <li> <a class="dropdown-item" href="pinv_report.php"><i class="bi bi-caret-right"></i>&nbsp;PINV</a></li>
                        <li> <a class="dropdown-item" href="report/sales-report.php?date1=&date2="><i class="bi bi-caret-right"></i>&nbsp;Sales Report</a></li>
                    </ul>
                </li>&emsp;

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Others</a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="pivdr_main.php"><i class="bi bi-caret-right"></i>&nbsp;PIVDR</a></li>
                        <li> <a class="dropdown-item" href="item_location_gen.php"><i class="bi bi-caret-right"></i>&nbsp;Item Location Generator</a></li>

                    </ul>
                </li>


            </ul>
            <div class="pull-right">
                <a class="nav-link dropdown" href="php/logout-inc.php" role="button" style="color: white;"><i class="bi bi-person-circle"></i>&nbsp; <?php echo $_SESSION["empName"]; ?></a>
            </div>


        </div>


    </div>
</nav>