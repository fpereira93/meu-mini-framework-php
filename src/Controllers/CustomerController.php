<?php namespace Controllers;

use Services\CustomerService;

class CustomerController extends BaseController
{

    public function index()
    {
        $this->createView('customer-list');
    }

    public function register()
    {
        $this->createView('customer-register');
    }

    public function checkFields(array $payload)
    {
        return count(array_filter($payload, function($value){
            if (!is_array($value)){
                return trim((string)$value) == "";
            }

            return false;
        })) == 0;
    }

    public function validatePayload(array $payload)
    {
        unset($payload['id']);

        $is_valid_customer = $this->checkFields($payload);

        if (!$is_valid_customer){
            return false;
        }

        if (!empty($payload['adresses_list'])){
            return count(array_filter($payload['adresses_list'], function($adresses){
                return $this->checkFields($adresses) == false;
            })) == 0;
        }

        return true;
    }

    public function post(array $payload)
    {
        $is_valid = $this->validatePayload($payload);

        $response = [
            'is_valid' => $is_valid,
        ];

        if (!$is_valid){
            return $response;
        }

        $customer_id = (new CustomerService)->saveCustomer($payload);

        if (!$customer_id){
            $response['is_valid'] = false;
        } else {
            $response['customer_id'] = (int)$customer_id;
        }

        return $response;
    }

    public function all()
    {
        $customers = (new CustomerService)->all();
        return $customers;
    }

    public function delete(array $payload)
    {
        $deleted = (new CustomerService)->delete($payload['customer_id']);

        return [
            'deleted' => $deleted,
        ];
    }

    public function info(array $payload)
    {
        $customer = (new CustomerService)->getById($payload['customer_id']);

        return $customer;
    }
}
