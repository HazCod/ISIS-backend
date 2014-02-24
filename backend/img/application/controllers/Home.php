<?php
class Home extends Core_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->template->setPartial('navbar')
            ->setPartial('headermeta')
            ->setPartial('footer')
            ->setPartial('flashmessage');

        $this->login_m = Load::model('login_m');
        $this->menu_m = Load::model('menu_m');
        $this->template->menuitems = $this->menu_m->getStartMenu();

        $this->template->setPagetitle('Project ISIS');
		
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
        	$this->redirect('admin/index');    
        } else {
        	$this->template->render('home/index');
        }
    }

    public function login()
    {
        $formdata = $this->form->getPost();

        $this->form->validateLength('username', 3);
        $this->form->validateLength('password', 3);

        if ($this->form->isFormValid()) {

            if ($this->login_m->isValidLogin($formdata->username, sha1('zotte' . $formdata->password . 'pompoen'))) {

                $_SESSION['user'] = $formdata->username;
                $this->setFlashmessage('Successfully logged in! Welcome back commander.');
                $this->redirect('home/index');

            } else {

                $this->template->formdata = $formdata;
                $this->setCurrentFlashmessage('Wrong username and/or password.', 'danger');
                $this->template->render('home/index');

            }

        } else {

            $this->template->formdata = $formdata;
            $this->setCurrentFlashmessage('Wrong username and/or password', 'danger');
            $this->template->render('home/index');

        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->setFlashmessage('You are logged out');
        $this->redirect("home/index");
    }


}
