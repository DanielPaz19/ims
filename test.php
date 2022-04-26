<?php
/*
 
*   File:       displayByCompany.php
 
*/
 
 
// Connect DB
 
$hostName  ="localhost";
$userName ="root";
$userPassword ="";
$database ="inventorymanagement";
$comArray = array(); 
$orderClause ='';
$tempcompany ='';
$comArray = array();
 
 
$dbConnectionStatus  = new mysqli($hostName, $userName, $userPassword,$database);
 
//Connection Error
if ($dbConnectionStatus->connect_error){     
 
         
     die("Connection failed: " . $dbConnectionStatus->connect_error);
 
}
// Connected to Database JaneDB
// Object oriented  -> pointing 
if($dbConnectionStatus->query("SELECT DATABASE()")){
     
    $dbSuccess =true;
    //
    $result = $dbConnectionStatus->query("SELECT DATABASE()");
    $row = $result->fetch_row();
    printf("Default database is %s.\n", $row[0]);
    $result->close();
 
     
     
     
}
 
 
 
// DB Connect Successful
 
if ($dbSuccess) {
 
 //  -------------------- Style declarations---------------------------------------------------------
 
             
            $textFont = 'style = " font-family: arial, helvetica, sans-serif; "';
 
             
            $indent50 = 'style = " margin-left: 50; "';
            $indent100 = 'style = " margin-left: 100; "';
 //  ----------------------------------------------------------------------------------------------------
  
  
echo '<h1>PACC Inventory List</h1>';
 
//-------------------------- Select Company Querries-------------------------------------------------------
 
 
 
 
$selectCompany = "SELECT product.product_id, product.product_name, class_tb.class_name, product.qty, unit_tb.unit_name, unit_tb.unit_id, product.pro_remarks, loc_tb.loc_name,loc_tb.loc_id, product.barcode, product.price, product.cost, dept_tb.dept_name, dept_tb.dept_id, class_tb.class_id, product_type.product_type_name, product_type.product_type_id
FROM product
LEFT JOIN class_tb ON product.class_id = class_tb.class_id
LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
LEFT JOIN loc_tb ON product.loc_id = loc_tb.loc_id
LEFT JOIN dept_tb ON product.dept_id = dept_tb.dept_id
LEFT JOIN product_type ON product.product_type_id = product_type.product_type_id 
WHERE product.dept_id = 1 AND product_group_id = 2";
$selectCompany_Query = mysqli_query($dbConnectionStatus,$selectCompany );
$companyArray =array();
     
// Loop Through Company Records
 
 while($rowsCompany=mysqli_fetch_assoc($selectCompany_Query)){
      
                 // Get the Company Name/ id
                
             $companyName =$rowsCompany['class_name'];
              
              
             // Check whether the Company Table is Created f No Create the Table
              if(! in_array($companyName,$comArray)){
                             array_push($comArray,$companyName);
                              
                                     echo '<h2 '.$indent50.'>'.'Group by '.$companyName .'</h2>';
                                            echo '<div '.$indent100.'>';
                                                 echo "<table border='1'>";
                                                  
                                                   echo "<tr>";
                                                    
                                                            echo "<td>Product_id</td>";
                                                            echo "<td>Item Description</td>";
                                                            echo "<td>Qty</td>";
                                                            echo "<td>Unit</td>";
                                                             
                                                     echo "</tr>"; 
                                                             
                                                             //-----------------Add Row into the Selected Company --------------------------------
                                                              
                                                              $selectPerson = "SELECT product.product_id, product.product_name, class_tb.class_name, product.qty, unit_tb.unit_name, unit_tb.unit_id, product.pro_remarks, loc_tb.loc_name,loc_tb.loc_id, product.barcode, product.price, product.cost, dept_tb.dept_name, dept_tb.dept_id, class_tb.class_id, product_type.product_type_name, product_type.product_type_id
                                                              FROM product
                                                              LEFT JOIN class_tb ON product.class_id = class_tb.class_id
                                                              LEFT JOIN unit_tb ON product.unit_id = unit_tb.unit_id
                                                              LEFT JOIN loc_tb ON product.loc_id = loc_tb.loc_id
                                                              LEFT JOIN dept_tb ON product.dept_id = dept_tb.dept_id
                                                              LEFT JOIN product_type ON product.product_type_id = product_type.product_type_id
                                                              WHERE class_tb.class_name = '$companyName' ";
                                                              $selectPerson_Query = mysqli_query($dbConnectionStatus,$selectPerson);
                                                              $arrayPerson = array();
                                                              while($personrows=mysqli_fetch_assoc($selectPerson_Query )){
                                                                   
                                                                                               $arrayPerson[] = $personrows; 
 
                                                              }
                                                               
                                                             
                                               
                                                              foreach($arrayPerson as $data){
                                                                                
         
                                                                                echo'<tr>';
                                                                               // Search through the array print out value if see the Key  eg: 'id', 'firstname ' etc.
                                                                                echo'<td>'.$data['product_id'].'</td>';
                                                                                echo'<td>'.$data['product_name'].'</td>';
                                                                                echo'<td>'.$data['qty'].'</td>';
                                                                                echo'<td>'.$data['unit_name'].'</td>';
                                                                               
                                                                              
                                                                              
                                                                                echo'</tr>';
                                                                                 
                                                                                 
                                                                                 
                                                                                 
                                                             
                                                                            }
                                                               
                                                             
                                                             
                                                             
                                                             
                                                             
                                                             
                                                             
                                    
                                                            //-------------------------------------------------------------------------------------
                                                    
                                                  echo "</table>";
                                              echo '</div>';
                              
                              
                              
                             
                              
                              
                         }
              
                       
             
             
                 
 }          
                 
     
 
                 
 
    echo '</div>';
         
 
 
  
 
 
 
 
}
 
 
?>