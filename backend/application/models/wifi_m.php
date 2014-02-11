<?php

class Wifi_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'wnets';
    }
	
	public function getWifi($captions)
	{
	
		$result = false;

        $query = "
            SELECT *
            FROM wnets
			WHERE caption = ?
        ";

        $bookings = $this->db->query($query,$captions)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
		
	}


}

