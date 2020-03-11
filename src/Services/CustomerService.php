<?php namespace Services;

use Database\CustomerDAO;

class CustomerService extends BaseService
{

    public function saveCustomer(array $data)
    {
        $customer_id = CustomerDAO::saveCustomer($data);

        return $customer_id;
    }

    public function all()
    {
        $customers = CustomerDAO::all();

        return $customers;
    }

    public function delete(int $id)
    {
        return CustomerDAO::delete($id);
    }

    public function getById(int $id)
    {
        return CustomerDAO::getById($id);
    }
}
