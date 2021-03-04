<?php 
  class Database {
    // DB Params
    private $host = 'mysql.studev.groept.be';
    private $db_name = 'a20fire4';
    private $username = 'a20fire4';
    private $password = 'kjwrp43x1s';
    private $port = '3306';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
  }