<?php
include 'database.php';

class PointOfSales extends Database
{

    public $online_platform;
    public $banks;

    public function __construct()
    {
        parent::__construct();

        $this->online_platform = $this->getOnlinePlatforms();
        $this->banks = $this->getBank();
    }

    function getDrList($qry = '')
    {
        $sql =
            "SELECT delivery_receipt.dr_number, 
            customers.customers_name, 
            delivery_receipt.dr_date,
            SUM(dr_products.dr_product_qty * jo_product.jo_product_price)  AS subTotal
            FROM delivery_receipt 
            LEFT JOIN dr_products ON dr_products.dr_number = delivery_receipt.dr_number
            LEFT JOIN jo_product ON jo_product.jo_product_id = dr_products.jo_product_id
            LEFT JOIN jo_tb ON jo_tb.jo_id = jo_product.jo_id
            LEFT JOIN customers ON customers.customers_id = jo_tb.customers_id
            WHERE customers.customers_id = '$qry'
            GROUP BY delivery_receipt.dr_number
            ORDER BY delivery_receipt.dr_date DESC";

        $result = $this->mysqli->query($sql);

        return $result;
    }

    function getOnlinePlatforms()
    {
        $result = $this->select("*", "online_platform");

        return $result;
    }

    function getBank()
    {
        $result = $this->select("*", "bank");
        return $result;
    }
}
