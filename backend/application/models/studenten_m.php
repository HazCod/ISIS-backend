<?php
class studenten_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();
        $this->table='users';
    }

    public function getStudents()
    {
        $sql="
        select *
        from studentgegevens";

        $uit= $this->db->query($sql)->getResult();
        return $uit;
    }

    public function getStudent($login)
    {
        $sql="
        select *
        from studentgegevens
        where login= ?";

        $uit=$this->db->query($sql, array($login))->getRow();

        return $uit;
    }

    public function getNaamAantalboekingen()
    {
        $sql = "
        select
	      voornaam || ' '||naam as naam,
	      count (distinct boekingsnr),
	      login
        from
	      studenten
	      left outer join boekingen on (login=student)
	       inner join users using (login)
        group by
	        login,
	        voornaam,
	        naam";

        $uit= $this->db->query($sql)->getResult();
        return $uit;
    }

    public function add($data)
    {
        $udata['login']=$data->login;
        $udata['paswoord']=$data->paswoord;
        $udata['naam']= $data->naam;
        $udata['voornaam']= $data->voornaam;
        $udata['email']=$data->email;
        $udata['rol']='student';

        $this->db->insert('users', $udata);

        $sdata['login']= $data->login;
        $sdata['reeks']= $data->reeks;

        $this->db->insert('studenten', $sdata);
    }

    public function delete($id)
    {
       $sql="
       delete from boekingen
       where login =?";

       $this->db->query($sql,$id);
        
       $sql="
       delete from studenten
       where  login=?";

       $this->db->query($sql, $id);

       $sql="
       delete from users
       where login=?";

       $this->db->query($sql, $id);
    }

    public function updatestudent($id, $data)
    {
        $udata= new stdClass();
        $udata->naam=$data->naam;
        $udata->voornaam= $data->voornaam;
        $udata->email= $data->email;

        $this->db->update('users', $udata, array ("login"=>$id));

        $sdata= new stdClass();
        $sdata->reeks= $data->reeks;
        $this->db->update('studenten',$sdata,array("login"=>$id));

    }
}