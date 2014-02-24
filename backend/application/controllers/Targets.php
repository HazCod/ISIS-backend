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
<<<<<<< HEAD
		$this->wifi_m = Load::model('wifi_m');
=======
>>>>>>> 7669d1a5812140747f920fc2a2b50c3ded84e22c
		//$this->wifi_m = Load::model('wifi_m');
		$this->targets_m = Load::model('targets_m');
		//$this->assignments_m = Load::model('assignments_m');
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->user = $this->user_m->getUser($_SESSION['user']);
<<<<<<< HEAD
        //$this->assignments_m = Load::model('assignments_m');
=======
>>>>>>> 7669d1a5812140747f920fc2a2b50c3ded84e22c
		
		$this->template->setPagetitle('Project ISIS');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
<<<<<<< HEAD
			$targets = $this->targets_m->getTargets();
			if ($targets) {
		        usort($targets, function ($b, $a) {
					return strcmp($a->timestamp, $b->timestamp);
		    });
			foreach ($targets as $target => $data) {
		                $arr[$target]['MAC'] = $data->MAC;
		                $arr[$target]['location'] = $data->location;
		                $arr[$target]['timestamp'] = $data->timestamp;
		                if (isset($data->hostname)){
		                	$arr[$target]['hostname'] = $data->hostname;
		                }
						$arr[$target]['manufac'] = $data->manufac;
						$arr[$target]['Verbonden Access Point'] = $data->associated_ap;
		            }
		            $this->template->targets = $arr; 
			}		
			$this->template->render('targets/index');  
	    } else {
	    	$this->template->render('home/index');
	    }

	}

	public function kickunit($location=false , $client=false, $wifi=false){
        if (isset($_SESSION['user']) and ($location != false && $client != false && $wifi != false)) {
        	$this->networks =  $this->wifi_m->getAPnetworks($wifi);
        	foreach ($this->networks as $key => $network){
        		$this->units_m->addAssignmentKick($location, $client, $wifi, $network->channel);	
        	}
			$this->setFlashMessage('Deauthentication sent to ' . $client . ' for ' . $wifi . ' on all available channels.');
			$this->redirect('targets/index');
	    } else {
	    	$this->setFlashMessage('No parameters given. (location, unit, wifi, channel)', 'error');
	    	$this->redirect('targets/index');
	    }
	}

	public function kickall($ap=false){
		if (isset($_SESSION['user']) && ($ap != false)){
			$this->networks =  $this->wifi_m->getAPnetworks($ap);
	        foreach ($this->networks as $key => $network){
	        	$this->units_m->addAssignmentKickAll($ap, $network->wifi_network, $network->channel);
			}
			$this->setFlashMessage('Deauthentication sent to everyone on ' . $ap . '.');	
	    	$this->redirect("admin/ap/$ap");
		} else {
	    	$this->setFlashMessage('No parameter given. (wifi)', 'error');
	    	$this->redirect("admin/index");
		}
	}

	public function probes($client=false){
		if (isset($_SESSION['user']) and ($client != false)){
			$this->template->probes = $this->targets_m->getProbes();
			$this->template->device = $client;
			$this->template->render('targets/probes');
		} else {
			$this->setFlashMessage('Invalid argument supplied.');
			$this->redirect('targets/index');
		}
	}


=======
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
>>>>>>> 7669d1a5812140747f920fc2a2b50c3ded84e22c
}

?>