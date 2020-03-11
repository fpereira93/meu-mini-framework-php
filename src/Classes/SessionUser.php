<?php namespace Classes;

class SessionUser
{
    const KEY_SESSION = 'USER_DATA';

    /**
     * check if user logged
     *
     * @return boolean
     */
    public static function isLogged()
    {
        session_start();
        $has = isset($_SESSION[self::KEY_SESSION]);
        session_write_close();

        return $has;
    }

    /**
     * put a session user
     *
     * @param array $user_info
     * @return void
     */
    public static function login(array $user_info)
    {
        session_start();
        $_SESSION[self::KEY_SESSION] = $user_info;
        session_write_close();
    }

    /**
     * destroy a session user
     *
     * @return void
     */
    public static function logout()
    {
        session_start();
        unset($_SESSION[self::KEY_SESSION]);
        session_destroy();
    }

    /**
     * get data user logged by propert name
     *
     * @param String $property
     * @return void
     */
    public static function get(String $property)
    {
        if (self::isLogged()){
            session_start();
            $name = $_SESSION[self::KEY_SESSION][$property];
            session_write_close();
            return $name;
        }

        return null;
    }
}
