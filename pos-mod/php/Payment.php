<?php

include 'PointOfSales.php';

class Payments extends PointOfSales
{

    public $jo_id;
    public $jo_number;
    public $customer_id;
    public $customer_name;
    public $jo_total;
    public $paid_amount;
    public $jo_balance;

    public function __construct($jo_id)
    {
        parent::__construct();

        $this->jo_id = $jo_id;
        $this->getJoDetails($jo_id);
        $this->getCustomerName($this->customer_id);
        $this->getJoTotal($jo_id);
        $this->getPaidAmount($jo_id);
        $this->jo_balance = $this->jo_total - $this->paid_amount;
    }

    private function getJoDetails($jo_id)
    {

        $result =  $this->select("jo_no, customers_id", "jo_tb", "jo_id = $jo_id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->jo_number = $row['jo_no'];
            $this->customer_id = $row['customers_id'];
        }

        return 0;
    }

    private function getCustomerName($customer_id)
    {
        $result = $this->select("customers_name", "customers", "customers_id = $customer_id");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->customer_name = $row['customers_name'];
        }

        return 0;
    }

    private function getJoTotal($jo_id)
    {
        $result = $this->select("SUM(jo_product_price * jo_product_qty) AS joTotal", "jo_product", "jo_id = $jo_id ");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->jo_total = $row['joTotal'];
        }

        return 0;
    }

    private function getPaidAmount($jo_id)
    {
        $result = $this->select("SUM(order_payment_debit) AS jo_total_paid", "order_payment", "jo_id = $jo_id ");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this->paid_amount = $row['jo_total_paid'];
        }

        return 0;
    }
}
