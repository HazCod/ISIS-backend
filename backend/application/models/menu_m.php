<?php

class Menu_m extends Core_db
{
    public function getReturnMenu()
    {
        $menuitems = array(
            array(
                'link' => 'home',
                'description' => 'Terug',
            ),
        );
        return $menuitems;
    }

    public function getStartmenu()
    {
        $menuitems = array(
            array(
                'link' => 'home',
                'description' => 'Home',
            ),
        );
        return $menuitems;
    }

    public function getStudentmenu()
    {
        $menuitems = array(
            array(
                'link' => 'student/index',
                'description' => 'Boekingen',
            ),
        );
        return $menuitems;
    }

    public function getStudieadviseurmenu()
    {
        $menuitems = array(
            array(
                'link' => 'studieadviseur/index',
                'description' => 'Boekingen',
            ),
            array(
                'link' => 'studieadviseur/extraSorteerVak',
                'description' => 'Afspraken per vak',
            ),
        );
        return $menuitems;
    }

    public function getBeheerderMenu()
    {
        $menuitems = array(
            array(
                'link' => 'beheerder/studentbeheer',
                'description' => 'Beheer studenten',
            ),
            array(
                'link' => 'beheerder/lectorbeheer',
                'description' => 'Beheer lectoren',
            ),
            array(
                'link' => 'beheerder/vakbeheer',
                'description' => 'Beheer cursussen',
            ),
            array(
                'link' => 'beheerder/nieuwsbeheer',
                'description' => 'Beheer nieuwsitems',
            ),
            array(
                'link' => 'home',
                'description' => 'Start',
            ),
        );
        return $menuitems;
    }

}