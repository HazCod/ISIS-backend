<?php

class User_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'admins';
    }

    public function getUser($userLogin)
    {

        $query = "
            SELECT *
            FROM admins
            WHERE (login = ?);
        ";

        return $this->db->query($query, $userLogin)->getRow();

    }



}

