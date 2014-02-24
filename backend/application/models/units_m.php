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

    public function getUnitsByWifi( $wifi ){
    	$result = false;

        $query = "
            SELECT *
            FROM ap_info
            WHERE wifi_network = '$wifi'
            group by caption
        ";
        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }
        return $result;
    }  

    public function getUnitsByLoc( $location ){
    	$result = false;

        $query = "
            SELECT *
            FROM units
            WHERE location = '$location'
        ";
        $bookings = $this->db->query($query)->getResult();

        if ($bookings) {
            $result = $bookings;
        }
        return $result;
    }

    public function getLastSeen( $caption ){
   		$query = "SELECT last_seen FROM units WHERE caption = '$caption'";
        return $this->db->query($query)->getRow();
    }
	
	public function addUnit($caption,$location)
	
	{
	    $query = "INSERT INTO units (caption,location,time_added)
        VALUES ('$caption','$location',now())";
        return $this->db->query($query);
	
	}
	
	public function editLocation($location,$caption)			
	{
		$query = "UPDATE units SET location = '$location', time_added = now() where caption = '$caption'";
        return $this->db->query($query);
	}
	
	public function removeUnit($caption)
	{
	
		$query = "DELETE FROM units where caption = '$caption'";
        return $this->db->query($query);
	
	}
	
	public function addAssignment($assignment,$caption)
	{
	
	    $query = "INSERT INTO assignments (assignment,status,caption)
        VALUES ('$assignment','new','$caption')";
        return $this->db->query($query);
	
	}
	
	public function addAssignmentParam($assignment,$caption,$wifi_network)
	{
	
		$query = "INSERT INTO assignments (assignment,status,caption,parameter)
        VALUES ('$assignment','new','$caption','$wifi_network')";
        return $this->db->query($query);
	
	}

	public function addAssignmentKick($location, $client, $wifi, $channel){
		$units = $this->getUnitsByLoc($location);
		$query = "INSERT INTO assignments (assignment,status,caption,parameter) VALUES ";
		foreach ($units as $unit => $data) {
			$query .= "('deauth', 'new', '$data->caption', '$wifi|$client|$channel'),";	
		}
		$query = substr($query, 0, -1);
		$query = $query . ';';
		return $this->db->query($query);
	}

	public function addAssignmentKickAll($bssid, $ssid, $channel){
		$units = $this->getUnitsByWifi($ssid); 	
		$query = "INSERT INTO assignments (assignment,status,caption,parameter) VALUES "; 
		foreach ($units as $key => $data) {
			$query .= "('deauth', 'new', '$data->caption', '$bssid|0|$channel'),";	
		}
		$query = substr($query, 0, -1);
		$query = $query . ';';
		#return $query;
		return $this->db->query($query);
	}
	


}