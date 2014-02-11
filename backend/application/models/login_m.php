<?php

class Login_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'gebruikers';
    }

    public function getUserPassHash( $userlogin )
    {
        $result = false;

        $query = "
            SELECT *
            FROM admins
            WHERE (login = ?);
        ";

        $user = $this->db->query($query, $userlogin)->getRow()->password;

        if ($user){
            $result = $user;
        }

        return $result;
    }

    public function isValidLogin( $userlogin, $userpasshash ){
        $result = false;

        $hash = $this->getUserPassHash($userlogin);

        if ( ($hash != false) && ($hash == $userpasshash) ){
            $result = true;
        }

        return $result;
    }
	


}
