<?php
class oods_m extends Core_db
{
    public function __construct()
    {
        parent::__construct();
        $this->table='oods';
    }

    public function getOods()
    {
        $query="
        select *
        from oods";

        return $this->db->query($query)->getResult();
    }

    public function getOod($oodnr)
    {
        $quey="
        select *
        from oodgegevens
        where oodnr=?";

        $uit = $this->db->query($quey,$oodnr)->getRow();

        return $uit;
    }

    public function add($data)
    {
        $odata['naam']=$data->naam;
        $odata['oodnr']=$data->oodnr;
        $odata["studiepunten"] =  $data->studiepunten;

        $this->insert($odata);
    }

    public function bewerk($data, $oodnr)
    {
        $this->db->update('oods',$data, array ('oodnr'=>$oodnr));
    }
}