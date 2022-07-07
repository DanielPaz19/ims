<?php

include 'PointOfSales.php';

class Payments extends PointOfSales
{

    public $jo_id;
    public $jo_number;
    public $customer_id;
    public $customer_name;

    public function __construct($jo_id)
    {
        parent::__construct();

        $this->jo_id = $jo_id;
        $this->getJoDetails($jo_id);
        $this->getCustomerName($this->customer_id);
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
}
