<?php

class Targets extends Core_controller
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
		//$this->wifi_m = Load::model('wifi_m');
		$this->targets_m = Load::model('targets_m');
		//$this->assignments_m = Load::model('assignments_m');
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->user = $this->user_m->getUser($_SESSION['user']);
		
		$this->template->setPagetitle('Project ISIS');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
		$targets = $this->targets_m->getTargets();
		if ($targets) {
	        usort($targets, function ($a, $b) {
				return strcmp($a->caption, $b->caption);
	    });
		foreach ($targets as $target => $data) {
	                $arr[$target]['MAC'] = $data->MAC;
	                $arr[$target]['location'] = $data->location;
	                $arr[$target]['timestamp'] = $data->timestamp;
	                $arr[$target]['hostname'] = $data->hostname;
	            }
	            $this->template->targets = $arr; 
		}		
		$this->template->render('targets/index');  
	    } else {
	    $this->template->render('home/index');
	    }

	}
}

?>