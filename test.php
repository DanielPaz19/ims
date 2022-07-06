<?php

include('php/config.php');


$fetch = mysqli_query($db, "SELECT * FROM ol_tb WHERE ol_id = 15");

while ($row = mysqli_fetch_array($fetch)) {
    echo "$row[ol_title]";
}
