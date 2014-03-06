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
		$this->wifi_m = Load::model('wifi_m');
		$this->targets_m = Load::model('targets_m');
		$this->assignments_m = Load::model('assignments_m');
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->user = $this->user_m->getUser($_SESSION['user']);
		
		$this->template->setPagetitle('Project ISIS');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
		$units = $this->units_m->getUnits();
		if ($units) {
            usort($units, function ($a, $b) {
				return strcmp($a->caption, $b->caption);
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
		$this->template->unit = $caption;

		$this->template->lastseen = $this->units_m->getLastSeen($caption)->last_seen;
		
		$wifis = $this->wifi_m->getWifi($caption);
		if ($wifis) {
            usort($wifis, function ($a, $b) {
				return strcmp($a->wifi_network, $b->wifi_network);
        });
		foreach ($wifis as $wifi => $data) {
                    
                    $arr[$wifi]['wifi_network'] = $data->wifi_network;
                    $arr[$wifi]['last_updated'] = $data->last_updated;
					$arr[$wifi]['encryption'] = $data->encryption;
					$arr[$wifi]['wifi_key'] = $data->wifi_key;
					
                }
                $this->template->wifis = $arr; 
		}
		
		$assignments = $this->assignments_m->getAssignment($caption);
		
		if ($assignments ) {
  //           usort($assignments , function ($a, $b) {
		// 		return strcmp($a->assignments_id, $b->assignments_id);
  //       });
		foreach ($assignments  as $assignment => $data) {
                    
                    $arr2[$assignment]['assignments_id'] = $data->assignments_id;
					$arr2[$assignment]['assignment'] = $data->assignment;
                    $arr2[$assignment]['status'] = $data->status;
                    if (!$data->parameter){
                    	$arr2[$assignment]['parameter'] = '/';
                    } else {
                    	$arr2[$assignment]['parameter'] = $data->parameter;
                    }
					//$arr2[$assignment]['parameter'] = $data->parameter;
					
                }
                $this->template->assignments = $arr2; 
		}
		
		$this->template->render('admin/units'); 
		} else {
		$this->template->render('home/index');
		}
	}
	
	public function addUnit()
	{
	if (isset($_SESSION['user'])) {
	
		if ($_POST) {
		$formdata = $this->form->getPost();
		$this->units_m->addUnit($formdata->caption,$formdata->location);
		$this->setFlashmessage("Unit name has been added. We now accept communication with this unit.");
		$this->redirect('admin/index');
		} else {
		$this->template->render('admin/addUnit'); 
		}
	} else {
		$this->template->render('home/index');
		}
	}
	
	public function editLocation($caption)
	{
	if (isset($_SESSION['user'])) {
		if ($_POST) {
			$formdata = $this->form->getPost();
			$this->units_m->editLocation(strtolower($formdata->location),$caption);
			$this->setFlashmessage("Location of unit $caption  has been changed to $formdata->location.");
			$this->redirect('admin/index');
		} else {
			$this->template->unit = $caption;
			$this->template->render('admin/editLocation');
		}
	} else {
		$this->template->render('home/index');
	}
	}
	
	public function deleteUnit($caption)
	{
	if (isset($_SESSION['user'])) {
		$this->units_m->removeUnit($caption);
		$this->setFlashmessage("Unit $caption removed. Unit will no longer function until added again.");
		$this->redirect('admin/index');
	} else {
		$this->template->render('home/index');
	}
	}
	
	public function checkoutUnit($caption)
	{
	if (isset($_SESSION['user'])) {
		$this->units_m->addAssignment('gitCheckout',$caption);
		$this->setFlashmessage("Update Task added to queue of unit $caption.");
		$this->redirect('admin/index');
	} else {
		$this->template->render('home/index');
	}
	}

	
	public function detailWifi($caption,$wifi_network)
	{
	
		if (isset($_SESSION['user'])) {
		$this->template->connection = $wifi_network;
		
		$detailswifi = $this->wifi_m->getDetailWifi($caption,$wifi_network);
		if ($detailswifi) {
            usort($detailswifi, function ($a, $b) {
				return strcmp($a->last_updated, $b->last_updated);
        });
		foreach ($detailswifi as $wifi => $data) {
                    
                    $arr[$wifi]['mac_adress'] = $data->mac_adress;
                    $arr[$wifi]['channel'] = $data->channel;
					$arr[$wifi]['quality'] = $data->quality;
					$arr[$wifi]['manufac'] = $data->manufac;
					
                }
                $this->template->detailswifi = $arr; 
		}
		
		$this->template->render('admin/detailWifi'); 
		} else {
			$this->template->render('home/index');
		}
	}
	
	public function connectWifiUnit($caption,$wifi_network)
	{
		
		if (isset($_SESSION['user'])) {
		$this->units_m->addAssignmentParam('connectWifiUnit',$caption,$wifi_network);
		$this->setFlashmessage("WifiConnect Task added to queue of unit $caption.");
		$this->redirect("admin/units/$caption");
		} else {
		$this->template->render('home/index');
		}
		
	}
	
		public function crackWifiUnit($caption,$wifi_network)
	{
		
		if (isset($_SESSION['user'])) {
			$this->units_m->addAssignmentParam('crackWifiUnit',$caption,$wifi_network);
			$this->setFlashmessage("Cracking Task added to queue of unit $caption.");
			$this->redirect("admin/units/$caption");
		} else {
			$this->template->render('home/index');
		}
		
	}
	
		public function scan($caption)
	{
		
		if (isset($_SESSION['user'])) {
			$this->units_m->addAssignment('scan',$caption);
			$this->setFlashmessage("Scanning Task added to queue of unit $caption.");
			$this->redirect("admin/index");
		} else {
			$this->template->render('home/index');
		}
		
	}
	
		public function snap($caption)
	{
		
		if (isset($_SESSION['user'])) {
		$this->units_m->addAssignment('snap',$caption);
		$this->setFlashmessage("Snapping Task added to queue of unit $caption.");
		$this->redirect("admin/index");
		} else {
			$this->template->render('home/index');
		}
		
	}


	public function ap($ap=false){
		if (isset($_SESSION['user']) && $ap != false){
			$ap_t = trim($ap);
			$this->template->ap = $ap_t;
			$tmp = $this->wifi_m->getManufacturer($ap_t);
			if ($mp){
				$this->template->manufac = $manufac;
			}
			//$this->setCurrentFlashmessage($this->template->manufac);
			$this->template->wifis   = $this->wifi_m->getAPnetworks($ap_t);
			$this->template->devices = $this->wifi_m->getAPdevices($ap_t);
			//$this->setCurrentFlashmessage($this->template->devices);
			$this->template->render('admin/ap');
		} else {
			$this->setFlashmessage('Insufficient permissions or no parameter given.');
			$this->redirect('home/index');
		}
	}
	
	public function rogueAP($caption,$wifi_network){
		
		if (isset($_SESSION['user'])) {
			$this->units_m->addAssignmentParam('rogue',$caption,$wifi_network);
			$this->setFlashmessage("$caption is going rogue.");
			$this->redirect("admin/units/$caption");
		} else {
			$this->template->render('home/index');
		}
	}
	
	public function removeAssignment($caption,$assignments_id){
		
		if (isset($_SESSION['user'])) {
			$this->assignments_m->removeAssignment($assignments_id);
			$this->setFlashmessage("Assignment removed");
			$this->redirect("admin/units/$caption");
		} else {
			$this->template->render('home/index');
		}
	
	}
	
	public function stopRogue($caption){
	
		if (isset($_SESSION['user'])) {
			$this->units_m->addAssignment('stoprogue',$caption);
			$this->setFlashmessage("Rogue has stopped !");
			$this->redirect("admin/units/$caption");
		} else {
			$this->template->render('home/index');
		}
	}

	public function nmap( $wifi ){
		if (isset($_SESSION['user'])){
			$zwifi = $this->wifi_m->getGeneralWifi($wifi);
			if ($zwifi->wifi_key or $zwifi->encryption == "open"){
				$units = $this->units_m->getUnitsByWifi($wifi);
				foreach ($units as $unit){
					$this->assignments_m->addNmapAssignment($unit->caption,$wifi, $zwifi->wifi_key, $zwifi->encryption);
				}
				$this->setFlashmessage("Assignment nmap added. (key: $zwifi->wifi_key)");
				$this->redirect("admin/index");
			} else {
				$this->setFlashmessage("No key has been found yet for $wifi",'danger');
				$this->redirect('admin/index');
			}
		} else {
			$this->template->render('home/index');
		}
	}

}