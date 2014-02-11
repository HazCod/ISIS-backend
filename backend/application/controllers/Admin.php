<?php

class Admin extends Core_controller
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
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->user = $this->user_m->getUser($_SESSION['user']);
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
		$units = $this->units_m->getUnits();
		if ($units) {
            usort($units, function ($a, $b) {
				return strcmp($a->moment, $b->moment);
        });
		foreach ($units as $unit => $data) {
                    $arr[$unit]['caption'] = $data->caption;
                    $arr[$unit]['location'] = $data->location;
                    $arr[$unit]['time_added'] = $data->time_added;
                    $arr[$unit]['last_seen'] = $data->last_seen;
                }
                $this->template->units = $arr; 
		}		
		$this->template->render('admin/index');  
        } else {
        $this->template->render('home/index');
        }
	}

   public function settings(){
        if (isset($_SESSION['user'])) {
		$this->template->render('admin/settings');
	} else {
		$this->redirect('home/index');
	}
   }
   
   	public function units($caption)
	{
	
		if (isset($_SESSION['user'])) {
		//var_dump($caption);
		$this->template->unit = $caption;
		
		$this->template->render('admin/units'); 
		} else {
		$this->template->render('home/index');
		}
	}



}
