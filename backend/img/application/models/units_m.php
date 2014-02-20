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


}

