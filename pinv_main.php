<?php include('header.php');

if (!isset($_SESSION['user'])) {
    header("location: login-page.php");
}

?>
<?php include('php/config.php'); ?>
<link rel="stylesheet" href="css/pinv-style.css" media="print">
<link rel="stylesheet" href="css/pinv-style.css">


<center>
    <form method="POST">
        <div class="form-inline">
            <center>
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
                <button>Print</button> <br> <br> <br>

                <label>Number of display row :</label>
                <select class="form-control" name="state" id="maxRows">
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="70">70</option>
                    <option value="100">100</option>
                </select>
                <br>
                <nav>
                    <ul class="pagination">

                        <li data-page="prev">
                            <span>
                                Prev <span class="sr-only">(current)
                                </span></span>
                        </li>
                        <!--	Here the JS Function Will Add the Rows -->
                        <li data-page="next" id="prev">
                            <span> Next <span class="sr-only">(current)</span></span>
                        </li>
                    </ul>
                </nav>
        </div>
    </form>
</center>
<br />

<page id="print" size="A4">
    <div class="itemlist">

        <table class="pinv-tb" id="table-id">
            <thead>
                <th style="width: 10%;">Product ID</th>
                <th style="width: 40%;">Name</th>
                <th style="width: 10%;">Qty-On-Hand</th>
                <th style="width: 10%;">Unit</th>
                <th style="width: 10%;">Location</th>
                <th style="width: 5%;">Phy-Qty</th>
            </thead>
            <thead>
                <?php include 'pinv_filter.php' ?>
            </thead>
        </table>
</page>
</div>




<script>
    getPagination('#table-id');
    //getPagination('.table-class');
    //getPagination('table');

    /*					PAGINATION 
    - on change max rows select options fade out all rows gt option value mx = 5
    - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
    - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
    - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
    - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
    */


    function getPagination(table) {
        var lastPage = 1;

        $('#maxRows')
            .on('change', function(evt) {
                //$('.paginationprev').html('');						// reset pagination

                lastPage = 1;
                $('.pagination')
                    .find('li')
                    .slice(1, -1)
                    .remove();
                var trnum = 0; // reset tr counter
                var maxRows = parseInt($(this).val()); // get Max Rows from select option

                if (maxRows == 30) {
                    $('.pagination').hide();
                } else {
                    $('.pagination').show();
                }

                var totalRows = $(table + ' tbody tr').length; // numbers of rows
                $(table + ' tr:gt(0)').each(function() {
                    // each TR in  table and not the header
                    trnum++; // Start Counter
                    if (trnum > maxRows) {
                        // if tr number gt maxRows

                        $(this).hide(); // fade it out
                    }
                    if (trnum <= maxRows) {
                        $(this).show();
                    } // else fade in Important in case if it ..
                }); //  was fade out to fade it in
                if (totalRows > maxRows) {
                    // if tr total rows gt max rows option
                    var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
                    //	numbers of pages
                    for (var i = 1; i <= pagenum;) {
                        // for each page append pagination li
                        $('.pagination #prev')
                            .before(
                                '<li data-page="' +
                                i +
                                '">\
								  <span>' +
                                i++ +
                                '<span class="sr-only">(current)</span></span>\
								</li>'
                            )
                            .show();
                    } // end for i
                } // end if row count > max rows
                $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
                $('.pagination li').on('click', function(evt) {
                    // on click each page
                    evt.stopImmediatePropagation();
                    evt.preventDefault();
                    var pageNum = $(this).attr('data-page'); // get it's number

                    var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

                    if (pageNum == 'prev') {
                        if (lastPage == 1) {
                            return;
                        }
                        pageNum = --lastPage;
                    }
                    if (pageNum == 'next') {
                        if (lastPage == $('.pagination li').length - 2) {
                            return;
                        }
                        pageNum = ++lastPage;
                    }

                    lastPage = pageNum;
                    var trIndex = 0; // reset tr counter
                    $('.pagination li').removeClass('active'); // remove active class from all li
                    $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
                    // $(this).addClass('active');					// add active class to the clicked
                    limitPagging();
                    $(table + ' tr:gt(0)').each(function() {
                        // each tr in table not the header
                        trIndex++; // tr index counter
                        // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
                        if (
                            trIndex > maxRows * pageNum ||
                            trIndex <= maxRows * pageNum - maxRows
                        ) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        } //else fade in
                    }); // end of for each tr in table
                }); // end of on click pagination list
                limitPagging();
            })
            .val(5)
            .change();

        // end of on select change

        // END OF PAGINATION
    }

    function limitPagging() {
        // alert($('.pagination li').length)

        if ($('.pagination li').length > 7) {
            if ($('.pagination li.active').attr('data-page') <= 3) {
                $('.pagination li:gt(50)').hide();
                $('.pagination li:lt(50)').show();
                $('.pagination [data-page="next"]').show();
            }
            if ($('.pagination li.active').attr('data-page') > 3) {
                $('.pagination li:gt(0)').hide();
                $('.pagination [data-page="next"]').show();
                for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
                    $('.pagination [data-page="' + i + '"]').show();

                }

            }
        }
    }

    $(function() {
        // Just to append id number for each row
        $('table tr:eq(0)').prepend('<th style="display: none "> ID < /th>');

        var id = 0;

        $('table tr:gt(0)').each(function() {
            id++;
            $(this).prepend('<td style="display: none ">' + id + '</td>');
        });
    });

    //  Developed By Yasser Mas
    // yasser.mas2@gmail.com
</script>