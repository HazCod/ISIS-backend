<?php

class Passwords extends Core_controller
{

	public function __construct()
    {
        parent::__construct();

        $this->template->setPartial('navbar')
            ->setPartial('headermeta')
            ->setPartial('footer')
            ->setPartial('flashmessage');

        $this->user_m = Load::model('user_m');
        $this->template->user = $this->user_m->getUser($_SESSION['user']);
        $this->menu_m = Load::model('menu_m');
		$this->units_m = Load::model('units_m');
		$this->wifi_m = Load::model('wifi_m');
		//$this->wifi_m = Load::model('wifi_m');
		$this->passwords_m = Load::model('passwords_m');
		//$this->assignments_m = Load::model('assignments_m');
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->user = $this->user_m->getUser($_SESSION['user']);
        //$this->assignments_m = Load::model('assignments_m');
		
		$this->template->setPagetitle('Project ISIS');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
			$passwords = $this->passwords_m->getPasswords();
			if ($passwords) {
		        usort($passwords, function ($b, $a) {
					return strcmp($a->website, $b->website);
		    });
			foreach ($passwords as $password => $data) {
		                $arr[$password]['login'] = $data->login;
		                $arr[$password]['password'] = $data->password;
		                $arr[$password]['website'] = $data->website;
		                
		            }
		            $this->template->passwords = $arr; 
			}		
			$this->template->render('passwords/index');  
	    } else {
	    	$this->template->render('home/index');
	    }

	}

}

?>