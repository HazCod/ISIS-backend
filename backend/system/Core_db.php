<?php

abstract class Core_db
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function insertBoeking($student, $lector, $vak, $moment, $opmerkingen)
    {
        $query = "INSERT INTO boekingen (student,lector,vak,moment,opmerkingen)
        VALUES ('$student','$lector','$vak','$moment','$opmerkingen')";
        return $this->db->query($query);
    }

    public function verwijderBoeking($bookingid)
    {
        $query = "DELETE FROM boekingen where bookingid = '$bookingid'";
        return $this->db->query($query);
    }

    public function updateBoekingStudent($bookingid, $opmerkingen)
    {
        $query = "UPDATE boekingen SET opmerkingen = '$opmerkingen' where bookingid = '$bookingid'";
        return $this->db->query($query);
    }

    public function updateBoekingLector($bookingid, $date, $opmerkingen)
    {
        $query = "UPDATE boekingen SET opmerkingen = '$opmerkingen', moment = '$date' where bookingid = '$bookingid'";
        return $this->db->query($query);
    }

    public function insertGebruiker($login, $password, $voornaam, $achternaam, $email, $rol)
    {
        $query = "INSERT INTO gebruikers (login,password,voornaam,achternaam,email,rol)
        VALUES ('$login','$password','$voornaam','$achternaam','$email','$rol')";
        return $this->db->query($query);

    }

    public function insertStudent2($login, $reeks)
    {
        $jaar = $reeks[0];
        $klas = $reeks[strlen($reeks) - 1];
        $query = "INSERT INTO student (login,jaar,reeks)
        VALUES ('$login','$jaar','$klas')";
        return $this->db->query($query);
    }

    public function insertLector2($login, $lokaal)
    {
        $query = "INSERT INTO lectoren (login,lokaal)
        VALUES ('$login','$lokaal')";
        return $this->db->query($query);
    }

    public function insertVak($vak, $verantwoordelijke)
    {
        $query = "INSERT INTO vakken (naam,verantwoordelijke)
        VALUES ('$vak','$verantwoordelijke')";
        return $this->db->query($query);
    }

    public function insertNieuws($titel, $tekst, $date)
    {
        $query = "INSERT INTO news (newstitle, newstext, newsdate)
        VALUES ('$titel','$tekst','$date')";
        return $this->db->query($query);
    }

    public function verwijderGebruiker($login)
    {
        $query = "DELETE FROM gebruikers where login = '$login'";
        return $this->db->query($query);
    }

    public function verwijderStudent($login)
    {
        $query = "DELETE FROM student where login = '$login'";
        return $this->db->query($query);
    }

    public function verwijderLector($login)
    {
        $query = "DELETE FROM lectoren where login = '$login'";
        return $this->db->query($query);
    }

    public function verwijderNieuws($id)
    {
        $query = "DELETE FROM news where id = '$id'";
        return $this->db->query($query);
    }

    public function verwijderVak($naam)
    {
        $query = "DELETE FROM vakken where naam = '$naam'";
        return $this->db->query($query);
    }

    public function updateGebruiker($login, $nLogin, $nVoornaam, $nAchternaam, $nEmail)
    {
        $query = "UPDATE gebruikers SET login = '$nLogin', voornaam = '$nVoornaam', achternaam = '$nAchternaam', email = '$nEmail' where login = '$login'";
        return $this->db->query($query);
    }

    public function updateStudent($login, $nLogin, $nReeks)
    {
        $jaar = $nReeks[0];
        $klas = $nReeks[strlen($nReeks) - 1];
        $query = "UPDATE student SET login = '$nLogin', jaar = '$jaar', reeks = '$klas' where login = '$login'";
        return $this->db->query($query);
    }

    public function updateLector($login, $nLogin, $nLokaal)
    {
        $query = "UPDATE lectoren SET login = '$nLogin', lokaal = '$nLokaal' where login = '$login'";
        return $this->db->query($query);
    }

    public function updateVak($naam, $nNaam, $nVerantwoordelijke)
    {
        $query = "UPDATE vakken SET naam = '$nNaam', verantwoordelijke = '$nVerantwoordelijke' where naam = '$naam'";
        return $this->db->query($query);
    }

    public function updateNieuws($id, $nTitel, $nTekst, $nDate)
    {
        $query = "UPDATE news SET newstitle = '$nTitel', newstext = '$nTekst', newsdate = '$nDate' where id = '$id'";
        return $this->db->query($query);
    }

    public function maakStudieadviseur($login)
    {
        $query = "UPDATE gebruikers SET rol = 'studieadviseur' where login = '$login'";
        return $this->db->query($query);
    }

    public function maakLector($login)
    {
        $query = "UPDATE gebruikers SET rol = 'leraar' where login = '$login'";
        return $this->db->query($query);
    }

    public function updatePass($login, $password)
    {
        $query = "UPDATE gebruikers SET password = '$password' where login = '$login'";
        return $this->db->query($query);
    }

}
