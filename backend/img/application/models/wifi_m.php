<?php

class Wifi_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'ap_info';
    }
	
	public function getWifi($captions)
	{
	
		$result = false;

        $query = "
            SELECT *
            FROM ap_info
			WHERE caption = ?
			GROUP BY wifi_network
        ";

        $bookings = $this->db->query($query,$captions)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
		
	}
	
		public function getDetailWifi($caption,$wifi_network)
	{
	
		$result = false;

        $query = "
            SELECT *
            FROM ap_info
			WHERE (caption = '$caption') and (wifi_network = '$wifi_network')
        ";

        $bookings = $this->db->query($query,$captions,$wifi_network)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
		
	}


}

