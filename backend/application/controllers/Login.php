<?php
class Login extends Core_controller
{
    private $gebruikers;

    public function __construct()
    {
        parent::__construct();

        $this->template->setPartial('flashmessage')
            ->setPartial('scripts')
            ->setPartial('loginheader');

        $this->template->setLayout('login');

        $this->gebruikers=Load::model('users_m');

    }

    public function index()
    {
        $this->template->setPagetitle('login');

        if ($_POST) {
            $login = $this->form->getPost('login');
            $wachtwoord = $this->form->getPost("wachtwoord");

            if ($this->gebruikers->getUser($login, $wachtwoord)) {
                $_SESSION ['rol'] = $this->gebruikers->getUser($login, $wachtwoord)->rol;
                $_SESSION['login'] = $this->gebruikers->getUser($login, $wachtwoord)->login;
                $this->redirect($_SESSION['rol']);
            } else {
                $this->setCurrentFlashmessage("foute combinatie gebruikersnaam/paswoord", "error");
            }
        }
        $this->template->render('login/inlogscherm');

    }

    public function loguit ()
    {
        unset ($_SESSION);
        session_destroy();
        session_start();
        $this->redirect("login");
    }

    public function vorigerol()
    {
        $_SESSION['login']=$_SESSION['vorigerol'];
        $_SESSION['vorigelogin']=null;
        $_SESSION['rol']= $_SESSION['vorigerol'];
        $_SESSION['vorigerol']=null;
        $this->redirect();
    }
}