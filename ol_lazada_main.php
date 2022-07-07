<?php
$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
$query = "SELECT ol_tb.ol_id, ol_tb.ol_title, ol_type.ol_type_id, ol_type.ol_type_name, ol_tb.ol_date, ol_tb.closed, user.user_name, ol_tb.ol_si
FROM ol_tb
LEFT JOIN ol_type ON ol_type.ol_type_id = ol_tb.ol_type_id
LEFT JOIN user ON user.user_id = ol_tb.user_id
WHERE ol_tb.ol_type_id = 1 
";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>OL Lazada</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    <link rel="stylesheet" href="css/ol_style.css" />
    <style>
        input:checked+label {
            color: #555;
            border: 1px solid #ddd;
            border-top: 3px solid #443DFE;
            border-bottom: 1px solid #fff;
            background-color: white;
        }
    </style>
</head>

<body>
    <main style="background-color: aliceblue;">
        <!-- tabs -->
        <input id="" type="radio" name="tabs">
        <label for="tab1"><a href="ol_shopee_main.php"><img src="img/shopee.png"></a></label>

        <input id="tab2" type="radio" name="tabs" checked>
        <label for="tab2"><a href="ol_lazada_main.php"><img src="img/lazada.png"></a></label>

        <!-- tab content -->
        <section id="content2" style=" padding:2%;border: 1px solid #ddd;background-color:white;height:auto;box-shadow: 5px 5px 5px #aaaaaa;">
            <a href="itemlist_main.php" style="float: right;text-decoration:none;color:#443DFE;font-weight:bold"> <i class="bi bi-chevron-left"></i>&emsp;Back to Itemlist</a>
            <div class="row">
                <div class="col">
                    <h3 style="color: #443DFE;"> <span class="lazada">Lazada Income Statement Records</span> </h3>
                </div>
                <div class="col"><button class="btn btn-sm" style="float: right;background-color:#443DFE;color:white" onclick="showaddOl()">+ Add New Records</button></div>
            </div>


            <div class="table-responsive">

                <table id="data" class="table table-striped table-bordered" data-order='[[ 0, "desc" ]]'>
                    <thead style="background-color:#443DFE">
                        <tr style="color: white;">
                            <th>OL ID</th>
                            <th>Statement</th>
                            <th>SI No.</th>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Created By</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $dateString = $row['ol_date'];
                        $dateTimeObj = date_create($dateString);
                        $date = date_format($dateTimeObj, 'm/d/y');
                        $closed = $row["closed"];
                        if ($closed == 0) {
                            $str = '<p style="color:#5cb85c;font-weight:bold"><i class="bi bi-circle-fill"></i> ACTIVE</p>';
                            $disable = ' 
                
                                <a href="../ims/ol_edit-page.php?editOl&id=' . $row["ol_id"] . '" disabled> <button class="btn btn-success btn-sm" title="Edit"><i class="bi bi-pencil-fill"></i></button></a>
                
                
                               
                     
                                <a href="commit/ol_commit.php?id=' . $row["ol_id"] . '">
                                    <button class="btn btn-primary btn-sm" title="Commit Record"><i class="bi bi-check2-circle"></i></button></a>
                
                
                                    <a href="#" onclick="confirmAction()"><font color="red"><button class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash3-fill"></i></button></a>
                    ';
                        } else {
                            $str = '<p style="color:#d9534f;font-weight:bold"><i class="bi bi-circle-fill"></i> CLOSE</p>';
                            $disable = '
                            <button class="btn btn-sm" title="Edit" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-sm" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-check2-circle"></i></button>
                             <button class="btn btn-sm" title="Delete" style="cursor:not-allowed;background-color:lightgrey"><i class="bi bi-trash3-fill"></i></button>';
                        }
                        echo '  
                               <tr>  
                                    <td align="center">' . str_pad($row["ol_id"], 8, 0, STR_PAD_LEFT) . '</td>  
                                    <td align="center">' . $row["ol_title"] . '</td>  
                                    <td align="center">' . $row["ol_si"] . '</td>  
                                    <td align="center">' . $date . '</td>  
                                    <td align="center">' . $disable . '
                                    <a href="view/viewsi_2.php?id=' . $row["ol_id"] . '"><button class="btn btn-info btn-sm" title="Details" style="color:white"><i class="bi bi-printer-fill"></i></button></a>
                                    </td>  
                                    <td align="center">' . $row["user_name"] . '</td>  
                                    <td align="center">' . $str . '</td>  


                               </tr>  
                               ';
                    }
                    ?>
                </table>
            </div>

        </section>
    </main>

    <div class="container py-5" style="background-color: white;">

    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>

<script type='text/javascript'>
    function showaddOl() {
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
        window.open('main/addrecord/addol.php',
            "Contact The Code Ninja",
            "menubar=no,resizable=yes,width=1800,height=600,scrollbars=yes,left=" +
            left + ",top=" + top + ",screenX=" + left + ",screenY=" + top);
    }
</script>