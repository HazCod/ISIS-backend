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
	

}

