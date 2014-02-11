<?php

class Beheerder extends Core_controller
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
        $this->template->menuitems = $this->menu_m->getBeheerderMenu();
        $this->vakken_m = Load::model('vakken_m');
        $this->bookings_m = Load::model('bookings_m');
        $this->lector_m = Load::model('lector_m');
        $this->news_m = Load::model('news_m');
        $this->student_m = Load::model('student_m');
        $this->user = $this->user_m->getUser($_SESSION['user']);
    }

    public function index()
    {
        if ($this->user->rol == 'beheerder') {
            $this->template->render('beheerder/index');
        } else {
            $this->redirect('home/index');
        }
    }

    public function studentbeheer()
    {
        if ($this->user->rol == 'beheerder') {
            $this->template->user = $this->user_m->getUser($_SESSION['user']);
            $allStudents = $this->user_m->getUserByRole('student');

            usort($allStudents, function ($a, $b) {
                return strcmp($a->voornaam, $b->achternaam);
            });
            foreach ($allStudents as $nr => $student) {
                $arr[$nr]['Login'] = $student->login;
                $arr[$nr]['Naam'] = $student->voornaam . " " . $student->achternaam;
                $arr[$nr]['Aantal boekingen'] = $this->bookings_m->countBookingsOfStudent($student->login)->amount;
                $arr[$nr]['Acties'] = $student->login;
                $this->template->students = $arr;
            }
            $this->template->render('beheerder/beheerStudent');
        } else {
            $this->redirect('home/index');
        }
    }

    public function addStudent()
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();

            if ($_POST) {
                $this->form->validateLength('login', 4);
                $this->form->validateLength('voornaam', 2);
                $this->form->validateLength('achternaam', 2);
                $this->form->validateLength('reeks', 4);
                $this->form->validateLength('email', 5);

                if ($this->form->isFormValid()) {
                    $userExists = $this->user_m->getUser($formdata->login);
                    if ($userExists == false) {
                        $password = $this->generatePassword(5);
                        $this->user_m->insertGebruiker($formdata->login, sha1('kapotte' . $password . 'tractor'), $formdata->voornaam, $formdata->achternaam, $formdata->email, 'student');
                        $this->user_m->insertStudent2($formdata->login, $formdata->reeks);
                        $this->setFlashmessage('Your password has been set to: <b>' . $password . '</b>');
                        mail($formdata->email, 'Uw logininformatie', 'Gebruikersnaam : ' . $formdata->login . ' Wachtwoord : ' . $password);
                        $this->setFlashmessage('Student correct aangemaakt');
                        $this->redirect('beheerder/studentbeheer');
                    } else {
                        $this->setCurrentFlashmessage('Deze login is al in gebruik !', 'error');
                        $this->template->render('beheerder/addStudent');
                    }

                } else {
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->template->render('beheerder/addStudent');
                }

            } else {
                $this->template->render('beheerder/addStudent');
            }
        } else {
            $this->redirect('home/index');
        }

    }

    public function verwijderStudent($login)
    {
        if ($this->user->rol == 'beheerder') {
            if ($login != false) {
                $this->template->studenten = $this->user_m->getUser($login);
                if ($this->template->studenten) {
                    $this->user_m->verwijderStudent($login);
                    $this->user_m->verwijderGebruiker($login);
                    $this->setFlashmessage($login . ' correct verwijderd.');
                    $this->redirect('beheerder/studentbeheer');
                } else {
                    $this->setFlashmessage('Student niet gevonden.', 'error');
                    $this->redirect('beheerder/studentbeheer');
                }

            }
        } else {
            $this->redirect('home/index');
        }

    }

    public function editStudent($login)
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();
            if ($_POST) {

                $this->form->validateLength('login', 5);
                $this->form->validateLength('voornaam', 3);
                $this->form->validateLength('achternaam', 3);
                $this->form->validateLength('reeks', 4);
                $this->form->validateLength('email', 3);

                if ($this->form->isFormValid()) {
                    $nLogin = $formdata->login;
                    $nVoornaam = $formdata->voornaam;
                    $nAchternaam = $formdata->achternaam;
                    $nReeks = $formdata->reeks;
                    $nEmail = $formdata->email;
                    $this->user_m->updateGebruiker($login, $nLogin, $nVoornaam, $nAchternaam, $nEmail);
                    $this->user_m->updateStudent($login, $nLogin, $nReeks);
                    $this->setFlashmessage('Student correct geupdate.');
                    $this->redirect('beheerder/studentbeheer');

                } else {
                    $this->template->student = $this->user_m->getUser($login);
                    $this->template->reeks = $this->student_m->getStudentGroup($login);
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->redirect('beheerder/editStudent');
                }
            } else {
                $this->template->student = $this->user_m->getUser($login);
                $this->template->reeks = $this->student_m->getStudentGroup($login);
                $this->template->render('beheerder/editStudent');
            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function vakbeheer()
    {
        if ($this->user->rol == 'beheerder') {
            $alleVakken = $this->vakken_m->getAllCourses();

            foreach ($alleVakken as $nr => $vak) {
                $arr[$nr]['Naam'] = $vak->naam;
                $arr[$nr]['Verantwoordelijke'] = $vak->verantwoordelijke;
                $this->template->vakken = $arr;
            }

            $this->template->render('beheerder/beheerVakken');
        } else {
            $this->redirect('home/index');
        }
    }

    public function addVak()
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();

            if ($_POST) {
                $this->form->validateLength('vak', 4);
                $this->form->validateLength('verantwoordelijke', 4);

                if ($this->form->isFormValid()) {
                    $vakExists = $this->vakken_m->getCourseByName($formdata->vak);
                    if ($vakExists == false) {
                        $this->user_m->insertVak($formdata->vak, $formdata->verantwoordelijke);
                        $this->redirect('beheerder/vakbeheer');
                    } else {
                        $this->setCurrentFlashmessage('Dit vak bestaat al !', 'error');
                        $this->template->render('beheerder/addVak');
                    }

                } else {
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->template->render('beheerder/addVak');
                }

            } else {
                $this->template->render('beheerder/addVak');
            }
        } else {
            $this->redirect('home/index');
        }

    }

    public function verwijderVak($naam)
    {
        if ($this->user->rol == 'beheerder') {
            if ($naam != false) {
                $this->template->vak = $this->vakken_m->getCourseByName($naam);
                if ($this->template->vak) {
                    $this->user_m->verwijderVak($naam);
                    $this->setFlashmessage('Vak: ' . $naam . ' correct verwijderd.');
                    $this->redirect('beheerder/vakbeheer');
                } else {
                    $this->setFlashmessage('Vak niet gevonden.', 'error');
                    $this->redirect('beheerder/vakbeheer');
                }

            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function editVak($naam)
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();
            if ($_POST) {

                $this->form->validateLength('naam', 3);
                $this->form->validateLength('verantwoordelijke', 4);

                if ($this->form->isFormValid()) {
                    $nNaam = $formdata->naam;
                    $nVerantwoordelijke = $formdata->verantwoordelijke;
                    $this->user_m->updateVak($naam, $nNaam, $nVerantwoordelijke);
                    $this->setFlashmessage('Vak correct geupdate.');
                    $this->redirect('beheerder/vakbeheer');

                } else {
                    $this->template->vak = $this->vakken_m->getCourseByName($naam);
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->redirect('beheerder/editVak');
                }
            } else {
                $this->template->vak = $this->vakken_m->getCourseByName($naam);
                $this->template->render('beheerder/editVak');
            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function lectorbeheer()
    {
        if ($this->user->rol == 'beheerder') {
            if ($this->user_m->getUserByRole('studieadviseur') != false) {
                $alleLectoren = array_merge($this->user_m->getUserByRole('leraar'), $this->user_m->getUserByRole('studieadviseur'));
            } else {
                $alleLectoren = $this->user_m->getUserByRole('leraar');
            }

            usort($alleLectoren, function ($a, $b) {
                return strcmp($a->voornaam, $b->achternaam);
            });
            foreach ($alleLectoren as $nr => $lector) {
                $arr[$nr]['Naam'] = $lector->voornaam . " " . $lector->achternaam;
                $arr[$nr]['Aantal boekingen'] = $this->bookings_m->countBookingsOfLector($lector->login)->amount;
                $arr[$nr]['Studieadviseur'] = ($lector->rol == 'studieadviseur') ? 'Ja' : 'Nee';
                $arr[$nr]['Lokaal'] = $this->lector_m->getLocation($lector->login);
                $arr[$nr]['Acties'] = $lector->login;
                $this->template->lectoren = $arr;
            }

            $this->template->render('beheerder/beheerLector');
        } else {
            $this->redirect('home/index');
        }
    }

    public function addLector()
    {

        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();

            if ($_POST) {
                $this->form->validateLength('login', 4);
                $this->form->validateLength('voornaam', 2);
                $this->form->validateLength('achternaam', 2);
                $this->form->validateLength('email', 5);
                $this->form->validateLength('lokaal', 1);

                if ($this->form->isFormValid()) {
                    $userExists = $this->user_m->getUser($formdata->login);
                    if ($userExists == false) {
                        $password = $this->generatePassword(5);
                        $this->user_m->insertGebruiker($formdata->login, sha1('kapotte' . $password . 'tractor'), $formdata->voornaam, $formdata->achternaam, $formdata->email, 'leraar');
                        $this->user_m->insertLector2($formdata->login, $formdata->lokaal);
                        $this->setFlashmessage('Your password has been set to: <b>' . $password . '</b>');
                        mail($formdata->email, 'Uw logininformatie', 'Gebruikersnaam : ' . $formdata->login . ' Wachtwoord : ' . $password);
                        $this->redirect('beheerder/lectorbeheer');
                    } else {
                        $this->setCurrentFlashmessage('Deze lector bestaat al !', 'error');
                        $this->template->render('beheerder/addLector');
                    }

                } else {
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->template->render('beheerder/addLector');
                }

            } else {
                $this->template->render('beheerder/addLector');
            }
        } else {
            $this->redirect('home/index');
        }

    }

    public function verwijderLector($login)
    {
        if ($this->user->rol == 'beheerder') {
            if ($login != false) {
                $this->template->lectoren = $this->user_m->getUser($login);
                if ($this->template->lectoren) {
                    $this->user_m->verwijderLector($login);
                    $this->user_m->verwijderGebruiker($login);
                    $this->setFlashmessage($login . ' correct verwijderd.');
                    $this->redirect('beheerder/lectorbeheer');
                } else {
                    $this->setFlashmessage('Lector niet gevonden.', 'error');
                    $this->redirect('beheerder/lectorbeheer');
                }

            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function editLector($login)
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();
            if ($_POST) {

                $this->form->validateLength('login', 5);
                $this->form->validateLength('voornaam', 3);
                $this->form->validateLength('achternaam', 3);
                $this->form->validateLength('email', 3);
                $this->form->validateLength('lokaal', 1);

                if ($this->form->isFormValid()) {
                    $nLogin = $formdata->login;
                    $nVoornaam = $formdata->voornaam;
                    $nAchternaam = $formdata->achternaam;
                    $nEmail = $formdata->email;
                    $nLokaal = $formdata->lokaal;
                    $this->user_m->updateGebruiker($login, $nLogin, $nVoornaam, $nAchternaam, $nEmail);
                    $this->user_m->updateLector($login, $nLogin, $nLokaal);
                    $this->setFlashmessage('Lector correct geupdate.');
                    $this->redirect('beheerder/lectorbeheer');

                } else {
                    $this->template->lector = $this->user_m->getUser($login);
                    $this->template->lokaal = $this->lector_m->getLocation($login);
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->redirect('beheerder/editLector');
                }
            } else {
                $this->template->lector = $this->user_m->getUser($login);
                $this->template->lokaal = $this->lector_m->getLocation($login);
                $this->template->render('beheerder/editLector');
            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function nieuwsbeheer()
    {
        if ($this->user->rol == 'beheerder') {
            $alleNieuwsItems = $this->news_m->getNews();

            foreach ($alleNieuwsItems as $nr => $nieuws) {
                $arr[$nr]['Titel'] = $nieuws->newstitle;
                $arr[$nr]['Tekst'] = $nieuws->newstext;
                $arr[$nr]['Datum'] = $nieuws->newsdate;
                $arr[$nr]['Acties'] = $nieuws->id;
                $this->template->nieuwsitems = $arr;
            }

            $this->template->render('beheerder/beheerNieuws');
        } else {
            $this->redirect('home/index');
        }
    }

    public function addNieuws()
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();

            if ($_POST) {
                $this->form->validateLength('titel', 4);
                $this->form->validateLength('tekst', 4);
                $this->form->validateLength('date', 4);


                if ($this->form->isFormValid()) {
                    $this->user_m->insertNieuws($formdata->titel, $formdata->tekst, $formdata->date);
                    $this->redirect('beheerder/nieuwsbeheer');

                } else {
                    $this->setCurrentFlashmessage('Controleer uw invoer...', 'error');
                    $this->template->render('beheerder/addNieuws');
                }

            } else {
                $this->template->render('beheerder/addNieuws');
            }
        } else {
            $this->redirect('home/index');
        }

    }

    public function verwijderNieuws($id)
    {
        if ($this->user->rol == 'beheerder') {
            if ($id != false) {
                $this->template->nieuws = $this->news_m->getNewsItem($id);
                if ($this->template->nieuws) {
                    $this->user_m->verwijderNieuws($id);
                    $this->setFlashmessage('Nieuwsitem: ' . $id . ' correct verwijderd.');
                    $this->redirect('beheerder/nieuwsbeheer');
                } else {
                    $this->setFlashmessage('NieuwsItem niet gevonden.', 'error');
                    $this->redirect('beheerder/nieuwsbeheer');
                }

            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function editNieuws($id)
    {
        if ($this->user->rol == 'beheerder') {
            $formdata = $this->form->getPost();
            if ($_POST) {

                $cDate = $formdata->date;
                $cYear = substr($cDate, 0, 4);
                $cMonth = substr($cDate, 5,6);
                $cDay = substr($cDate, -2);

                $this->form->validateLength('titel', 3);
                $this->form->validateLength('tekst', 4);
                $this->form->validateDate($cDate, $cDay, $cMonth, $cYear);

                if ($this->form->isFormValid()) {
                    $nTitel = $formdata->titel;
                    $nTekst = $formdata->tekst;
                    $nDate = $formdata->date;
                    $this->user_m->updateNieuws($id, $nTitel, $nTekst, $nDate);
                    $this->setFlashmessage('Nieuws correct geupdate.');
                    $this->redirect('beheerder/nieuwsbeheer');

                } else {
                    $this->template->nieuws = $this->news_m->getNewsItem($id);
                    $this->setCurrentFlashmessage('Foute invoer ', 'error');
                    $this->template->render('beheerder/editNieuws');
                }
            } else {
                $this->template->nieuws = $this->news_m->getNewsItem($id);
                $this->template->render('beheerder/editNieuws');
            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function passReset($login)
    {
        $this->template->user = $this->user_m->getUser($login);
        $mail = $this->user_m->getEmail($login);

        $wachtwoord = $this->generatePassword(5);

        $this->user_m->updatePass($login, sha1('kapotte' . $wachtwoord . 'tractor'));
        $this->setFlashmessage('Nieuw wachtwoord : ' . $wachtwoord);
        mail($mail, 'Uw logininformatie', 'Uw nieuw wachtwoord is: ' . $wachtwoord);
        if ($this->template->user->rol == 'student') {
            $this->redirect('beheerder/studentbeheer');
        } else {
            $this->redirect('beheerder/lectorbeheer');
        }
    }

    public function maakStudieadviseur($login)
    {
        if ($this->user->rol == 'beheerder') {
            $this->template->lector = $this->user_m->getUser($login);
            if ($this->template->lector != false) {
                $this->user_m->maakStudieAdviseur($login);
                $this->redirect('beheerder/lectorbeheer');
            } else {
                $this->setCurrentFlashmessage('Lector bestaat niet', 'error');
                $this->redirect('beheerder/lectorbeheer');
            }
        } else {
            $this->redirect('home/index');
        }
    }

    public function maakLector($login)
    {
        if ($this->user->rol == 'beheerder') {
            $this->template->lector = $this->user_m->getUser($login);
            if ($this->template->lector != false) {
                $this->user_m->maakLector($login);
                $this->redirect('beheerder/lectorbeheer');
            } else {
                $this->setCurrentFlashmessage('studieadviseur bestaat niet', 'error');
                $this->redirect('beheerder/lectorbeheer');
            }
        } else {
            $this->redirect('home/index');
        }
    }


}