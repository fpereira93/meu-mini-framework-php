<?php namespace Services;

use Database\UserDAO;

class UserService extends BaseService
{

    public function validateLogin(String $email, String $password)
    {
        $user_db = current(UserDAO::getByEmail($email));

        if ($user_db){
            return $user_db->password == md5($password);
        }

        return false;
    }

    public function getByEmail(String $email)
    {
        return current(UserDAO::getByEmail($email));
    }

}
