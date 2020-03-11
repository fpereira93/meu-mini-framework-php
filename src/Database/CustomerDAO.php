<?php namespace Database;

use Throwable;
use PDO;

class CustomerDAO extends BaseDAO
{

    public static function saveCustomer(array $data)
    {
        try {
            ConnectMySQL::beginTransaction();

            $id = $data['id'];

            if (empty($id)){
                $id = parent::insert('insert into customers(name, birth_date, cpf, rg, phone) values (
                    :name, :birth_date, :cpf, :rg, :phone
                )', [
                    ':name' => $data['name'],
                    ':birth_date' => $data['birth_date'],
                    ':cpf' => $data['cpf'],
                    ':rg' => $data['rg'],
                    ':phone' => $data['phone'],
                ]);
            } else {
                parent::update('update customers set
                    name = :name,
                    birth_date = :birth_date,
                    cpf = :cpf,
                    rg = :rg,
                    phone = :phone
                    where id = :id', [
                        ':id' => $id,
                        ':name' => $data['name'],
                        ':birth_date' => $data['birth_date'],
                        ':cpf' => $data['cpf'],
                        ':rg' => $data['rg'],
                        ':phone' => $data['phone'],
                    ]);
            }
    
            self::syncAdresses(isset($data['adresses_list']) ? $data['adresses_list'] : [], $id);

            ConnectMySQL::commitTransaction();
    
            return $id;
        } catch (Throwable $th) {
            ConnectMySQL::rollBackTransaction();

            return null;
        }
    }

    private static function syncAdresses(array $adresses_list, int $customer_id)
    {
        self::execute('delete from adresses where customer_id = ?', [$customer_id]);

        foreach($adresses_list as $key => $adresses){

            parent::insert('insert into adresses(customer_id, number, street_name, state, postal_code, country) values (:customer_id, :number, :street_name, :state, :postal_code, :country)',
            [
                ':customer_id' => $customer_id,
                ':number' => $adresses['number'],
                ':street_name' => $adresses['street'],
                ':state' => $adresses['state'],
                ':postal_code' => $adresses['postal_code'],
                ':country' => $adresses['country'],
            ]);
        }
    }

    public static function all()
    {
        $allDb = parent::select('select id, name, birth_date, cpf, rg, phone from customers order by name');

        return $allDb;
    }

    public static function delete(int $id)
    {
        try {
            ConnectMySQL::beginTransaction();

            self::execute('delete from adresses where customer_id = ?', [$id]);
            self::execute('delete from customers where id = ?', [$id]);

            ConnectMySQL::commitTransaction();
    
            return true;
        } catch (Throwable $th) {
            ConnectMySQL::rollBackTransaction();

            return false;
        }
    }

    public static function getById(int $id)
    {
        $customer_db = current(parent::select('select id, name,
            birth_date, cpf, rg, phone from customers where id = ?', [$id]));

        if (!$customer_db){
            return null;
        }

        $adresses_db = parent::select('select
            number, street_name as street, state,
            postal_code, country from adresses where customer_id = ?', [$id]);

        return [
            'customer_db' => $customer_db,
            'adresses_db' => $adresses_db,
        ];
    }
}
