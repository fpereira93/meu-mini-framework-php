<?php namespace Controllers;

class HomePageController extends BaseController
{

    public function index()
    {
        $this->createView('HomePage');
    }

}
