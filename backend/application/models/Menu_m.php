<?php
class Menu_m
{

    public function getMenuItems()
    {
        if ($_SESSION['rol']== "admin")
        {
        $menuitems = array(
            array(
                'link' => 'admin/studentenoverzicht',
                'description' => 'beheer studenten',
            ),
            array(
                'link' => 'admin/lectorenoverzicht',
                'description' => 'beheer lectoren',
            ),
            array(
                'link' => 'admin/oodoverzicht',
                'description' => 'beheer OODs',
            ),
        );
        }

        if ($_SESSION['rol']=='studieadviseur')
        {
            $menuitems= array(
                array(
                    'link'=>"studieadviseur",
                    "description"=>"overzicht studenten",
                ),

                array(
                    'link'=>'studieadviseur/boekingoverzicht',
                    "description"=>"overzicht boekingen"
                ),

                array(
                    'link'=>"lector",
                    "description"=>"mijn boekingen",
                ),
            );
        }

        if ($_SESSION['rol']=='lector')
        {
            $menuitems= array(
                array(
                    'link'=>'lector',
                    "description"=>"mijn boekingen"
                ),
            );
        }

        if ($_SESSION['rol']=="student")
        {
            $menuitems= array(
                array(
                    'link'=>'student',
                    "description"=>"mijn boekingen"
                ),
            );
        }

        return $menuitems;
    }
}