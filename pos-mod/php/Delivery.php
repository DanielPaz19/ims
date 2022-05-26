<?php

use LDAP\Result;

include 'PointOfSales.php';


class Delivery extends PointOfSales
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

    function getCustomerDetails($dr_number)
    {
        $sql = "SELECT customers.customers_name,
        customers.customers_address,
        customers.customers_id,
        customers.customers_tin,
        customers.customers_contact,
        delivery_receipt.user_id,
        delivery_receipt.dr_date
        FROM delivery_receipt
        LEFT JOIN dr_products ON dr_products.dr_number = delivery_receipt.dr_number
        LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
        LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id 
        LEFT JOIN customers ON customers.customers_id = jo_tb.customers_id
        WHERE delivery_receipt.dr_number IN ($dr_number)";

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return 0;
    }

    function getDeliveryDetails($dr_number)
    {
        $sql = "SELECT delivery_receipt.dr_number, 
        delivery_receipt.dr_date, 
        user.user_name 
        FROM delivery_receipt
        LEFT JOIN user ON user.user_id = delivery_receipt.user_id
        WHERE dr_number = '$dr_number'";

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return 0;
    }

    function getJoDetails($dr_number)
    {
        $sql = "SELECT jo_tb.jo_no FROM jo_tb
        LEFT JOIN jo_product ON jo_product.jo_id = jo_tb.jo_id
        LEFT JOIN dr_products ON dr_products.jo_product_id = jo_product.jo_product_id
        WHERE dr_products.dr_number = '$dr_number'
        GROUP BY jo_tb.jo_no";

        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
            while ($jo =  $result->fetch_assoc()) {
                $joNoArr[] = $jo['jo_no'];
            }
            return $joNoArr;
        }

        return [];
    }

    function getProductDetails($dr_number)
    {
        $sql = "SELECT product.product_id, dr_products.dr_product_qty, dr_products.jo_product_id, product.product_name, jo_product.jo_product_price, unit_tb.unit_name, dr_products.dr_product_qty * jo_product.jo_product_price AS subTotal
        FROM dr_products
        LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
        LEFT JOIN product ON product.product_id = jo_product.product_id
        LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
        WHERE dr_products.dr_number IN ($dr_number)
        ";

        return $this->mysqli->query($sql);
    }

    function getDrItems($dr_number = [])
    {
        $sql = "SELECT dr_products.jo_product_id, 
                dr_products.dr_number,
                dr_products.dr_product_qty, 
                SUM(dr_products.dr_product_qty) AS totalQty,
                product.product_id,
                product.product_name,
                unit_tb.unit_name,
                SUM(dr_products.dr_product_qty * jo_product.jo_product_price) AS totalRowAmount,
                jo_product.jo_product_price
                FROM dr_products
                LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
                LEFT JOIN product ON product.product_id = jo_product.product_id
                LEFT JOIN unit_tb ON unit_tb.unit_id = product.unit_id
                WHERE dr_products.dr_number IN ($dr_number)
                GROUP BY product.product_id, jo_product.jo_product_price 
        ";

        $result = $this->mysqli->query($sql);

        return $result;
    }
}
