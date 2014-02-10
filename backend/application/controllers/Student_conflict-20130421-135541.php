<?php
class Student extends Core_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->controleerbevoegdheid(array("student", "studieadviseur"));

        $this->template->setLayout("default");
        $this->template->setPartial("headermeta")
            ->setPartial("navbar")
            ->setPartial("flashmessage")
            ->setPartial("footer")
            ->setPartial("scripts");

        $this->menu_m=Load::model("Menu_m");
        $this->template->menuitems=$this->menu_m->getMenuItems();
        $this->boekingen_m=Load::model("boekingen_m");
        $this->lectoren_m= Load::model("lectoren_m");
        $this->OODS_m= Load::model("oods_m");
    }

    public function index()
    {
        $this->template->setPagetitle("uw boekingen");
        $this->template->boekingen= $this->boekingen_m->getBoekingenStudent($_SESSION['login']);
        $this->template->render("boekingen/overzicht");
    }

    public function verwijderBoeking ($boekingsnr)
    {
        if (!$this->boekingen_m->getBoeking($boekingsnr))
        {
            $this->setFlashmessage("deze boeking bestaat niet", "error");
            $this->redirect("student");
        }
        else
        {
            $boeking=$this->boekingen_m->getBoeking($boekingsnr);
            if ($boeking->student != $_SESSION['login'])
            {
                $this->setFlashmessage("u mag deze afspraak niet verwijderen","error");
                $this->redirect("student");
            }
            else
            {
                $this->boekingen_m->verwijder($boekingsnr);
                $this->setFlashmessage("boeking is verwijderd");
                $this->redirect("student");
            }
        }
    }

    public function addboeking()
    {
        $this->template->setPagetitle("maak een boeking");
        $formdata = $this->form->getPost(array('lector', 'oodnr', "reeks", "opmerkingen"));
        $lectoren = $this->lectoren_m->getLectoren();
        $this->template->lectoren = $lectoren;
        $OODs = $this->OODS_m->getOODs();
        $this->template->OODs = $OODs;

        if ($_POST) {
            $this->form->validateLength("lector");
            $this->form->validateNumeric("oodnr");
            $this->form->validateLength("reeks", 1, 5);
            $this->form->validateLength("opmerkingen",0,50);
            if ($this->form->isFormValid()) {
                $this->boekingen_m->addboeking($formdata->lector, $_SESSION['login'], $formdata->reeks, $formdata->opmerkingen, $formdata->oodnr);
                $this->redirect("student");

            } else {
                $this->template->boeking=$formdata;
                $this->setCurrentFlashmessage("verbeter de fouten", "error");
            }
        }
        $this->template->render("boekingen/formulier");
    }

    public function bewerkboeking($boekingsnr)
    {
        $boeking = $this->boekingen_m->getBoeking($boekingsnr);
        $this->template->bewerk = true;
        $this->template->boeking = $boeking;
        if (!$boeking) {
            $this->setFlashmessage("deze boekin bestaat niet");
            $this->redirect("student");
        } else {
            $this->template->setPagetitle("boeking bewerken");
            $this->template->lectoren = $this->lectoren_m->getLectoren();
            $this->template->OODs = $this->OODS_m->getOODs();
            if ($_POST) {
                $formdata = $this->form->getPost(array("reeks", "opmerkingen"));
                $this->form->validateLength("reeks",1,5);
                $this->form->validateLength("opmerkingen", 0, 50);
                if ($this->form->isFormValid()) {
                    $this->setFlashmessage("de boeking is bijgewerkt");
                    $this->boekingen_m->bewerkBoeking($formdata, $boekingsnr);
                    $this->redirect("student");
                } else {
                    $this->template->boeking = $formdata;
                    $this->setCurrentFlashmessage("verbeter de fouten", "error");
                }
            }
            $this->template->render("boekingen/formulier");
        }
    }
}