<?php

class User_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'gebruikers';
    }

    public function getUser($userLogin)
    {

        $query = "
            SELECT *
            FROM gebruikers
            WHERE (login = ?);
        ";

        return $this->db->query($query, $userLogin)->getRow();

    }


    public function getUserRole($userLogin)
    {
        $result = false;

        $user = getUser($userLogin);
        if ($user) {
            $result = $user->rol;
        }

        return $result;
    }


    public function getUserByRole($role)
    {

        $query = "
            SELECT *
            FROM gebruikers
            WHERE (rol = ?)
        ";

        return $this->db->query($query, $role)->getResult();
    }

    public function getEmail($login)
    {
        $query = "
                select email
                from gebruikers
                where (login = ?);
        ";

        return $this->db->query($query, array($login))->getRow();

    }


}

