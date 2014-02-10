<?php
class Boekingen_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();

        $this->table="boekingen";
    }

    public function getBoekingenStudent($login)
    {
        $query = "
        select
            boekingsnr,
            moment,
            oods.naam,
            boekingen.reeks,
            users.voornaam||' '||users.naam as lector,
            lokaal,
            opmerkingen
        from
            (boekingen
            inner join oods using (oodnr)
            inner join studenten on (student= studenten.login))
            inner join users on (lector= users.login)
            inner join lectoren on (lector= lectoren.login)
	    where
	        student =?";

        return $this->db->query($query, $login)->getResult();
    }

    public function getBoekingenLector($login)
    {
        $query = "
        select
            boekingsnr,
            moment,
            oods.naam,
            boekingen.reeks,
            users.voornaam||' '||users.naam as student,
            lokaal,
            opmerkingen
        from
            (boekingen
            inner join oods using (oodnr)
            inner join studenten on (student= studenten.login))
            inner join users on (student= users.login)
            inner join lectoren on (lector= lectoren.login)
	    where
	        lector =?";

        return $this->db->query($query, $login)->getResult();
    }

    public function getBoeking($boekingsnr)
    {
        $query="
        select *
        from boekingen
        where boekingsnr=?";

        return $this->db->query($query,$boekingsnr)->getRow();
    }

    public function verwijder($boekingsnr)
    {
        $this->db->delete("boekingen", array("boekingsnr"=>$boekingsnr));
    }

    public function getLaatsteBoekingStudent($login)
    {
        global $beginmoment;
        $query="
        select
          coalesce (max (moment), $beginmoment)
        from
          boekingen
        where
          student = ?";

        return $this->db->query($query, $login)->getRow();
    }

    public function getLaatsteBoekingLector($login)
    {
        global $beginmoment;
        $query="
        select
            coalesce (max(moment), $beginmoment)
        from
            boekingen
        where
            lector=?";

        return $this->db->query($query, $login)->getRow();
    }

    public function getVrijVoorBeiden ($lector, $student)
    {
        global $beginmoment;
        $query="
        SELECT
          CASE
            WHEN MAX(moment) is NULL THEN '2012-12-19 13:00:00'
            ELSE MAX(moment)
            END as moment
        FROM (
          (
            SELECT MAX(moment) + duur AS moment
            FROM boekingen
            WHERE student = ?
            GROUP BY duur
          )
        UNION
            (
            SELECT MAX(moment) + duur AS moment
            FROM boekingen
            WHERE lector = ?
            GROUP BY duur
            )
            ) AS boekingsmoment";

        return $this->db->query($query, array($student, $lector))->getRow();
    }

    public function addBoeking($lectorlogin, $studentlogin, $reeks, $opmerkingen, $oodnr)
    {
        global $standaardduur;
        $data= array();
        $data['moment']= $this->GetVrijVoorBeiden($lectorlogin, $studentlogin)->moment;
        $data['student']= $studentlogin;
        $data ['lector']= $lectorlogin;
        $data['oodnr']=$oodnr;
        $data['duur']='00:10:00';
        $data["opmerkingen"]=$opmerkingen;
        $data['reeks']=$reeks;

        $this->insert ($data);
    }

    public function bewerkBoeking ($data, $boekingsnr)
    {
        $this->db->update("boekingen", $data,array ("boekingsnr"=>$boekingsnr));
    }

    public function studentVrijOm ($moment, $login)
    {
        $query="
        select
	      case when
		    (select
		      moment
		    from
		      boekingen
		    where
		      moment=?
		      and student=?) is null then true
	       else
		    false
	      end as vrij";

        return $this->db->query($query,array($moment,$login))->getRow();
    }

    public function lectorVrijOm ($moment, $login)
    {
        $query="
        select
	      case when
		    (select
		      moment
		    from
		      boekingen
		    where
		      moment=?
		      and lector=?) is null then true
	       else
		    false
	      end as vrij";

        return $this->db->query($query,array($moment,$login))->getRow();
    }

    public function getBoekingOod ($oodnr)
    {
        $query="
        select
          s.naam as student,
          l.naam as lector,
          moment,
          duur,
          reeks
        from
          boekingen
          inner join users s on (student = s.login)
          inner join users l on (lector=l.login)
        where
          oodnr=?";

        return $this->db->query($query,$oodnr)->getResult();
    }


}