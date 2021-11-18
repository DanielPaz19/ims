<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    p {
        font-size: 13px;
    }

    .top {
        padding: 2px;
    }

    table {
        padding: 2px;
    }
</style>

<title>SRR GENERATE REPORT</title>

<body bgcolor="
#E8E7E7
">
    <div class="top">
        <table>
            <tr>
                <td><i class="fa fa-search" style="font-size: 20px;"></i></td>
                <td></td>
                <td>
                    <p>You can choose which data to include (or exclude) from this report by creating filter for the fields below. </p>
                </td>
            </tr>
        </table>
        <hr>
        <br><br>
        <table>
            <tr>
                <td>
                    <p> From Date:</p>
                </td>
                <td></td>
                <td></td>
                <td><input type="date" name="date1"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p>To Date :</p>
                </td>
                <td></td>
                <td></td>
                <td><input type="date" name="date2"></td>
            </tr>
        </table>
        <br><br><br>

        <table style="width: 100%;">
            <tr>
                <td style="width: 40%;"></td>
                <td></td>
                <td><button style="height: 35px; cursor:pointer" onclick="showSrr(); ">
                        <i class="fa fa-search"></i> &nbsp;Preview Report</button></td>
                <td><button style="height: 35px; cursor:pointer"><i class="fa fa-close"></i> &nbsp; Close</button></td>
            </tr>
        </table>


    </div>


</body>

<script type='text/javascript'>
    function showSrr() {
        //set the width and height of the 
        //pop up window in pixels
        var width = 500;
        var height = 500;

        //Get the TOP coordinate by
        //getting the 50% of the screen height minus
        //the 50% of the pop up window height
        var top = parseInt((screen.availHeight / 2) - (height / 2));

        //Get the LEFT coordinate by
        //getting the 50% of the screen width minus
        //the 50% of the pop up window width
        var left = parseInt((screen.availWidth / 2) - (width / 2));

        //Open the window with the 
        //file to show on the pop up window
        //title of the pop up
        //and other parameter where we will use the
        //values of the variables above

        window.open('srr.php',
            "Contact The Code Ninja",
            "menubar=no,resizable=yes,width=800,height=600,scrollbars=yes,left=" +
            left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);


    }
</script> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->
</head>

<body>

    <div class="col-md-3"></div>
    <div class="col-md-6 well">


        <hr style="border-top:1px dotted #000;" />
        <form class="form-inline" method="POST" action="">
            <label>Date:</label>
            <input type="date" class="form-control" placeholder="Start" name="date1" />
            <label>To</label>
            <input type="date" class="form-control" placeholder="End" name="date2" />
            <button class="btn btn-primary" name="search"><span class="fa fa-search"></span>Search </button>
        </form>
        <a href="srr_select.php" type="button" class="btn btn-success"><span class="fa fa-refresh"></span></a>
        <br /><br />
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="alert-info">
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Ref. No.</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'srr.php' ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>