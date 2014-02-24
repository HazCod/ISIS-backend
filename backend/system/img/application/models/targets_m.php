<?php

class Targets_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'target_devices';
    }

 
	    public function getTargets()
    {
        $result = false;

        $query = "
            SELECT *
            FROM target_devices
        ";

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }


}

