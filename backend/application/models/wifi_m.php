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

    public function getGeneralWifi( $wifi ){
        $result = false;

        $query = "
            SELECT *
            FROM ap_info
            WHERE wifi_network = '$wifi';
        ";

        $bookings = $this->db->query($query)->getRow();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }

    public function getWifiKey($wifi){
        $result = false;

        $query = "
            SELECT wifi_key
            FROM ap_info
            WHERE wifi_network = $wifi;
        ";

        $bookings = $this->db->query($query)->getRow();

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

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
		
	}

    public function getAPnetworks( $ap ){
        $result = false;

        $query = "
            SELECT wifi_network, channel, encryption
            FROM ap_info
            WHERE mac_adress = '$ap'
            GROUP BY wifi_network
        ";

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }

    public function getManufacturer( $ap ){
        $result = false;

        $query = "
            SELECT manufac
            FROM ap_info
            WHERE (mac_adress = '$ap')
            GROUP BY manufac
        ";

        $bookings = $this->db->query($query)->getRow();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
    }

    public function getAPdevices( $ap ){
        $result = false;
        $query = "
            SELECT *
            FROM target_devices
            WHERE (associated_ap = '$ap');
        ";

        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result; 
    }


}

