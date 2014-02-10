<?php
class users_m extends Core_db
{

    public function __construct()
    {
        parent::__construct();
        $this->table='users';
    }

    public function getUsers()
    {
        $query= "select * from users";

        return $this->db->query($query)->getResult();
    }

    public function getUser($login, $password)
    {
        $query = "
            SELECT *
            FROM users
            WHERE login = ? AND paswoord = ?
        ";


        return $this->db->query($query,array($login, sha1($password)))->getRow();
    }

    public function getUserZonderpwd($login)
    {
        $query="
        select *
        from users
        where login=?";

        return $this->db->query($query, array($login))->getRow();
    }


}