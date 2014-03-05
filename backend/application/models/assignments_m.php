<?php

class Assignments_m extends Core_db

{

    public function __construct()

    {
        parent::__construct();
        $this->table = 'assignments';
    }
	
	public function getAssignment($captions)
	{
	
		$result = false;

        $query = "
            SELECT *
            FROM assignments
			WHERE caption = ?
			ORDER BY assignments_id DESC
			limit 10
        ";

        $bookings = $this->db->query($query,$captions)->getResult();

        if ($bookings) {
            $result = $bookings;
        }

        return $result;
		
	}
	
	public function removeAssignment($assignments_id)
	{
	
		$query = "DELETE FROM assignments where assignments_id = '$assignments_id'";
        return $this->db->query($query);
		
	}

	public function addNmapAssignment($caption, $wifi, $key, $encryption){
		$query = "INSERT INTO assignments (assignment, status, caption, parameter) VALUES ('nmap','new','$caption','$wifi|$encryption|$key');";
		return $this->db->query($query);
	}
	

}

