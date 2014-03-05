<?php

class Passwords_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'passwords';
    }
	
	public function getPasswords()
    {
        $result = false;

        $query = "
            SELECT *
            FROM passwords
        ";

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }

}
