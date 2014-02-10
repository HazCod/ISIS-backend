<?php

class DB
{
    private static $instance = null;
    protected $db;
    private $log;
    private $stmt;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // on instantination: build the connection
    private function __construct()
    {
        global $db_config;

        $dsn = $db_config['driver'] . ':';

        foreach ($db_config['dsn'] as $key=>$value) {
            $dsn .= $key . '=' . $value . ';';
        }

        try {
            // $this refers to the current class
            $this->db = new PDO($dsn, $db_config['username'], $db_config['password']);

            // set the error reporting attribute
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // setting the search_path
            if (($db_config['driver'] == 'pgsql') && isset($db_config['schema'])) {
                $this->db->query(sprintf("SET SEARCH_PATH TO %s", $db_config['schema']));
            }
        } catch(PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public function query($sql, $arguments = array())
    {
        if (!is_array($arguments)) {
            $arguments = array($arguments);
        }

        try {
            $this->stmt = $this->db->prepare($sql);
            $this->stmt->execute($arguments);
            $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log($e->getMessage());
        }

        return $this;
    }

    public function getResult()
    {
        $result = array();

        if ($this->stmt) {
            // as long as there are rows, add them to the data-output array
            while ($row = $this->stmt->fetchObject()) {
                $result[] = $row;
            }
        }

        return $result;
    }

    public function getRow()
    {
        $row = false;

        if ($this->stmt) {
            $row = $this->stmt->fetchObject();
        }

        return $row;
    }

    public function insert($table, $values)
    {
        $insertfields = array();
        $insertdata = array();

        // seperating keys en data for the insert statement
        foreach ($values as $key=>$value) {
            $insertfields[] = $key;
            $insertdata[':' . $key] = $value;
        }

        $query = "INSERT INTO $table (" . implode(', ', $insertfields) . ") VALUES (:" . implode(', :', $insertfields) . ")";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($insertdata);
        } catch(PDOException $e) {
            error_log($e->getMessage());
        }

        return $this;
    }

    public function update($table, $values, $where = array())
    {
        $updatefields = array();
        $updatedata = array();
        $wherefields = array();

        foreach ($values as $key => $value) {
            $updatefields[] = "$key = :$key";
            $updatedata[':' . $key] = $value;
        }

        foreach ($where as $key => $value) {
            $wherefields[] = "$key = :$key";
            $updatedata[':' . $key] = $value;
        }

        $query = "UPDATE $table SET " . implode(', ', $updatefields);

        if ($where) {
            $query .= " WHERE " . implode(', ', $wherefields);
        }

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($updatedata);
        } catch(PDOException $e) {
            error_log($e->getMessage());
        }

        return $this;
    }

    public function delete($table, $where = array())
    {
        $deletedata = array();
        $wherefields = array();

        foreach ($where as $key => $value) {
            $wherefields[] = "$key = :$key";
            $deletedata[':' . $key] = $value;
        }

        $query = "DELETE FROM $table";

        if ($where) {
            $query .= " WHERE " . implode(', ', $wherefields);
        }

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($deletedata);
        } catch(PDOException $e) {
            error_log($e->getMessage());
        }

        return $this;
    }
}
