<?php
include 'database.php';

class PointOfSales extends Database
{

    public $online_platform;
    public $banks;
    public $jo_id;
    public $jo_number;
    public $customer_id;
    public $customer_name;
    public $jo_total;
    public $paid_amount;
    public $jo_balance;

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

    function getPendingJoPayments()
    {
        $result = $this->select("jo_tb.jo_id, jo_tb.jo_no, jo_tb.customers_id, customers.customers_name, jo_tb.jo_date", "jo_tb LEFT JOIN customers ON jo_tb.customers_id = customers.customers_id", "jo_tb.jo_type_id = 1  ORDER BY jo_date DESC LIMIT 15");

        return $result;
    }

    function getJoTotal($jo_id)
    {
        $result = $this->select("SUM(jo_product_price * jo_product_qty) AS joTotal", "jo_product", "jo_id = $jo_id ");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->jo_total = $row['joTotal'];
        }

        return $this->jo_total;
    }

    public function getPaidAmount($jo_id)
    {
        $result = $this->select("SUM(order_payment_debit) AS jo_total_paid", "order_payment", "jo_id = $jo_id ");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->paid_amount = $row['jo_total_paid'];
        }

        return $this->paid_amount;
    }
}
