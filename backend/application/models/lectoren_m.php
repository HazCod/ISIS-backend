<?php
class lectoren_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();
        $this->table='users';
    }

    public function getNaamAantalboekingen()
    {
        $sql = "
        select
	      voornaam || ' '||naam as naam,
	      count (distinct boekingsnr),
	      login,
	      rol,
	      lokaal,
	      email
        from
	      lectoren
	      left outer join boekingen on (login=lector)
	       inner join users using (login)
        group by
	        login,
	        voornaam,
	        naam,
	        rol,
	        lokaal,
	        email";

        $uit= $this->db->query($sql)->getResult();
        return $uit;
    }

    public function  getLector ($login)
    {
        $sql="
        select
            *
        from
          lectorgegevens
        where
          login=?";

        $uit=$this->db->query($sql, $login)->getRow();
        return $uit;
    }

    public function getLectoren()
    {
        $query="
        select
            *
        from
          lectorgegevens";

        return $this->db->query($query)->getResult();
    }

    public function add($data)
    {
        $udata['login']=$data->login;
        $udata['paswoord']=$data->paswoord;
        $udata['naam']= $data->naam;
        $udata['voornaam']= $data->voornaam;
        $udata['email']=$data->email;
        $udata['rol']='lector';

        $this->db->insert('users', $udata);

        $ldata['login']= $data->login;
        $ldata['lokaal']= $data->lokaal;

        $this->db->insert('lectoren', $ldata);
    }

    public function veranderRol($niewerol, $id)
    {
        $data = new stdClass();
        $data->rol = $niewerol;
        $this->db->update("users",$data,array ("login"=>$id));
    }

    public function updateLector($id, $data)
    {
        $udata= new stdClass();
        $udata->naam=$data->naam;
        $udata->voornaam= $data->voornaam;
        $udata->email= $data->email;

        $this->db->update('users', $udata, array ("login"=>$id));

        $ldata= new stdClass();
        $ldata->lokaal= $data->lokaal;
        $this->db->update('lectoren',$ldata,array("login"=>$id));

    }
}