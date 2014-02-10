<?php
class StudieAdviseur extends Core_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->controleerbevoegdheid("studieadviseur");

        $this->template->setLayout("default");
        $this->template->setPartial("headermeta")
                       ->setPartial("navbar")
                       ->setPartial("flashmessage")
                       ->setPartial("footer")
                       ->setPartial("scripts");

        $this->menu_m= Load::model("Menu_m");
        $this->template->menuitems=$this->menu_m->getMenuItems();
        $this->studenten_m=Load::model("studenten_m");
        $this->OODS_m= Load::model("oods_m");
        $this->lectoren_m=Load::model("lectoren_m");
        $this->boekingen_m= Load::model("boekingen_m");
    }

    public function index()
    {
        $this->template->setPagetitle("overzicht studenten");
        $this->template->studenten=$this->studenten_m->getNaamAantalBoekingen();
        $this->template->render("sadv/studentenoverzicht");
    }

    public function boekVoorStudent($studentnr)
    {
        $student = $this->studenten_m->getStudent($studentnr);
        if ($student) {
            $this->template->setPagetitle("maak een boeking");
            $formdata = $this->form->getPost(array('lector', 'oodnr', "reeks", "opmerkingen"));
            $lectoren = $this->lectoren_m->getLectoren();
            $this->template->lectoren = $lectoren;
            $OODs = $this->OODS_m->getOODs();
            $this->template->OODs = $OODs;

            if ($_POST) {
                $this->form->validateLength("lector");
                $this->form->validateNumeric("oodnr");
                $this->form->validateLength("reeks", 1,5);
                $this->form->validateLength("opmerkingen", 0, 50);
                if ($this->form->isFormValid()) {
                    $this->boekingen_m->addboeking($formdata->lector, $studentnr, $formdata->reeks, $formdata->opmerkingen, $formdata->oodnr);
                    $this->redirect("studieadviseur");

                } else {
                    $this->template->boeking = $formdata;
                    $this->setCurrentFlashmessage("verbeter de fouten", "error");
                }
            }
            $this->template->render("boekingen/formulier");
        } else {
            $this->setFlashmessage("deze student bestaat niet", "error");
            $this->redirect("studieadviseur");
        }
    }

    public function DoeAlsStudent($studentnr)
    {
        $student= $this->studenten_m->getStudent($studentnr);
        if (!$student)
        {
            $this->setFlashmessage("deze student bestaat niet", "error");
            $this->redirect("studieadviseur");
        }
        else{
            $_SESSION['vorigelogin']=$_SESSION['login'];
            $_SESSION['login']=$studentnr;
            $_SESSION['vorigerol']=$_SESSION['rol'];
            $_SESSION['rol']='student';
            $this->redirect("student");
        }

    }

    public function boekingoverzicht()
    {
        $this->template->OODs=$this->OODS_m->getOods();
        $this->template->setPagetitle("kies een ood");
        if ($_POST)
        {

            $this->template->gekozen= true;
            $oodnr= $this->form->getPost("oodnr");
            $this->template->boekingen=$this->boekingen_m->getBoekingOod($oodnr);
            $this->template->oodnr=$oodnr;
        }
        $this->template->render("sadv/OODFormulier");

    }
}