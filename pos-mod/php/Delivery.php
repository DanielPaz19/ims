<?php

include 'database.php';


class Delivery extends Database
{
    function getItemTotalDelivered($jo_prod_id)
    {
        $sql = "SELECT *, SUM(dr_product_qty) AS totalDelivered 
        FROM dr_products 
        WHERE jo_product_id = '$jo_prod_id' 
        GROUP BY jo_product_id";

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row =  $result->fetch_assoc();
            return $row['totalDelivered'];
        }

        return 0;
    }

    function getJoTotalDelivered($jo_id)
    {
        $sql = "SELECT SUM(dr_products.dr_product_qty) AS joTotalDelivered, 
                dr_products.dr_product_qty, 
                dr_products.jo_product_id, 
                jo_product.jo_id 
                FROM dr_products
                LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
                WHERE jo_product.jo_id = '$jo_id'
                GROUP BY jo_product.jo_id";

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row =  $result->fetch_assoc();
            return $row['joTotalDelivered'];
        }

        return 0;
    }
}
