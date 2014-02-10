<?php
class Home extends Core_controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(){
        if (isset ($_SESSION['rol']))
        {
            $this->redirect($_SESSION['rol']);
        }
        else
        {
            $this->redirect("login");
        }
    }
}