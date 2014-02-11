<?php

class Units_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'units';
    }

 
	    public function getUnits()
    {
        $result = false;

        $query = "
            SELECT *
            FROM units
        ";

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }


}

