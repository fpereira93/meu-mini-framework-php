<?php namespace Controllers;

use Classes\SessionUser;

class BaseController
{

    protected $route_login = '/login';
    protected $route_home = '/home';
    protected $route_base = '/';

    public function __construct() {
        $this->checkLogin();
    }

    /**
     * function check if user logged
     *
     * @return void
     */
    protected function checkLogin()
    {
        $current_url = $_SERVER['REQUEST_URI'];
        $user_logged = SessionUser::isLogged();

        if (!$user_logged && $current_url != $this->route_login){
            header("Location: $this->route_login");
        } else if ($user_logged && $current_url == $this->route_login){
            header("Location: $this->route_home");
        } else if ($user_logged && $current_url == $this->route_base){
            header("Location: $this->route_home");
        }
    }

    /**
     * Retrievied a view with base name paramn
     *
     * @param String $viewName
     * @return void
     */
    public function createView(String $viewName)
    {
        include_once __DIR__ . DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR, ['..', 'Views', $viewName . '.php']);
    }

}
