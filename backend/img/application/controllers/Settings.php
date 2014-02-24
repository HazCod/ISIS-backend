<?php

class Settings extends Core_controller
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
        $this->user = $this->user_m->getUser($_SESSION['user']);
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
		$this->setFlashMessage('This page is not accessible. What are you trying to do?', 'info'); 
		$this->redirect('admin/index');
        } else {
        	$this->redirect('home/index');
        }
    }

    public function password(){
        if (isset($_SESSION['user'])) {
	        $formdata = $this->form->getPost();
        	$this->form->validateLength('password', 3);
        	if ($this->form->isFormValid()) {
			$this->user_m->updatePassword('admin', sha1('zotte' . $formdata->password . 'pompoen'));
			$this->setFlashmessage('Your password has been changed.');
			$this->redirect('admin/settings');
		} else {
			$this->setFlashMessage('Password must be minimum 3 letters long.', 'danger'); 
			$this->redirect('admin/settings');	
		}

        } else {
        	$this->redirect('home/index');
        }
    }




}
