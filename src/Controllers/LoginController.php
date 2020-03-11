<?php namespace Controllers;

use Classes\SessionUser;
use Services\UserService;

class LoginController extends BaseController
{

    public function index()
    {
        $this->createView('Login');
    }

    private function validatePayload(array $request)
    {
        return !empty($request['email']) && !empty($request['password']);
    }

    /**
     * check login access user
     *
     * @param array $data
     * @return void
     */
    public function loginAccess(array $data)
    {
        if ($this->validatePayload($data)){
            $service = new UserService;
            $valid = $service->validateLogin($data['email'], $data['password']);
    
            if ($valid){
                $user_data = (array)$service->getByEmail($data['email']);

                SessionUser::login($user_data);

                return [ 'is_valid' => true ];
            }
        }

        return [ 'is_valid' => false ];
    }

    /**
     * remove from user session and redirect
     *
     * @return void
     */
    public function logout()
    {
        SessionUser::logout();
        $this->checkLogin();
    }
}
