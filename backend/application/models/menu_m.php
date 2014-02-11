<?php

class Menu_m extends Core_db
{

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

    public function getBeheerderMenu()
    {
        $menuitems = array(
            array(
                'link' => 'admin/index',
                'description' => 'Management',
            ),
            array(
                'link' => 'admin/settings',
                'description' => 'Settings',
            ),
        );
        return $menuitems;
    }

}
