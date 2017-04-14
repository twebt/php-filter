<?php

namespace App\Database;
use Mysqli;

class Database 
{

    protected $host;
    protected $user;
    protected $pass;
    protected $database;

    public $mysqli;

    public function __construct() {

        $this->host = '';
        $this->user = '';
        $this->pass = '';
        $this->database = '';

        $this->mysqli = new \mysqli($this->host, $this->user, $this->pass, $this->database);
    
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        return $this->mysqli;
    }
}