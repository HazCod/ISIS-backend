<?php
class Admin extends Core_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->controleerbevoegdheid('admin');

        $this->template->setPartial('flashmessage')
            ->setPartial('footer')
            ->setPartial("headermeta")
            ->setPartial("navbar")
            ->setPartial("scripts");

        $this->menu_m= Load::model("Menu_m");
        $this->users_m= Load::model('users_m');
        $this->studenten_m= Load::model("studenten_m");
        $this->lectoren_m= Load::model("lectoren_m");
        $this->oods_m= Load::model("oods_m");

        $this->template->menuitems= $this->menu_m->getMenuItems();

    }

    public function index()
    {

        $this->template->setPagetitle('admin dashboard');
        $this->template->render('admin/dashboard');

    }

    public function studentenoverzicht()
    {

        $this->template->setPagetitle('studentenoverzicht');
        $this->template->studenten = $this->studenten_m->getNaamAantalboekingen();
        $this->template->render('admin/studenten/overzicht');

    }

    public function voegstudenttoe()
    {
        $this->template->setPagetitle('voeg een student toe');
        $formdata = $this->form->getPost(array('voornaam', 'naam', 'login', 'email', 'reeks'));
        //controleren of alle data correct is
        if ($_POST) {

            $this->form->validateLength('voornaam');
            $this->form->validateLength('naam');
            $this->form->validateLength('login',1,6);
            //$student=$this->users_m->getUserZonderpwd($formdata->login);
           // $this->form->checkuniekelogin($student,'login');
            $this->form->validateMail('email');
            $this->form->validateLength('reeks');

            if ($this->form->isFormValid()) {
                $paswoord = paswoord::generatePassword();
                $formdata->paswoord = sha1($paswoord);
                $this->setFlashmessage("de student is toegevoegd. Het wachtwoord is " . $paswoord);
                $this->studenten_m->add($formdata);
                $this->redirect("admin/studentenoverzicht");
            } else {
                $this->setCurrentFlashmessage("mislukt", 'error');
                $this->template->student = $formdata;

            }

        }
        $this->template->render("admin/studenten/formulier");
    }

    public function verwijderstudent($login)
    {

        if (!$this->studenten_m->getStudent($login)) {
            $this->setFlashmessage('deze student bestaat niet', "error");
            $this->redirect("admin/studentenoverzicht");
        } else {
            $this->studenten_m->delete($login);
            $this->setFlashmessage("student is verwijderd");
            $this->redirect("admin/studentenoverzicht");
        }
    }

    public function bewerkStudent($login)
    {
        $student= $this->studenten_m->getStudent($login);
        $this->template->student = $student;
        $this->template->bewerk=true;
        if (!$student)
        {
            $this->setFlashmessage("deze student bestaat niet", "error");
            $this->redirect("admin/studentenoverzicht");
        } else {
            if ($_POST) {
                $formdata = $this->form->getPost(array('voornaam', 'naam', 'email', 'reeks'));

                $this->form->validateLength('voornaam');
                $this->form->validateLength('naam');
                $this->form->validateMail('email');
                $this->form->validateLength('reeks');

                if ($this->form->isFormValid()) {
                    $this->studenten_m->updatestudent($login, $formdata);
                    $this->setFlashmessage("bewerken geslaagd");
                    $this->redirect("admin/studentenoverzicht");
                } else {
                    $this->template->student = $formdata;
                    $this->setCurrentFlashmessage("verbeter de fouten", "error");
                }
            }
            $this->template->render("admin/studenten/formulier");
        }
    }

    public function resetpassword ($login)
    {
        if (!$this->users_m->getUserZonderpwd($login))
        {
            $this->setFlashmessage("deze gebruiker bestaat niet","error");
            $this->redirect("admin");
        }
        else
        {
            $paswoord=paswoord::generatePassword();
            $data= new stdClass();
            $data->paswoord= sha1($paswoord);
            $this->users_m->update($login, $data);
            $this->setFlashmessage("het paswoord van $login is $paswoord");
            $this->redirect("admin");
        }
    }

    public function lectorenoverzicht()
    {
        $this->template->setPagetitle('lectorenoverzicht');
        $this->template->lectoren = $this->lectoren_m->getNaamAantalboekingen();
        $this->template->render('admin/lectoren/overzicht');
    }

    public function voegLectorToe()
    {
        $this->template->setPagetitle('voeg een lector toe');
        $formdata = $this->form->getPost(array('voornaam', 'naam', 'login', 'email', 'lokaal'));
        //controleren of alle data correct is
        if ($_POST) {

            $this->form->validateLength('voornaam');
            $this->form->validateLength('naam');
            $this->form->validateLength('login',1,6);
            $lector=$this->users_m->getUserZonderpwd($formdata->login);
            $this->form->checkuniekelogin($lector,'login');
            $this->form->validateMail('email');
            $this->form->validateLength('lokaal');

            if ($this->form->isFormValid()) {
                $paswoord = paswoord::generatePassword();
                $formdata->paswoord = sha1($paswoord);
                $this->setFlashmessage("de lector is toegevoegd. Het wachtwoord is " . $paswoord);
                $this->lectoren_m->add($formdata);
                $this->redirect("admin/lectorenoverzicht");
            } else {
                $this->setCurrentFlashmessage("mislukt", 'error');
                $this->template->student = $formdata;

            }

        }
        $this->template->render("admin/lectoren/formulier");
    }

    public function veranderStudieadviseur($login)
    {
        if (!$this->lectoren_m->getLector($login))
        {
            $this->setCurrentFlashmessage("dit is geen geldige lector","error");
        }
        else
        {
            if ($this->users_m->getUserZonderpwd($login)->rol=='lector')
            {
                $nieuwerol='studieadviseur';
            }
            if ($this->users_m->getUserZonderpwd($login)->rol=='studieadviseur')
            {
                $nieuwerol='lector';
            }

            $this->lectoren_m->veranderRol($nieuwerol, $login);
            $this->setFlashmessage("gelukt");
            $this->redirect("admin/lectorenoverzicht");
        }
    }

    public function bewerklector($login)
    {
        $lector= $this->lectoren_m->getLector($login);
        $this->template->lector = $lector;
        $this->template->bewerk=true;
        if (!$lector)
        {
            $this->setFlashmessage("deze lector bestaat niet", "error");
            $this->redirect("admin/lectorenoverzicht");
        } else {
            if ($_POST) {
                $formdata = $this->form->getPost(array('voornaam', 'naam',  'email', 'lokaal'));

                $this->form->validateLength('voornaam');
                $this->form->validateLength('naam');
                $this->form->validateMail('email');
                $this->form->validateLength('lokaal');

                if ($this->form->isFormValid()) {
                    $this->lectoren_m->updateLector($login, $formdata);
                    $this->setFlashmessage("bewerken geslaagd");
                    $this->redirect("admin/lectorenoverzicht");
                } else {
                    $this->template->lector = $formdata;
                    $this->setCurrentFlashmessage("verbeter de fouten", "error");
                }
            }
            $this->template->render("admin/lectoren/formulier");
        }
    }

    public function oodOverzicht()
    {
        $this->template->setPagetitle('overzicht oods');
        $this->template->oods = $this->oods_m->getOods();
        $this->template->render('admin/oods/overzicht');
    }

    public function voegOodToe()
    {
        $this->template->setPagetitle("niew ood");
        $formdata= $this->form->getPost(array("oodnr", "naam", "studiepunten"));

        if ($_POST)
        {
            $this->form->validateNumeric("oodnr");
            $ood=$this->oods_m->getOod($formdata->oodnr);
            $this->form->checkuniekelogin($ood,"oodnr");
            $this->form->validateLength("naam");
            $this->form->validateNumeric("studiepunten");

            if ($this->form->isFormValid())
            {
                $this->oods_m->add($formdata);
                $this->setFlashmessage("het ood is toegevoegd");
                $this->redirect("admin/oodOverzicht");
            }
            else
            {
                $this->setCurrentFlashmessage("verbeter de fouten", "error");
                $this->template->ood= $formdata;
            }
        }
        $this->template->render("admin/oods/formulier");

    }

    public function bewerkOod($oodnr)
    {
        $ood=$this->oods_m->getOod($oodnr);
        $this->template->ood=$ood;
        $this->template->bewerk=true;
        if (! $ood)
        {
            $this->setFlashmessage("dit ood bestaat niet","error");
            $this->redirect("admin/oodoverzicht");
        }
        else
        {
            if ($_POST)
            {
                $formdata=$this->form->getPost(array("naam","studiepunten"));
                $this->form->validateLength("naam");
                $this->form->validateNumeric("studiepunten");

                if ($this->form->isFormValid())
                {
                    $this->oods_m->bewerk($formdata, $oodnr);
                    $this->setFlashmessage("het ood is bijgewerkt");
                    $this->redirect("admin/oodoverzicht");
                }
                else
                {
                    $this->template->ood= $formdata;
                    $this->setCurrentFlashmessage("verbeter de fouten", "error");
                }
            }
            $this->template->render("admin/oods/formulier");
        }
    }

}