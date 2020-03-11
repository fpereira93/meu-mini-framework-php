<?php namespace Database;

class UserDAO extends BaseDAO
{

    public static function getByEmail(String $email)
    {
        $userDb = parent::select('select * from users where email = ?', [$email]);

        return $userDb;
    }

}
