<?php


$connect = mysqli_connect("localhost", "root", "", "inventorymanagement");
if (isset($_GET["query"])) {
     $output = '';  //Output Initialization
     $query = "SELECT product.product_name, product.product_id, loc_tb.loc_name, product.barcode, product.qty
                FROM product
                LEFT JOIN loc_tb ON loc_tb.loc_id = product.loc_id
                WHERE product_name LIKE '%" . $_GET["query"] . "%' LIMIT 30";  //Select Items

     $result = mysqli_query($connect, $query);
     $output = '<ul>';  //Add <ul> tag to output
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) //Keep adding List Items while there is a result
          {
               $output .= '<br><li>ID: ' . str_pad($row['product_id'], 8, 0, STR_PAD_LEFT)  . "&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  " . $row["product_name"] .
                    "\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  " . $row['loc_name'] . "\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['barcode'] . "\t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY:&nbsp;" . $row['qty'] .

                    '<p class="hidden">' . $row['product_id'] . '</p>' . '</li>';
          }
     } else {
          $output .= '<li><font color="red"><i><b>ITEM NOT FOUND</font></b></i></li>';
     }
     $output .= '</ul>';  //Closing tag for output
     echo $output;
}
