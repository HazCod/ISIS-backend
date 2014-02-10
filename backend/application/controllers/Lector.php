<?php

class Lector extends Core_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->controleerbevoegdheid(array("lector", "studieadviseur"));

        $this->template->setLayout("default");

        $this->template->setPartial("headermeta")
            ->setPartial("navbar")
            //->setPartial("uitlogknop")
            ->setPartial("flashmessage")
            ->setPartial("footer")
            ->setPartial("scripts");

        $this->boekingen_m=Load::model("boekingen_m");
        $this->menu_m= Load::model("Menu_m");
        $this->template->menuitems= $this->menu_m->getMenuItems();
    }

    public function index()
    {
        $this->template->setPagetitle("uw boekingen");
        $this->template->boekingen= $this->boekingen_m->getBoekingenLector($_SESSION['login']);
        $this->template->render("boekingen/overzicht");
    }

    public function bewerkBoeking($boekingsnr)
    {
        $boeking= $this->boekingen_m->getBoeking($boekingsnr);
        if (!$boeking)
        {
            $this->setFlashmessage("deze boeking bestaat niet");
            $this->redirect("lector");
        }
        elseif ($boeking->lector!= $_SESSION['login'])
        {
            $this->setFlashmessage("u kan alleen uw eigen boekingen bewerken", "error");
            $this->redirect("lector");
        }
        else
        {
            $this->template->setPagetitle("bewerk boeking");
            $this->template->boeking=$boeking;
            if ($_POST)
            {
                $formdata= $this->form->getPost(array("uur", "minuten", "opmerkingen"));
                $this->form->validateLength("opmerkingen", 0, 50);
                if ($this->form->isFormValid())
                {
                    $moment= '2013-01-28 '."$formdata->uur:$formdata->minuten";
                    $opmerkingen= $formdata->opmerkingen;
                    $data= new stdClass();
                    $data->moment=$moment;
                    $data->opmerkingen= $opmerkingen;
                    if ($this->boekingen_m->studentVrijOm($moment, $boeking->student)->vrij)
                    {
                        if ($this->boekingen_m->lectorVrijOm($moment, $_SESSION['login'])->vrij)
                        {
                            $this->boekingen_m->bewerkBoeking($data, $boekingsnr);
                            $this->setFlashmessage("de boeking is bijgewerkt");
                            $this->redirect("lector");
                        }
                        else
                        {
                            $this->setCurrentFlashmessage("u heeft zelft een boeking op dit moment", "error");
                        }
                    }
                    else
                    {
                        $this->setCurrentFlashmessage("de student heeft al een boeking op dit moment", "error");
                    }
                }
            }

        }
       $this->template->render("boekingen/lectorenformulier");
    }
}