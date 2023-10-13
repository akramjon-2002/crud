<?php

namespace myFunction;

use connection\Connection;

class Model
{
    public $tableName;
    public $db;
    public function __construct()
    {
        $this->tableName = $this->tableName();
        $con = new Connection();
        $this->db = $con->getConnection();
    }

}