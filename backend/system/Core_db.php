<?php

abstract class Core_db
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }
}
